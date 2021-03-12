<?php

namespace App\Http\Controllers\Admin;

use App\HomeSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the Slide.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_slides = HomeSlider::orderBy('order')->get();
        return view('admin.home-slides.index', compact('home_slides'));
    }

    /**
     * Show the form for creating a new Slide.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home-slides.create');
    }

    /**
     * Store a newly created Slide in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'heading'  => 'required',
            'image'    => 'required|image|mimes:jpeg,png,jpg|max:3072',
            'cta_link' => 'url'
        ]);

        $homepage_slide = HomeSlider::create($request->all());

        if ( $request->hasFile('image') ) {
            $slide_image = 'slide-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $slide_image,'public');
            $homepage_slide->image = $slide_image;
            $homepage_slide->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.home-slides.index')->with('success','Slide Successfully Added');
        } else {
            return redirect()->route('admin.home-slides.create')->with('success','Slide Successfully Added');
        }
    }

    /**
     * Display the specified Slide.
     *
     * @param  \App\HomeSlider  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSlider $home_slide)
    {
        return view('admin.home-slides.show', compact('home_slide'));
    }

    /**
     * Show the form for editing the specified Slide.
     *
     * @param  \App\HomeSlider  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSlider $home_slide)
    {
        return view('admin.home-slides.edit', compact('home_slide'));
    }

    /**
     * Update the specified Slide in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSlider $home_slide)
    {
        $request->validate([
            'heading'  => 'required',
            'image'    => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
            'cta_link' => 'url'
        ]);

        // If new tab checkbox is unchecked -> store '_self'    
        $target = isset( $request->cta_target ) ? $request->cta_target : '_self';

        $home_slide->update([
            'heading'    => $request->heading,
            'subheading' => $request->subheading,
            'cta_label'  => $request->cta_label,
            'cta_link'   => $request->cta_link,
            'cta_target' => $target,
        ]);

        if ( $request->hasFile('image') ) {
            $slide_image = 'slide-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $slide_image,'public');
            $home_slide->image = $slide_image;
        }

        if ( $home_slide->save() ) {
            return redirect()->route('admin.home-slides.index')->with('success','Slide updated');
        } else {
            return redirect()->route('admin.home-slides.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified Slide from storage.
     *
     * @param  \App\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSlider $home_slide)
    {
        if( $home_slide->delete() ){
            return back()->with('success', 'Slide Updated');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the order of homepage slides.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSlideOrder(Request $request){
        if($request->ajax()){
            $updatedslides = $request->slide;

            foreach ($updatedslides as $key => $slide) {
                HomeSlider::where('id', $slide)->update(['order' => $key ]);
            }

            return Response(['success'=>'Order Updated','order'=> $updatedslides]);
        }
    }
}
