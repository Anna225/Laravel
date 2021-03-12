@extends('admin.layouts.app')

@section('title')
    Tutorial Slides
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Chapter: {{ $chapter->name }}</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.chapters.index') }}">Chapters</a></li>
                        <li class="breadcrumb-item active">Tutorial Slides</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary pull-right" href="{{ route("admin.slides.create",$chapter->id) }}">
                        Add Slide
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group" id="slide-list">
                        @forelse ($chapter->slides as $key => $slide)
                            <li class="draggable-item-list list-group-item d-flex justify-content-between align-items-center" id="slide_{{ $slide->id }}">
                                <div class="checkbox">
                                    <i class="fas fa-arrows-alt fa-fw handle" style="cursor:pointer"></i>
                                    {{ $slide->title }}
                                </div>
                                <div class="pull-right action-buttons">
                                    <a href="{{ route('admin.slides.edit',$slide->id) }}" title="Edit Slide"><i class="fa-fw fas fa-edit"></i></a> &nbsp;
                                    <a href="#" class="delete-slide" title="Delete Slide"><i class="fa-fw fas fa-trash"></i></a>
                                    <form class="delete-form-" action="{{ route('admin.slides.delete', $slide->id) }}" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @empty
                            <p>No Slides found.<p>
                        @endforelse
                        
                    </ul>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        $('.delete-slide').on('click', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                $(this).next().submit();
            }
        });

        $('#slide-list').sortable({
            axis: 'y',
            handle: ".handle",
            cursor: "move",
            stop : function(event, ui){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var data = $(this).sortable('serialize');
                $.ajax({
                    url: "{{ route('admin.slides.order') }}",
                    method: 'POST',
                    data: data,
                    success: function(result){
                        console.log(result);
                    }
                });
            }
        });
    });
</script>
@endsection