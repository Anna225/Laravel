<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomEmail;
use App\Events\ScheduleCreated;
use App\User;
use App\Service;
use App\ScheduleSlot;
use App\UserSchedule;

class UserScheduleController extends Controller
{
    /**
     * Display a schedule form
     * 
     * @param  Service $id
     * @return \Illuminate\Http\Response
     */
    public function showScheduleForm($id)
    {
        // Check if passed ID is only for First Aid CPR service
        if ( ! in_array($id, [2,3]) ) { // Hardcoded IDs 2,3 for First Aid CPR
            abort(404);
        }

        //check if user is subscribed to service
        if ( ! isSubscribed( $id ) || isSubscribed( $id )->status == 'expired' ) {
            abort(403);
        }

        $service = Service::findOrFail($id);
        // Get all schedule slots
        $scheduleSlots = ScheduleSlot::get();

        // Check if user has created any schedule before
        $userSchedule = UserSchedule::mine()->first();
        $bookedSlotId = ( $userSchedule ) ? $userSchedule->slot_id : null;

        return view('schedule', compact('scheduleSlots','bookedSlotId', 'service'));
    }

    /**
     * add new schedule
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSchedule(Request  $request)
    {
        $slotId = $request->slot_id;
        $user   = auth()->user(); 

        // Check if there is any previous booking available
        $currentSchedule = UserSchedule::mine()->first();
        if ( $currentSchedule ) {
            $currentSchedule->delete();
        }

        // check the available slots
        $slotDetail  = ScheduleSlot::withCount('user_schedules')->findOrFail($slotId);
        $bookedSlots = $slotDetail->user_schedules_count;
        $slotLimit   = $slotDetail->total_slots;

        if ( $bookedSlots < $slotLimit ) {
            $createSlot = UserSchedule::create([
                'slot_id' => $slotId,
                'user_id' => auth()->user()->id
            ]);

            $data       = new \stdClass();
            $data->slot = $slotDetail;

            // Fire the schedule event to send email to Admin and User
            event(new ScheduleCreated($data, $user));

            return \Response::json([
                'status' => 'success',
                'msg'    => 'Appointment created',
                'data'   => $createSlot->id
            ]);
        } else {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'Slot you\'ve selected is full now',
            ]);
        }
    }

    /**
     * Send email to Admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactAdmin(Request  $request)
    {
        //$admin_email = env('ADMIN_EMAIL');
        $admin_email = getMetaValue('admin_email');
        Mail::to($admin_email)->send(new SendCustomEmail($request->message));

        return \Response::json([
            'status' => 'success',
            'msg'    => 'Message successfully sent',
        ]);
    }
}
