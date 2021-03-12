<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use App\GeneralOption;
use App\Question;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get user count
        $users                = User::latest()->get();
        $data                 = new \stdClass();
        $data->users          = $users;
        return view('admin.dashboard', compact('data'));
    }

    /**
     * Display profile admin details page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Retrive details of logged in Admin user
        $admin = Auth::guard('admin')->user();
        if ( $admin->avatar ) {
            $admin->avatar_url = asset('storage/avatars/'.$admin->avatar);
        } else {
            $admin->avatar_url = asset('storage/avatars/avatar-default.png');
        }
        return view('admin.profile.show', compact('admin'));
    }

    /**
     * Show the edit profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        if ( $admin->avatar ) {
            $admin->avatar_url = asset('storage/avatars/'.$admin->avatar);
        } else {
            $admin->avatar_url = asset('storage/avatars/avatar-default.png');
        }
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update admin profile information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore(Auth::guard('admin')->user()->id),
            ],
        ]);

        $admin        = Admin::find( Auth::guard('admin')->user()->id );
        $admin->email = $request['email'];

        if ( $request['password'] !== null ) {
            $request->validate([
                'password' => 'sometimes|string|min:6',
            ]);
            $admin->password = Hash::make($request['password']);
        }

        if ( $request->hasFile('avatar') ) {
            $request->validate([
                'avatar'   => 'sometimes|image|mimes:jpeg,png,jpg|max:3072'
            ]);

            $admin_avatar = 'avatar-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('avatars', $admin_avatar,'public');
            $admin->avatar = $admin_avatar;
        }
        $admin->save();

        return redirect()
                ->route('admin.profile')
                ->with('success','Profile Updated Successfully');
    }

    /**
     * Show the edit settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function showSettingForm()
    {
        $generalOptions = GeneralOption::all()->toArray();
        $options        = new \stdClass();
        foreach( $generalOptions as $singOption){
            $option_key   = $singOption['option_key'];
            $option_value = $singOption['option_value'];
            $options->$option_key = $option_value;
        }

        //Get Total Questions
        $totalQuestions = Question::get()->count();

        return view('admin.settings', compact('options','totalQuestions'));
    }

    /**
     * Update general settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function saveSettings(Request $request)
    {
        //dd($request->toArray());

        $request->validate([
            'site_logo'    => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'site_favicon' => 'sometimes|mimes:jpeg,png,jpg,ico|max:2048',
        ]);

        $requestArray = $request->toArray();
        if( count($requestArray) > 1 ){
            unset($requestArray['_token']); //Skip the csrf token
            foreach ($requestArray as $key => $option) {
                if ( ! is_object($option) && !is_array($option) ) {
                    $this->saveOptions( $key, $option );
                }
            }
        }
        // If setting form has any files
        if ( !empty( $request->file() ) ) {
            
            foreach( $request->file() as $name => $file ){
                $option_file_name = $name.'-'.time().'.'.$file->extension();
                $request->$name->storeAs('images', $option_file_name,'public');
                $full_file_name = '/storage/images/'.$option_file_name;
                $this->saveOptions( $name, $full_file_name );
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Setting successfully saved');
    }

    /**
     * Save site meta options
     * 
     * @param $key meta key 
     * @param $value value for meta key $key
     */
    public function saveOptions($key, $value)
    {
        // Skip empty key and csrf token key
        if ( $key !== '' && $key !== '_token' ) {
            $saveOption = GeneralOption::updateOrCreate(
                ['option_key' => $key],
                ['option_value' => $value]
            );

            return $saveOption;
        }
    }
}
