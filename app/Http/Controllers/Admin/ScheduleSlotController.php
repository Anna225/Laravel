<?php

namespace App\Http\Controllers\Admin;

use App\ScheduleSlot;
use App\UserSchedule;
use App\User;
use App\Service;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReScheduleMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleSlotController extends Controller
{
    /**
     * Display a listing of the First Aid Services ( ID of 2 and 3 hardcoded)
     *
     * @return \Illuminate\Http\Response
     */
    public function firstAidServicesList()
    {
        // Get the first AID CPR services 
        $services = Service::find([2,3]);  //ID 2 and 3 currently First Aid CPR services
        return view('admin.schedule-slots.services', compact('services'));
    }

    /**
     * Display a listing of the schedule slot.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.schedule-slots.index', compact('service') );
    }

    /**
     * Load the Schedule Slots data for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadSlots($id)
    {
        // dd($id);
        $slots = ScheduleSlot::where('service_id', $id)->get();
        return Datatables::of($slots)
                ->editColumn('status', function (ScheduleSlot $slot) {
                    if ( $slot->status == 'available' ) {
                        return '<span class="badge badge-success">Available</span></td>';
                    } else {
                        return '<span class="badge badge-primary">Full</span></td>';
                    }
                })
                ->addColumn('action', function (ScheduleSlot $slot) {
                    return '<a class="btn btn-primary btn-sm" href="'.route("admin.slots.show",$slot->id).'"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-info btn-sm" href="'.route('admin.slots.edit', $slot->id).'"> <i class="fas fa-pencil-alt"></i></a>
                    <button class="btn btn-danger btn-sm delete-slot" data-remote="/admin/slots/'.$slot->id.'"> <i class="fas fa-trash-alt"></i></button>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
    }

    /**
     * Show the form for creating a new schedule slot.
     *
     * @param  $id (service Id)
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $serviceId = $id;
        return view('admin.schedule-slots.create', compact('serviceId'));
    }

    /**
     * Store a newly created schedule slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event'       => 'required',
            'venue'       => 'required',
            'total_slots' => 'required',
            'start_date'  => 'required',
            'start_time'  => 'required',
            'end_date'    => 'required',
        ]);

        $serviceId          = $request->service_id;
        $data               = $request->all();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));

        $addSlot = ScheduleSlot::create($data);

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.slots.index', $serviceId)->with('success','Slot Successfully Added');
        } else {
            return redirect()->route('admin.slots.create', $serviceId)->with('success','Slot Successfully Added');
        }
    }

    /**
     * Display the specified schedule slot.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheduleSlot = ScheduleSlot::with([ 'user_schedules' => function($query){
                                            $query->with('user');
                                        }])
                                        ->findOrFail($id); //dd($scheduleSlot->toArray());
        return view('admin.schedule-slots.show', compact('scheduleSlot'));
    }

    /**
     * Show the form for editing the specified schedule slot.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheduleSlot = ScheduleSlot::findOrFail($id);
        return view('admin.schedule-slots.edit', compact('scheduleSlot'));
    }

    /**
     * Update the specified schedule slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event'       => 'required',
            'venue'       => 'required',
            'total_slots' => 'required',
            'start_date'  => 'required',
            'start_time'  => 'required',
            'end_date'    => 'required',
        ]);

        $data               = $request->all();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));

        $slot = ScheduleSlot::findOrFail($id);
        $slot->update($data);

        //Go back listing page
        return redirect()->route('admin.slots.index', $slot->service_id )
                         ->with('success', 'Schedule Slot Updated'); 
    }

    /**
     * Remove the specified schedule slot from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheduleSlot = ScheduleSlot::findOrFail($id);

        if ( $scheduleSlot->delete() ) {
            return Response(['status'=>'success','message'=>'Schedule Slot deleted']);
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }

    /**
     * Delete booked appoinment of user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAppointment($id)
    {
        $userSchedule = UserSchedule::findOrFail($id);
        $slotId = $userSchedule->slot_id;
        $userSchedule->delete();
        return redirect()->route('admin.slots.show', $slotId)->with('success' , 'Options updated successfully');
    }

    /**
     * ADMIN: Add new user to schedule slot
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request  $request)
    {
        $userEmail  = $request->email;
        $slotId     = $request->slot_id;

        // Check if email address is exist
        $user = User::where('email', $userEmail)->first();
        if ( !$user ) {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'Email address doesn\'t exist',
            ]);
        }

        // check if user is already added to this schedule
        $checkUser = UserSchedule::where('user_id', $user->id)->first();
        if ( $checkUser ) {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'User is already on schedule slot: '.$checkUser->slot_id,
            ]);
        }

        $newUserBooking = UserSchedule::create([
            'slot_id' => $slotId,
            'user_id' => $user->id
        ]);
        
        // Send email to user with new schedule data
        $data = UserSchedule::with('user')->with('schedule_slot')->find($newUserBooking->id);
        Mail::to($data->user->email)->send(new SendReScheduleMail($data));

        return \Response::json([
            'status' => 'success',
            'msg'    => 'User added to this schedule',
        ]);
    }
}
