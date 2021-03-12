<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the service.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(5);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'price_without_tax' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'tax' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'tax_percentage' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ]);
        $data = $request->all();    

        //calculate the total price
        $price         = $request->tax + $request->price_without_tax; 
        $data['price'] = $price;

        $service = Service::create($data);

        if ( $request->hasFile('image') ) {
            $service_image = 'service-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $service_image,'public');
            $service->image = $service_image;
            $service->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.services.index')->with('success','Service Successfully Added');
        } else {
            return redirect()->route('admin.services.create')->with('success','Service Successfully Added');
        }
    }

    /**
     * Display the specified service.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //dd($request->toArray());
        $request->validate([
            'name'  => 'required',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'price_without_tax' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'tax' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'tax_percentage' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
        ]);
        $data = $request->all();

        //calculate the total price
        $service->update($data);

        if ( $request->hasFile('image') ) {
            $service_image = 'service-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $service_image,'public');
            $service->image = $service_image;
        }
        
        if ( $service->save() ) {
            return redirect()->route('admin.services.index')->with('success','Service Updated');
        } else {
            return redirect()->route('admin.services.edit',$service->id)->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if( $service->delete() ){
            return back()->with('success', 'Service Deleted');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
}
