@extends('layouts.app')

@section('content')
<div class="insite-content">
    <div class="site-part">
        <div class="container">
            <div class="sec-title">
                <h1>Invited Users</h1>
            </div>
            <table class="table table-responsive-sm mt-4">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="75%">Email</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invitedUsers as $key => $user)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $user->invite_email }}</td>
                            <td>
                            @if ( $user->is_registered )
                                <span class="badge badge-success">Registered</span>
                            @else
                                <span class="badge badge-danger">Not Registered</span>
                            @endif</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center"> <strong>You haven't invited any users yet.</strong> </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="container">
            @include('partials.referral_block')
        </div>
    </div>
</div>
@endsection