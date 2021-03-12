<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;

class ReferralController extends Controller
{
    /**
     * Display a list of referral users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.referrals.index');
    }

    /**
     * Load the referral users for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadReferrals()
    {
        $referrals = User::has('referrals')->withCount('referrals');

        return Datatables::of($referrals)
                ->editColumn('name', function(User $user) {
                    return '<a href="'.route('admin.users.show', $user->id).'" />'.$user->name.'</a>';
                })
                ->addColumn('action', function (User $user) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.referrals.details', $user->id).'"><i class="fas fa-fw fa-eye"></i>View</a>';
                })
                ->rawColumns(['action','name'])
                ->make(true);
    }

    /**
     * Display the referral details of single user
     *
     * @param  \App\User  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $user = User::withCount('referrals')->withCount('invites')->findOrFail($id);
        return view('admin.referrals.details', compact('user'));
    }

    /**
     * Load the list of users referred by user 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadReferralUsers($id)
    {
        $referrals = User::where('referred_by', $id);

        return Datatables::of($referrals)
                ->editColumn('first_name', function(User $user) {
                    return '<a href="'.route('admin.users.show', $user->id).'" />'.$user->first_name.'</a>';
                })
                ->editColumn('last_name', function(User $user) {
                    return '<a href="'.route('admin.users.show', $user->id).'" />'.$user->last_name.'</a>';
                })
                ->editColumn('created_at', function(User $user) {
                    return date("d/m/Y", strtotime($user->created_at));
                })
                ->rawColumns(['first_name','last_name'])
                ->make(true);
    }

    
}
