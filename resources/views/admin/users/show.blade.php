@extends('admin.layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('admin.users.index') }}">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <div class="">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $user->avatar_url }}"
                                alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username">{{ $user->name }}</h3>
                            @if ( $user->status == '1' )
                                <h5><span class="badge badge-success">Active</span></h4>
                            @else
                                <h5><span class="badge badge-danger">Deactive</span></h4>
                            @endif
                            <hr />
                            <p class="text-muted" title="Email Address"><i class="fas fa-envelope"></i> &nbsp;{{ $user->email }}</p>
                            <hr />
                            <p class="text-muted" title="Phone Number"><i class="fas fa-phone"></i> &nbsp;{{ $user->mobile_number }}</p>
                            <hr />
                            <p class="text-muted" title="Birth Date"><i class="fas fa-birthday-cake"></i> &nbsp;{{ date('d-m-Y', strtotime($user->birth_date)) }}</p>
                            <hr />
                            <p class="text-muted" title="Referral Code"><i class="fas fa-users"></i> &nbsp;{{ $user->referral_code }}</p>
                            <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-primary btn-block">Edit</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Address Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                    
                            <p class="text-muted">
                                {{ $user->address_line_1 ?? '' }}&nbsp;{{ $user->address_line_2 ?? '' }}
                            </p>
                            <strong>Postal Code</strong>
                            <p class="text-muted">{{ $user->postal_code ?? '-' }}</p>
                            <hr>
                    
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> City</strong>
                    
                            <p class="text-muted">{{ $user->city ?? '-' }}</p>
                    
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> State</strong>
                            <p class="text-muted"> {{ $user->state ?? '-'}} </p>
                    
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Country</strong>
                            <p class="text-muted">{{ $user->country ?? '-' }}</p>                            
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Documents</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @isset($user->consent_document)
                                <strong><i class="fas fa-file-alt mr-1"></i>Consent Document</strong>

                                <p class="text-muted">
                                    <a target="_blank" href="{{ route('get.document', $user->consent_document->document ) }}">Consent Document</a>
                                </p>
                            @endisset

                            @isset($user->cpr_document)
                                <strong><i class="fas fa-file-alt mr-1"></i>CPR Certificate</strong>

                                <p class="text-muted">
                                    <a target="_blank" href="{{ route('get.document', $user->cpr_document->document ) }}">CPR Certificate</a>
                                </p>
                            @endisset
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-9">
                <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Invite List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Is Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->invites as $key => $invite)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $invite->invite_email }}</td>
                                                <td>@if($invite->is_registered) Yes @else No @endif</td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">User has not invited any other users yet.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Services</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Service</th>
                                            <th>Subscription Date</th>
                                            <th>Expiry Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->subscriptions as $key => $subscription)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $subscription->service_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($subscription->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($subscription->ends_at)) }}</td>
                                                <td>
                                                    @if ( $subscription->status == 'subscribed' )
                                                        <h5><span class="badge badge-success">Active</span></h4>
                                                    @else
                                                        <h5><span class="badge badge-danger">Expired</span></h4>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">There are no services purchased by user.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Security Training Progress</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 0.5%">
                                            #
                                        </th>
                                        <th style="width: 38%">
                                            Chapter
                                        </th>
                                        <th style="width: 32%">
                                            Progress
                                        </th>
                                        <th style="width: 15%">
                                            Status
                                        </th>
                                        <th>
                                            Time
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ( $trainingChapters as $key => $chapter )
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $chapter->name }}</td>
                                        @if ( ! $chapter->study_log->isEmpty() )
                                            @if( $chapter->study_log->first()->is_finished )
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                                    </div>
                                                    100%
                                                </td>
                                                <td>
                                                    Completed
                                                </td>
                                                <td class="result_time_spent" data-sec="{{ $chapter->study_log->first()->time_spent }}">{{ $chapter->study_log->first()->time_spent ?? '' }}</td>
                                            @else
                                                <td class="disflexc">
                                                    <div class="progress cus-progress">
                                                        <div class="progress-bar bg-danger" style="width:{{ $chapter->study_log->first()->percentage }}%"></div>
                                                    </div>
                                                    {{ $chapter->study_log->first()->percentage }}%
                                                </td>
                                                <td> In Progress </td>
                                                <td class="result_time_spent" data-sec="{{ $chapter->study_log->first()->time_spent }}">{{ $chapter->study_log->first()->time_spent ?? '' }}</td>
                                            @endif
                                        @else
                                            <td class="disflexc">
                                                <div class="progress cus-progress">
                                                    <div class="progress-bar" style="width:0%"></div>
                                                </div>
                                                0%
                                            </td>
                                            <td>-</td>
                                            <td class=""> - </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>                    
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Quiz Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 55%">
                                            Chapter
                                        </th>
                                        <th style="width: 15%">
                                            Percentage
                                        </th>
                                        <th>
                                            Marks
                                        </th>
                                        <th>
                                            Result
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ( $trainingChapters as $key => $chapter )
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $chapter->name }}</td>
                                        @if ( ! $chapter->quiz_reports->isEmpty() )
                                            <td class="disflexc">
                                                {{ $chapter->quiz_reports->last()->percentage }}%
                                            </td>
                                            <td class="mw-td"><b>{{ $chapter->quiz_reports->last()->total_correct }}</b>/ {{ $chapter->quiz_reports->last()->total_questions }}</td>
                                            <td>{{ ucfirst( $chapter->quiz_reports->last()->result_status ) }}</td>
                                        @else
                                            <td class="disflexc">
                                                -
                                            </td>
                                            <td class="mw-td"><b>-</td>
                                            <td>Not Taken</td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                                @if ( ! $user->final_quiz->isEmpty() )
                                    <tr class="table-primary">
                                        <td>##</td>
                                        <td><strong>Final Quiz</strong></td>
                                        <td class="disflexc">
                                            {{ $user->final_quiz->last()->percentage }}%
                                        </td>
                                        <td class="mw-td"><b>{{ $user->final_quiz->last()->total_correct }}</b>/ {{ $user->final_quiz->last()->total_questions }}</td>
                                        <td>{{ ucfirst( $user->final_quiz->last()->result_status ) }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.result_time_spent').each(function(i, time){
            console.log(time);
            var time = $(this).attr('data-sec');
            $(this).text( ' '+secondsToPrettyTime(time) );
        });
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif
    });
</script>
@endsection