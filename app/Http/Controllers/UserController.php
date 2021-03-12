<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\TrainingChapter;
use App\Service;
use App\Subscription;
use Auth;

class UserController extends Controller
{
    /**
     * Display myaccount page
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyAccount()
    {
        // Get the logged in user details and pass to myaccount page
        $user = auth()->user();

        // Get the registeres service
        $mySubscriptions = Subscription::with('service')
                                        ->mine()
                                        ->active()
                                        ->get();

        return view('myaccount',compact('user', 'mySubscriptions'));
    }

    /**
     * Update the user account details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateMyAccount(Request $request)
    {
        $user = auth()->guard()->user();
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'birth_date'    => 'required',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'postal_code'   => 'required|string',            
        ]);

        $data               = $request->all();    
        $data['birth_date'] = date("Y-m-d", strtotime($request->birth_date));
        $user->update($data);

        /* if ( $request->hasFile('avatar') ) {
            $request->validate([
                'avatar'   => 'sometimes|image|mimes:jpeg,png,jpg|max:3072'
            ]);

            $user_avatar = 'avatar-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('avatars', $user_avatar,'public');
            $user->avatar = $user_avatar;
        } */

        if ( $user->save() ) {
            return redirect()->route('myaccount')->with('success','Profile Successfully Updated');
        } else {
            return redirect()->route('myaccount')->with('error','Something went wrong');
        }
    }

    /**
     * Update the user password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $user = User::findOrFail( auth()->guard()->user()->id );
        $request->validate([
            'password'         => 'required|string|min:6|confirmed',
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }]
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        if ( $user->save() ) {
            return redirect()->route('myaccount')->with('success','Password Successfully Changed');
        } else {
            return redirect()->route('myaccount')->with('error','Something went wrong');
        }
    }

    /**
     * Display Dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {
        // Get the logged in user details and pass to myaccount page
        $user = User::with('consent_document')
                    ->with('final_quiz')
                    ->findOrFail( auth()->user()->id );
        //dd($user->toArray());
        // Get the training chapters
        $trainingChapters = TrainingChapter::with(['study_log' => function ($query) {
                                                $query->with('last_slide');
                                                $query->mine();
                                                $query->latest();
                                            }])
                                            ->with(['quiz_reports' => function($query){
                                                $query->mine();
                                                $query->completed();
                                            }])
                                            ->withCount('slides')
                                            ->orderBy('order')
                                            ->get(); //dd($trainingChapters->toArray());

        // Get the services
        $services = Service::get();

        // Get all the subscription method
        $securitySubscription = Subscription::ServiceOf(1) // Hardcoded ID 1 for security training service  
                                            ->mine()->latest()->first();
                                            //dd($securitySubscription->toArray());

        return view('dashboard',compact('user','trainingChapters','services', 'securitySubscription'));
    }

}