<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Response;
use App\Subscription;
use App\Service;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display subscription payment form 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSubscribe($id)
    {
        $user            = auth()->user();
        $services        = Service::get();
        $selectedService = Service::findOrFail($id);
        return view('subscribe', compact('services', 'selectedService', 'user'));
    }

    /**
     * Subscribe to new service for existing user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request  $request)
    {
        if( ! $request->ajax() ){
            return Response::json(['status' => 'error', 'msg' => 'Invalid Request']);
        }

        $user         = auth()->user(); //get the current user
        $customerId   = $user->customer_id;
        $full_name    = $user->first_name.' '.$user->last_name;
        $phone_number = ( $user->phone_number ) ? $user->phone_number : '';

        // Proceed with payment if no validaition error found
        try{
            $stripe = Stripe::make(config('services.stripe.secret')); //Initiate the stripe
            // Update the customer Payment in stripe
            $card = $stripe->cards()->create( $customerId, $request->stripeToken );

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

            // Charge the custome with total amount
            $charge = $stripe->charges()->create([
                'customer'    => $customerId,
                'source'      => $card['id'],
                'currency'    => 'CAD',
                'amount'      => $total_amount,
                'description' => $description
            ]);

            if ( $charge ) {
                $chargeId = $charge['id'];

                // Creating expiry date
                $today       = Carbon::now();
                $expiry_date = $today->addYear()->toDateTimeString();

                // Store the payment response to database
                foreach ($servicesData as $key => $service) {
                    $subscription = Subscription::create([
                        'user_id'          => $user->id,
                        'transaction_id'   => $chargeId,
                        'service_name'     => $service->name,
                        'service_id'       => $service->id,
                        'payment_response' => $charge,
                        'ends_at'          => $expiry_date
                    ]);
                }

                return Response::json(['status' => 'success', 'msg' => 'Subscription has been created']);
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
}
