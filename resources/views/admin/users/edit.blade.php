@extends('admin._layout.layout')

@section('seo_title', __('Edit User'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Edit User')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">@lang('Home')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.users.index')}}">@lang('Users')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Edit User')
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang('Editing user')
                            #{{$user->id}}
                            -
                            {{$user->name}}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form"
                        action="{{route('admin.users.update', ['user' => $user->id])}}"
                        method="post"
                        enctype="multipart/form-data"
                        role="form"
                        >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>

                                        <div class="input-group">
                                            <input 
                                                name="email"
                                                value="{{old('email', $user->email)}}"
                                                type="email" 
                                                class="form-control @if($errors->has('email')) is-invalid @endif" 
                                                placeholder="Enter email"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    @
                                                </span>
                                            </div>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'email'])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input 
                                            name="name"
                                            value="{{old('name', $user->name)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="Enter name"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'name'])
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="input-group">
                                            <input 
                                                name="phone"
                                                value="{{old('phone', $user->phone)}}"
                                                type="text" 
                                                class="form-control @if($errors->has('phone')) is-invalid @endif" 
                                                placeholder="Enter phone"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                            </div>
                                            @include('admin._layout.partials.form_errors', ['fieldName' => 'phone'])
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Choose New Photo</label>
                                        <input 
                                            name="photo" 
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                    </div>
                                </div>
                                <div class="offset-md-3 col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Photo</label>

                                                <div class="text-right">
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-action="delete-photo"
                                                        >
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
                                                        src="{{$user->getPhotoUrl()}}" 
                                                        alt="" 
                                                        class="img-fluid"
                                                        data-container="photo"
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
                            <a href="{{route('admin.users.index')}}" class="btn btn-outline-secondary">Cancel</a>
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

@push('footer_javascript')
<script type="text/javascript">

    $('#entity-form').on('click', '[data-action="delete-photo"]', function (e) {
        e.preventDefault();

        let photo = $(this).attr('data-photo'); //'photo1' ili 'photo2'

        $.ajax({
            "url": "{{route('admin.users.delete_photo', ['user' => $user->id])}}",
            "type": "post",
            "data": {
                "_token": "{{csrf_token()}}"
            }
        }).done(function (response) {

            toastr.success(response.system_message);

            $('img[data-container="photo"]').attr('src', response.photo_url);

        }).fail(function () {
            toastr.error('Error while deleteing photo');
        });
    });

    $('#entity-form').validate({
        rules: {
            "email": {
                "required": true,
                "maxlength": 255,
                "email": true
            },
            "name": {
                "required": true,
                "maxlength": 255
            },
            "phone": {
                "required": false,
                "maxlength": 255
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