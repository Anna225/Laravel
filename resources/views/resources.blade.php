@extends('layouts.app')

@section('content')
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>Resources</h1>
            </div>
            <table class="table table-responsive-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="25%">File name</th>
                        <th scope="col" width="60%">Description</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resources as $key => $resource)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->description }}</td>
                            <td><a href="{{ route('get.resource', $resource->file) }}"><button class="btn btn-primary btn-small">Download</button></a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center"> <strong>There are no resources available right now</strong> </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection