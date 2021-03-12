<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteMail;
use App\User;
use App\ReferralReport;

class ReferralReportController extends Controller
{
    /**
     * Display Referral page
     *
     * @return \Illuminate\Http\Response
     */
    public function showRefer()
    {
        $invitedUsers = ReferralReport::mine()->get();
        return view('refer', compact('invitedUsers'));
    }

    /**
     * Send invite email to friend
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendInvite(Request  $request)
    {
        $emailAddress   = $request->email;
        $user           = User::withCount('invites')->findOrFail(auth()->user()->id);
        $emailCheck     = User::where('email', $emailAddress)->first();
        $entryCheck     = ReferralReport::where('invite_email', $emailAddress)->mine()->first();

        // Check if entered email address is own email address(for some smart ass)
        if ( strtolower($user->email) == strtolower($emailAddress) ) {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'You can not send invite to your email',
            ]);
        }elseif ( $emailCheck ) {  // Check if email address is already on system
            return \Response::json([
                'status' => 'error',
                'msg'    => 'User is already registered on website',
            ]);
        } elseif ( $entryCheck ) {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'You have already invited this user',
            ]);
        } 
        
        /*elseif ( $user->invites_count >= 10 ) { // Check if user can send new invite
            return \Response::json([
                'status' => 'error',
                'msg'    => 'You can not send invite anymore',
            ]);
        }*/ 

        $data             = new \stdClass();
        $data->user       = $user;
        $data->email      = $request->email;
        $data->action_url = config('app.url').'register?ref='.$user->referral_code;

        // Send the invite email
        Mail::to($request->email)->send(new InviteMail($data));

        // Store referral entry to database
        $save = ReferralReport::create([
                    'user_id'      => $user->id,
                    'invite_email' => $request->email
                ]);

        if ( $save ) {
            return \Response::json([
                'status' => 'success',
                'msg'    => 'Invite successfully sent',
            ]);    
        } else {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'Something went wrong',
            ]);
        }
        
    }
}
