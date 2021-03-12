@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $data->users->count() }}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Members</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                @foreach ($data->users as $key => $user)
                                    <li>
                                        <img src="{{ $user->avatar_url }}" alt="User Image" width="80">
                                        <a class="users-list-name" href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                                        <span class="users-list-date">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</span>
                                    </li>
                                    @if ($key == 7)
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.users.index') }}">View All Users</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!--/.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    {{-- <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Recent Schedules</h3>
                    
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Updated at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->schedule_users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse( $user->schedules->last()->updated_at )->format('d-m-Y') }}</td>
                                                <td><a class="btn btn-primary btn-sm" href="{{ route('admin.schedules.show', $user->id) }}">
                                                    <i class="fas fa-eye fa-fw"></i>
                                                    View / Edit </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="">View All</a>
                        </div>
                        <!-- /.card-footer -->
                    </div> --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection