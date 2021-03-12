<?php

namespace App\Http\Controllers\Auth;

use Response;
use App\User;
use App\Subscription;
use App\Service;
use Carbon\Carbon;
use Cartalyst\Stripe\Stripe;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function showRegistrationForm(Request $request)
    {
        $services     = Service::get(); //dd($services->toArray());
        $referralCode = $request->has('ref') ? $request->ref : '';
        return view('auth.register', compact('referralCode','services'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        if( ! $request->ajax() ){
            return Response::json(['status' => 'error', 'msg' => 'Invalid Request']);
        }

        // validate the form fields
        $validationRules = [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'birth_date'    => 'required',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'postal_code'   => 'required|string',
            'services'      => 'required',
            'referral_code' => 'exists:users,referral_code',
        ];

        $validationMessages = [
            'referral_code.exists' => 'Entered referral code is invalid',
        ];

        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

        // Redirect with validation errors
        if ( ! $validator->passes() ) {
            return Response::json(['status' => 'validation_error', 'msg' => $validator->errors()->all()]);
        }

        // Proceed with payment if no validaition error found
        try{
            $stripe = Stripe::make(config('services.stripe.secret')); //Initiate the stripe

            // Create the customer
            $full_name      = $request->first_name.' '.$request->last_name;
            $phone_number   = ( $request->phone_number ) ? $request->phone_number : '';
            $customer = $stripe->customers()->create([
                'email' => $request->email,
                'name'  => $full_name,
                'phone' => $phone_number
            ]);
            $customerId = $customer['id'];

            $card = $stripe->cards()->create( $customerId, $request->stripeToken );
            
            // Check if user is invited by other user
            $referrerUser = ( $request->referral_code ) ? User::whereReferralCode($request->referral_code)->first() : null;
            $referrerId   = ( $referrerUser ) ? $referrerUser->id : null;
            if ( $referrerId ) {
                $invitationLog = ReferralReport::where('invite_email', $request->email)
                                                ->where('user_id', $referrerId)
                                                ->first();
                $referrerId    = ( $invitationLog ) ? $referrerId : null;
                $invitationLog->is_registered = '1';
                $invitationLog->save();
            }

            // Create the customer in database
            $birth_date = date("Y-m-d", strtotime($request->birth_date));
            $user = User::create([
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'mobile_number' => $request->mobile_number,
                    'birth_date'    => $birth_date,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'city'          => $request->city,
                    'state'         => $request->state,
                    'country'       => $request->country,
                    'postal_code'   => $request->postal_code,
                    'referred_by'   => $referrerId,
                    'referral_code' => strtoupper(uniqid()),
                    'customer_id'   => $customerId
            ]);

            // Loop through all the selected services and charge the customer
            $total_amount = 0;
            $description  = '';
            $servicesData = array();
            foreach ($request->services as $key => $serviceId) {
                $key ++;
                $service        = Service::find($serviceId);
                $servicesData[] = $service;
                if ( $service ) {
                    $total_amount = $total_amount + $service->price;
                    $description .= ( $key !== 1 ) ? '  || '.($key).'. '.$service->name : $key.'. '.$service->name;
                }
            }

            $charge = $stripe->charges()->create([
                'customer'    => $customerId,
                'currency'    => 'CAD',
                'amount'      => $total_amount,
                'description' => $description
            ]);

            if ( $charge ) {
                $chargeId = $charge['id'];

                // Creating expiry date
                $today       = Carbon::now();
                $expiry_date = $today->addYear()->toDateTimeString();

                foreach ($servicesData as $key => $service) {
                    // Store the payment response to database
                    $subscription = Subscription::create([
                        'user_id'          => $user->id,
                        'transaction_id'   => $chargeId,
                        'service_name'     => $service->name,
                        'service_id'       => $service->id,
                        'payment_response' => $charge,
                        'ends_at'          => $expiry_date
                    ]);
                }
                $user->status = 1;
                $user->save();

                // Send welcome email to the user
                Mail::to($user->email)->send(new WelcomeEmail($user));

                // Add user to mailchimp service if use has checked mailchimp option
                if ( isset( $request->mailchimp_signup ) && $request->mailchimp_signup == 'on' ) {
                    event(new UserRegistered($user));
                }
                return Response::json(['status' => 'success','msg' => 'Registration successful. Please login']);
            }
        } catch (Exception $e) {
            // \Session::put('error',$e->getMessage());
            return Response::json(['status' => 'error','msg' => $e->getMessage()]);
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            // \Session::put('error',$e->getMessage());
            return Response::json(['status' => 'error','msg' => $e->getMessage()]);
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // \Session::put('error',$e->getMessage());
            return Response::json(['status' => 'error','msg' => $e->getMessage()]);
        }
    }

    /**
     * Deprecated function: not being used anymore
     * 
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function __register(Request $request)
    {
        if( ! $request->ajax() ){
            return Response::json(['status' => 'error', 'msg' => 'Invalid Request']);
        }

        // Check if user was invited by other user
        $referrerUser = ( $request->referral_code ) ? User::whereReferralCode($request->referral_code)->first() : null;
        $referrerId   = ( $referrerUser ) ? $referrerUser->id : null;
        if ( $referrerId ) {
            $invitationLog = ReferralReport::where('invite_email', $request->email)
                                            ->where('user_id', $referrerId)
                                            ->first();
            $referrerId    = ( $invitationLog ) ? $referrerId : null;
            $invitationLog->is_registered = '1';
            $invitationLog->save();
        }

        // Create the customer in database
        $birth_date = date("Y-m-d", strtotime($request->birth_date));
        $user = User::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'mobile_number' => $request->mobile_number,
                'birth_date'    => $birth_date,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city'          => $request->city,
                'state'         => $request->state,
                'country'       => $request->country,
                'postal_code'   => $request->postal_code,
                'referred_by'   => $referrerId,
                'referral_code' => strtoupper(uniqid()),
                'status'        => 1
        ]);


        // Decode the payment response and get the transaction ID
        $transaction_response = $request->transaction_response;
        $payment_load         = json_decode($transaction_response);
        $transactionId        = $payment_load->ssl_txn_id; 
        //echo '<pre>'; print_r($payment_load); die;
        
        // Creating expiry date
        $today       = Carbon::now();
        $expiry_date = $today->addYear()->toDateTimeString();

        foreach ($request->services as $key => $serviceId) {
            $service = Service::find($serviceId);
            if ( $service ) {
                // Store the payment response to database
                $subscription = Subscription::create([
                    'user_id'          => $user->id,
                    'transaction_id'   => $transactionId,
                    'service_name'     => $service->name,
                    'service_id'       => $service->id,
                    'payment_response' => $transaction_response,
                    'ends_at'          => $expiry_date
                ]);
            }
        }

        // Send welcome email to the user
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Add user to mailchimp service if use has checked mailchimp option
        if ( isset( $request->mailchimp_signup ) && $request->mailchimp_signup == 'on' ) {
            event(new UserRegistered($user));
        }

        return Response::json(['status' => 'success','msg' => 'Registration successful. Please login']);

    }

    /**
     * Deprecated function not being used anymore
     */
    public function __initializePayment(Request $request)
    {
        // Redirect if it's not ajax request
        if( ! $request->ajax() ){
            return Response::json(['status' => 'error', 'msg' => 'Invalid Request']);
        }

        // validate the form fields
        $validationRules = [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'birth_date'    => 'required',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'postal_code'   => 'required|string',
            'services'      => 'required',
            'referral_code' => 'exists:users,referral_code',
        ];

        $validationMessages = [
            'referral_code.exists' => 'Entered referral code is invalid',
        ];

        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

        // Redirect with validation errors
        if ( ! $validator->passes() ) {
            return Response::json(['status' => 'validation_error', 'msg' => $validator->errors()->all()]);
        }

        $paymentMode    = env('CONVERGE_MODE');
        $merchantID     = env('MERCHANT_ID');
        $merchantUserID = env('MERCHANT_USER_ID');
        $merchantPIN    = env('MERCHANT_PIN');
        $name           = $request->first_name.' '.$request->last_name;
        $email          = $request->email;
        $phone          = $request->phone_number;
        $total_amount   = 0;
        

        if ( $paymentMode == 'LIVE' ) {
            $paymentUrl= "https://api.convergepay.com/hosted-payments/transaction_token";
        } else {
            $paymentUrl = "https://api.demo.convergepay.com/hosted-payments/transaction_token";
        }

        // Calculate the total amount
        foreach ($request->services as $key => $serviceId) {
            $service = Service::find($serviceId);
            if ( $service ) {
                $total_amount = $total_amount + $service->price;
            }
        }

        $ch = curl_init();    // initialize curl handle

        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL,$paymentUrl); // set url to post to
        curl_setopt($ch,CURLOPT_POST, true); // set POST method
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
        curl_setopt($ch,CURLOPT_POSTFIELDS,
            "ssl_merchant_id=$merchantID".
            "&ssl_user_id=$merchantUserID".
            "&ssl_pin=$merchantPIN".
            "&ssl_transaction_type=ccsale".
            "&ssl_first_name=$name".
            "&ssl_email=$email".
            "&ssl_phone=$phone".
            "&ssl_get_token=Y".
            "&ssl_add_token=Y".
            "&ssl_amount=$total_amount"
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result   = curl_exec($ch); // run the curl procss
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //echo '<pre>'; print_r($result); die;
        //var_dump($httpcode); die;
        //echo $result;
        //echo $result;
        if ( $httpcode == 200 ) {
            return Response::json(['status' => 'success', 'msg' => 'Transaction token generated', 'data' => $result]);
        } else {
            return Response::json(['status' => 'error', 'msg' => 'Something went wrong', 'data' => $result ]);
        }
    }
}