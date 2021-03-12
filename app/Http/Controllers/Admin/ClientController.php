<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clients.index');
    }

    /**
     * Load the client data for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadClients()
    {
        $clients = Client::query();

        return Datatables::of($clients)
                ->editColumn('image_url', function(Client $client) {
                    return '<img class="img-thumbnail" src="'.$client->image_url.'" />';
                })
                ->editColumn('link', function(Client $client) {
                    return '<a target="_blank" href="'.$client->link.'" />'.$client->link.'</a>';
                })
                ->addColumn('action', function (Client $client) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.clients.show', $client->id).'"><i class="fas fa-fw fa-eye"></i>View</a>
                    <a class="btn btn-info btn-sm" href="'.route('admin.clients.edit', $client->id).'"> <i class="fas fa-fw fa-pencil-alt"></i>Edit</a>
                    <button class="btn btn-danger btn-sm delete-client" data-remote="/admin/clients/'.$client->id.'"> <i class="fas fa-fw fa-trash-alt"></i>Delete</button>';
                })
                ->rawColumns(['action','image_url','link'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
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
            'name'  => 'required',
            'link'  => "required|url",
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1500',
        ]);

        $client = Client::create($request->all());

        if ( $request->hasFile('image') ) {
            $client_image = 'client-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $client_image,'public');
            $client->image = $client_image;
            $client->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.clients.index')->with('success','Client Successfully Added');
        } else {
            return redirect()->route('admin.clients.create')->with('success','Client Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'  => 'required',
            'link'  => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1500',
        ]);

        $client->update($request->all());

        if ( $request->hasFile('image') ) {
            $client_image = 'client-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $client_image,'public');
            $client->image = $client_image;
        }

        if ( $client->save() ) {
            return redirect()->route('admin.clients.index')->with('success', 'Client updated');
        } else {
            return redirect()->route('admin.clients.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if( $client->delete() ){
            return Response(['status'=>'success', 'message'=>'Client Deleted']);
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }
}
