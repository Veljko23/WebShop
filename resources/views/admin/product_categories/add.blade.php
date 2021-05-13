@extends('admin._layout.layout')
@section('seo_title', __('Product Categories'))
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Add Product Category')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.product_categories.index')}}">@lang('Product Categories')</a></li>
                    <li class="breadcrumb-item active">@lang('Product Categories Form')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Enter data for new Product Category')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.product_categories.insert')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input 
                                    type="text"
                                    name="name"
                                    value="{{old('name')}}"
                                    class="form-control @if($errors->has('name')) is-invalid @endif" 
                                    placeholder="@lang('Enter name')"
                                >
                                @include('admin._layout.partials.form_errors', [
                                    'fieldName' => 'name'
                                ])
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea 
                                    class="form-control @if($errors->has('description')) is-invalid @endif)" 
                                    name="description"
                                    placeholder="@lang('Enter description')"
                                >{{old('description')}}</textarea>
                                @include('admin._layout.partials.form_errors', [
                                    'fieldName' => 'description'
                                ])
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang('Save')</button>
                            <a class="btn btn-outline-secondary" href="{{route('admin.product_categories.index')}}">@lang('Cancel')</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection