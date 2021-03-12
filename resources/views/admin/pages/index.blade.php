@extends('admin.layouts.app')

@section('title')
    Pages
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
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
                    <a class="btn btn-primary pull-right" href="{{ route("admin.pages.create") }}">
                        Add Page
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-striped projects table-responsive">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 70%">
                                    Title
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>
                                        {{ $page->id }}
                                    </td>
                                    <td>
                                        {{ $page->title }}
                                    </td>
                                    <td class="project-actions ">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.pages.edit', $page->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <form class="delete-page" action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pages->links() }}
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('footer_scripts')
<script>
    $(document).ready(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}')
        @endif

        @if ($message = Session::get('error'))
            toastr.error('{{ $message }}')
        @endif

        $('.delete-page').on('submit', function(e){
            e.preventDefault();
            if ( confirm("Are you sure want to delete?") ) {
                this.submit();
            }
        });
    });
</script>
@endsection