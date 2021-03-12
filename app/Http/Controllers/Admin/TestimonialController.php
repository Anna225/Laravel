<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimonials.index');
    }

    /**
     * Load the testimonial data for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadTestimonials()
    {
        $testimonials = Testimonial::query();

        return Datatables::of($testimonials)
                ->editColumn('avatar_url', function(Testimonial $testimonial) {
                    return '<img class="img-thumbnail" src="'.$testimonial->avatar_url.'" />';
                })
                ->addColumn('action', function (Testimonial $testimonial) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.testimonials.show', $testimonial->id).'"><i class="fas fa-fw fa-eye"></i>View</a>
                    <a class="btn btn-info btn-sm" href="'.route('admin.testimonials.edit', $testimonial->id).'"> <i class="fas fa-fw fa-pencil-alt"></i>Edit</a>
                    <button class="btn btn-danger btn-sm delete-testimonial" data-remote="/admin/testimonials/'.$testimonial->id.'"> <i class="fas fa-fw fa-trash-alt"></i>Delete</button>';
                })
                ->rawColumns(['action','avatar_url'])
                ->make(true);
    }

    /**
     * Show the form for creating a new testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'text'   => "required",
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $testimonial = Testimonial::create($request->all());

        if ( $request->hasFile('avatar') ) {
            $testimonial_image = 'testimonial-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('images', $testimonial_image,'public');
            $testimonial->avatar = $testimonial_image;
            $testimonial->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.testimonials.index')->with('success','Testimonial Successfully Added');
        } else {
            return redirect()->route('admin.testimonials.create')->with('success','Testimonial Successfully Added');
        }
    }

    /**
     * Display the specified testimonial.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'   => 'required',
            'text'   => "required",
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $testimonial->update($request->all());

        if ( $request->hasFile('avatar') ) {
            $testimonial_avatar = 'testimonial-'.time().'.'.$request->file('avatar')->extension();
            $request->avatar->storeAs('images', $testimonial_avatar,'public');
            $testimonial->avatar = $testimonial_avatar;
        }
        
        if ( $testimonial->save() ) {
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated');
        } else {
            return redirect()->route('admin.testimonials.edit', $testimonial->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified testimonial from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        if ( $testimonial->delete() ) {
            return Response(['status'=>'success','message'=>'Testimonial deleted']);  
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }
}
