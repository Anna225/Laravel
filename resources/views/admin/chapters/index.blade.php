@extends('admin.layouts.app')

@section('title')
    Security Training Chapters
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Security Training Chapters</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Training chapters</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route("admin.chapters.create") }}">
                        Add Chapter
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group" id="chapter-list">
                        @foreach ($chapters as $key =>  $chapter)
                            <li class="draggable-item-list list-group-item d-flex justify-content-between align-items-center" id="chapter_{{ $chapter->id }}">
                                <div class="checkbox">
                                    <i class="fas fa-arrows-alt fa-fw handle" style="cursor:pointer"></i>
                                    {{ $chapter->name }}
                                </div>
                                <div class="pull-right action-buttons">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('admin.slides.index',$chapter->id) }}" title="View Slides"><i class="fas fa-images"></i> Slides</a> &nbsp;
                                    <a class="btn btn-secondary btn-sm" href="{{ route('admin.questions',$chapter->id) }}" title="View Questions"><i class="fas fa-fw fa-tasks"></i>Questions</a> &nbsp;|&nbsp; 
                                    <a class="btn btn-secondary btn-sm" href="{{ route('admin.chapters.show',$chapter->id) }}" title="View Chapter"><i class="fas fa-fw fa-eye"></i></a> 
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.chapters.edit',$chapter->id) }}" title="Edit Chapter"><i class="fas fa-fw fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm delete-chapter" href="#" title="Delete Chapter"><i class="fa-fw fas fa-trash"></i></a>
                                    <form class="delete-form-" action="{{ route('admin.chapters.destroy', $chapter->id) }}" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endforeach
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

        $('.delete-chapter').on('click', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                $(this).next().submit();
            }
        });

        $('#chapter-list').sortable({
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
                    url: "{{ route('admin.chapters.order') }}",
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