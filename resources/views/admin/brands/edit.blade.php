@extends('admin._layout.layout')
@section('seo_title', __('Edit brand'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Edit brand')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.brands.index')}}">@lang('Brands')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit brand')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang('Editing brand ') : 
                            #{{$brand->id}} 
                            - 
                            {{$brand->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" 
                          action="{{route('admin.brands.update', ['brand' => $brand->id])}}" 
                          method="post" 
                          id="entity-form"
                          enctype="multipart/form-data"
                          >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input 
                                            type="text"
                                            name="name" 
                                            value="{{old('name', $brand->name)}}"
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="Enter name"
                                            >

                                        @include('admin._layout.partials.form_errors', [
                                        'fieldName' => 'name'
                                        ])

                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input 
                                            type="url"
                                            name="website" 
                                            value="{{old('website', $brand->website)}}"
                                            class="form-control @if($errors->has('website')) is-invalid @endif" 
                                            placeholder="Enter website url"
                                            >

                                        @include('admin._layout.partials.form_errors', [
                                        'fieldName' => 'website'
                                        ])
                                    </div>
                                    <div class="form-group">
                                        <label>Choose New Photo</label>
                                        <input 
                                            name="photo"
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                            >
                                        @include('admin._layout.partials.form_errors', [
                                        'fieldName' => 'photo'
                                        ])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Photo</label>

                                                <div class="text-right">
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-action="delete_photo"
                                                        
                                                    >
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img
                                                        src="{{$brand->getPhotoUrl()}}" 
                                                        alt="" 
                                                        class="img-fluid"
                                                        data-container="photo-preview"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{route('admin.brands.index')}}" class="btn btn-outline-secondary">Cancel</a>
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

@endsection

@push('footer_javascript')

<script type="text/javascript">
    
    $('#entity-form').on('click', '[data-action="delete_photo"]', function(e){
        e.preventDefault();
        
        $.ajax({
            "url": "{{route('admin.brands.delete_photo', ['brand' => $brand->id])}}",
            "type": "post",
            "data": {
                "_token": "{{csrf_token()}}"
            }
        }).done(function(response){
            
            toastr.success(response.system_message);
            
            $('[data-container="photo-preview"]').attr('src', response.photo_url); //setuj src na ono sto je dobijeno sa response u kontroleru
            
        }).fail(function(){
            toastr.error('Error while deleted photo');
            
        });
    });

    $('#entity-form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 10
            },
            "website": {
                required: false,
                url: true
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>

@endpush