<?php

namespace App\Http\Controllers\Admin;

use App\Resource;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.resources.index');
    }

    /**
     * Load the resources data for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadResources()
    {
        $resources  = Resource::query();

        return Datatables::of($resources)
                ->editColumn('file', function(Resource $resource) {
                    return '<a href="'.route('get.resource', $resource->file).'" />'.$resource->file.'</a>';
                })
                ->addColumn('action', function (Resource $resource) {
                    return '<a class="btn btn-info btn-sm" href="'.route('admin.resources.edit', $resource->id).'"> <i class="fas fa-fw fa-pencil-alt"></i>Edit</a>
                    <button class="btn btn-danger btn-sm delete-resource" data-remote="'.route('admin.resources.destroy', $resource->id).'"> <i class="fas fa-fw fa-trash-alt"></i>Delete</button>';
                })
                ->rawColumns(['action','file'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'file'        => 'required|mimes:jpg,jpeg,png,doc,docx,pdf,ppt,txt',
            'description' => 'nullable|string',
        ]);

        $resource = Resource::create($request->all());

        if ( $request->hasFile('file') ) {
            $resourceFile = 'resource-'.time().'.'.$request->file('file')->extension();
            $request->file->storeAs('resources', $resourceFile);
            $resource->file = $resourceFile;
            $resource->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.resources.index')->with('success','Resource Successfully Uploaded');
        } else {
            return redirect()->route('admin.resources.create')->with('success','Resource Successfully Uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        // not available for now
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required|string',
            'file'        => 'required|mimes:jpg,jpeg,png,doc,docx,pdf,ppt,txt',
        ]);

        $resource->update($request->all());

        if ( $request->hasFile('file') ) {
            $resource = 'resource-'.time().'.'.$request->file('file')->extension();
            $request->file->storeAs('resources', $resource,'public');
            $resource->file = $resource;
        }

        if ( $resource->save() ) {
            return redirect()->route('admin.resources.index')->with('success', 'Resource updated');
        } else {
            return redirect()->route('admin.resources.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        if( $resource->delete() ){
            return Response(['status'=>'success','message'=>'Resource deleted']);  
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }

    /**
     * return the requested file
     *
     * @param  int  $filename
     * @return File
     */
    public function getResource($filename)
    {
        $path = storage_path().'/'.'app/resources/'.$filename;
        return response()->download($path, null, [], null);
    }

    /**
     * Display a listing of the resource on frontend
     *
     * @return \Illuminate\Http\Response
     */
    public function showResources()
    {
        $resources = Resource::get();
        return view('resources', compact('resources'));
    }
}
