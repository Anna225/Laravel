<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use DataTables;
use App\User;
use Carbon\Carbon;
use App\Service;
use App\Subscription;
use App\TrainingChapter;
use App\ConsentDocument;
use App\CprCertificate;

class UserController extends Controller
{
    /**
     * Display a listing of registered users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Load the users data for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadUsers()
    {
        $user = User::query();
        return Datatables::of($user)
                ->editColumn('status', function(User $user) {
                    if ( $user->status ) {
                        return "<span class='badge badge-success'>Active</span>";
                    } else {
                        return "<span class='badge badge-danger'>Deactive</span>";
                    }
                })
                ->addColumn('action', function (User $user) {
                    return '<a class="btn btn-primary btn-sm" href="'.route("admin.users.show",$user->id).'"><i class="fas fa-eye"></i> </a>
                    <a class="btn btn-info btn-sm" href="'.route('admin.users.edit', $user->id).'"> <i class="fas fa-pencil-alt"></i> </a>
                    <button class="btn btn-danger btn-sm delete-user" data-remote="/admin/users/'.$user->id.'"> <i class="fas fa-trash-alt"></i> </button>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::get();
        return view('admin.users.create', compact('services'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'          => 'required|email|unique:users|unique:admins',
            'password'       => 'required|string|min:6',
            'first_name'     => 'required|max:100',
            'last_name'      => 'required|max:100',
            'mobile_number'  => 'required|numeric',
            'birth_date'     => 'required',
            'avatar'         => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $data = $request->all();
        $data['birth_date'] = date('Y-m-d', strtotime($request->birth_date));
        $data['password']   = Hash::make($request->password);
        $user               = User::create($data);

        // Check if any service was selected
        if ( $request->services ) {
            // Creating expiry date
            $today       = Carbon::now();
            $expiry_date = $today->addYear()->toDateTimeString();
            foreach ($request->services as $key => $serviceId) {
                $service        = Service::find($serviceId);
                $subscription = Subscription::create([
                    'user_id'          => $user->id,
                    'transaction_id'   => 'Manual Subscription',
                    'service_name'     => $service->name,
                    'service_id'       => $service->id,
                    'payment_response' => 'Manual Subscription',
                    'ends_at'          => $expiry_date
                ]);
            }
        }

        if ( $request->hasFile('avatar') ) {
            $admin_avatar = 'avatar-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('avatars', $admin_avatar,'public');
            $user->avatar = $admin_avatar;
            $user->save();
        }
        //return redirect()->route('admin.users.index');
        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.users.index')->with('success','User Successfully Updated');
        } else {
            return redirect()->route('admin.users.create')->with('success','User Successfully Added');
        }
    }

    /**
     * Display the specified user details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::with('subscriptions')
                        ->with('invites')
                        ->with('final_quiz')
                        ->with('cpr_certificate')
                        ->with('consent_document')
                        ->findOrFail($user->id); //dd($user->toArray());

        $trainingChapters = TrainingChapter::with(['study_log' => function ($query) use($user){
                                                $query->with('last_slide');
                                                $query->where('user_id', $user->id);
                                                $query->latest();
                                            }])
                                            ->with(['quiz_reports' => function($query) use($user){
                                                $query->where('user_id', $user->id);
                                                $query->completed();
                                            }])
                                            ->withCount('slides')
                                            ->orderBy('order')
                                            ->get(); //dd($trainingChapters->toArray());

        return view('admin.users.show', compact('user', 'trainingChapters'));
    }

    /**
     * Show the form for editing the specified user details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $services = Service::get();
        return view('admin.users.edit', compact('user', 'services'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            "consent_document" => "mimetypes:application/pdf|max:2000",
            "cpr_certificate" => "mimes:jpeg,png,jpg,pdf|max:2000",
            'mobile_number' => 'required|numeric',
            'new_password'  => 'sometimes|nullable|string|min:6',
        ],
        [
            'consent_document.mimetypes' => 'Please upload valid consent document',
            'consent_document.max' => 'uploaded consent document is too large.',
            'cpr_certificate.mimes'     => 'Please upload valid certificate file',
            'cpr_certificate.max'       => 'uploaded file is too large' 
        ] );

        if ( $request['new_password'] !== null ) {
            $user->password = Hash::make($request['new_password']);
        } else {
            $request->password = $user->password;
        }

        $data = $request->all();
        $data['birth_date'] = date('Y-m-d', strtotime($request->birth_date));

        // Check if any service was selected
        if ( $request->services ) {
            // Creating expiry date
            $today       = Carbon::now();
            $expiry_date = $today->addYear()->toDateTimeString();
            foreach ($request->services as $key => $serviceId) {
                $service        = Service::find($serviceId);
                $subscription = Subscription::create([
                    'user_id'          => $user->id,
                    'transaction_id'   => 'Manual Subscription',
                    'service_name'     => $service->name,
                    'service_id'       => $service->id,
                    'payment_response' => 'Manual Subscription',
                    'ends_at'          => $expiry_date
                ]);
            }
        }

        $user->update($data);

        if ( $request->hasFile('avatar') ) {
            $request->validate([
                'avatar'   => 'sometimes|image|mimes:jpeg,png,jpg|max:3072'
            ]);

            $user_avatar = 'avatar-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('avatars', $user_avatar,'public');
            $user->avatar = $user_avatar;
        }
        
        if ( $request->hasFile('consent_document') ) {
            $extension      = $request->file('consent_document')->getClientOriginalExtension();
            $document_name  = 'consent_document-'.$user->id.'-'.time().'.'.$extension;
            $request->consent_document->storeAs('documents', $document_name );

            $update = ConsentDocument::updateOrCreate(
                ['user_id'  => $user->id],
                ['document' => $document_name,'status' => 'approved']
            );
        }
        
        if ( $request->hasFile('cpr_certificate') ) {
            $extension      = $request->file('cpr_certificate')->getClientOriginalExtension();
            $document_name  = 'cpr_certificate-'.$user->id.'-'.time().'.'.$extension;
            $request->cpr_certificate->storeAs('cpr_certificates', $document_name );

            $update = CprCertificate::updateOrCreate(
                ['user_id'  => $user->id],
                ['document' => $document_name]
            );
        }
        
        if ( $user->save() ) {
            return redirect()->route('admin.users.show', $user->id)->with('success','User Successfully Updated');
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ( $user->delete() ) {
            return Response(['status'=>'success','message'=>'User deleted']);  
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }
}
