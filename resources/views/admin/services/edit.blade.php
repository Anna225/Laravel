@extends('admin.layouts.app')

@section('title')
    Edit {{ $service->name }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                        <li class="breadcrumb-item active">{{ $service->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @include('admin.partials.flash-message')
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-info">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.services.update', [$service->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" placeholder="Name" value="{{ $service->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-description" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="input-description" rows="3" required>{{ $service->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img src="{{ $service->image_url }}" class="img-thumbnail" width="100">        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-price_without_tax" class="col-sm-3 col-form-label">Price without tax</label>
                                    <div class="col-sm-9">
                                        <input name="price_without_tax" type="text" class="service-amount form-control @error('price_without_tax') is-invalid @enderror" id="input-price_without_tax" placeholder="Price without tax" value="{{ $service->price_without_tax }}">
                                        <small class="text-muted">Price without tax</small>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="input-tax_percentage" class="service-amount col-sm-3 col-form-label">Tax Percentage</label>
                                    <div class="col-sm-9">
                                        <input name="tax_percentage" type="text" class="service-amount form-control @error('tax_percentage') is-invalid @enderror" id="input-tax_percentage" placeholder="Tax Percentage" value="{{ $service->tax_percentage }}">
                                        <small class="text-muted"> In Percentage %</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-tax" class="col-sm-3 col-form-label">Tax Amount</label>
                                    <div class="col-sm-9">
                                        <input name="tax" type="text" class="form-control @error('tax') is-invalid @enderror" id="input-tax" placeholder="Tax" value="{{ $service->tax }}">
                                        <small class="text-muted">Tax Amount</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-price" class="col-sm-3 col-form-label">Total Price</label>
                                    <div class="col-sm-9">
                                        <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" id="input-price" placeholder="Price" value="{{ $service->price }}">
                                        <small class="text-muted">Price without tax + Tax</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a class="btn btn-primary" href="{{ route('admin.services.index') }}">&nbsp;Back&nbsp;</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
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

        $('.service-amount').on('input', function() {
            // get price and tax amount
            var total_price_without_tax = ( $('#input-price_without_tax').val() && $('#input-price_without_tax').val() !== '') ? $('#input-price_without_tax').val() : 0;
            var tax_percentage          = ( $('#input-tax_percentage').val() ) ? $('#input-tax_percentage').val() : 0;
            //var total_price             = ( $('#input-price').val() && $('#input-price').val() !== '') ? $('#input-price').val() : 0;

            var total_tax   = parseFloat(total_price_without_tax) * parseFloat(tax_percentage) / 100;
            var total_price = parseFloat(total_price_without_tax) + parseFloat(total_tax);

            // calculate the tax
            //var total_price_without_tax = parseFloat(total_price) - parseFloat(total_tax);
            
            // /Math.abs
            $('#input-tax').val(total_tax.toFixed(2));
            $('#input-price').val(Math.abs( total_price.toFixed(2) ));
            //$('#input-price_without_tax').val(Math.abs( total_price_without_tax.toFixed(2) ));
        });

    });
</script>
@endsection