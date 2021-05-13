@extends('admin._layout.layout')
@section('seo_title', __('Edit product'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Edit product')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">@lang('Products')</a></li>
                    <li class="breadcrumb-item active">@lang('Edit product')</li>
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
                            @lang('Editing product')
                            #{{$product->id}}
                            -
                            {{$product->name}}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        role="form"
                        id="entity-form"
                        action="{{route('admin.products.update',['product' => $product->id])}}"
                        method="post"
                        enctype="multipart/form-data"
                        >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select 
                                            name="brand_id" 
                                            class="form-control @if($errors->has('brand_id')) is-invalid @endif">
                                            <option value="">
                                                -- Choose Brand --
                                            </option>
                                            @foreach(
                                            \App\Models\Brand::query()->orderBy('name')->get()
                                            as
                                            $brand
                                            )
                                            <option 
                                                value="{{$brand->id}}"
                                                @if($brand->id == old('brand_id', $product->brand_id))
                                                selected
                                                @endif
                                                >
                                                {{$brand->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors',[
                                        'fieldName' => 'brand_id'
                                        ])
                                    </div>
                                    <div class="form-group">
                                        <label>Product Category</label>
                                        <select name="product_category_id" 
                                                class="form-control @if($errors->has('product_category_id')) is-invalid @endif">
                                            <option value="">-- Choose Category --</option>
                                            @foreach($productCategories as $productCategory)
                                            <option 
                                                value="{{$productCategory->id}}"
                                                @if($productCategory->id == old('product_category_id', $product->product_category_id))
                                                selected
                                                @endif
                                                >
                                                {{$productCategory->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors',[
                                        'fieldName' => 'product_category_id'
                                        ])
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input 
                                            name="name"
                                            value="{{old('name', $product->name)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="Enter name"
                                            >
                                        @include('admin._layout.partials.form_errors',[
                                        'fieldName' => 'name'
                                        ])
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea
                                            name="description"
                                            class="form-control @if($errors->has('description')) is-invalid @endif" 
                                            placeholder="Enter Description"
                                            >{{old('description', $product->description)}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <div class="input-group">
                                            <input 
                                                name="price"
                                                value="{{old('price', $product->price)}}"
                                                type="number" 
                                                step="0.01"
                                                class="form-control @if($errors->has('price')) is-invalid @endif" 
                                                placeholder="Enter price"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            @include('admin._layout.partials.form_errors',[
                                            'fieldName' => 'price'
                                            ])
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Old Price</label>
                                        <div class="input-group">
                                            <input 
                                                name="old_price"
                                                value="{{old('old_price', $product->old_price)}}"
                                                type="number" 
                                                step="0.01"
                                                class="form-control @if($errors->has('old_price')) is-invalid @endif" 
                                                placeholder="Enter old prace"
                                                >
                                            <div class="input-group-append">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            @include('admin._layout.partials.form_errors',[
                                            'fieldName' => 'old_price'
                                            ])
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>On Index Page</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" 
                                                   id="on-index-page-no" 
                                                   name="index_page" 
                                                   value="0"
                                                   @if(0 == old('index_page', $product->index_page))
                                                   checked
                                                   @endif
                                                   class="custom-control-input"
                                                   >
                                            <label class="custom-control-label" for="on-index-page-no">No</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio"
                                                   id="on-index-page-yes" 
                                                   name="index_page" 
                                                   value="1"
                                                   @if(1 == old('index_page', $product->index_page))
                                                   checked
                                                   @endif
                                                   class="custom-control-input"
                                                   >
                                            <label class="custom-control-label" for="on-index-page-yes">Yes</label>
                                        </div>
                                        <div style="display: none" class="form-control @if($errors->has('index_page')) is-invalid @endif">
                                            @include('admin._layout.partials.form_errors',['fieldName' => 'index_page'])
                                        </div>
                                    </div>

                                    <div class="form-group select2-blue">
                                        <label>Sizes</label>
                                        <select 
                                            name="size_id[]"
                                            class="form-control @if($errors->has('size_id')) is-invalid @endif"
                                            multiple
                                            >
                                            @foreach($sizes as $size)
                                            <option 
                                                value="{{$size->id}}"
                                                @if(
                                                is_array(old('size_id', $product->sizes->pluck('id')->toArray()))
                                                &&
                                                in_array($size->id, old('size_id', $product->sizes->pluck('id')->toArray()))
                                                )
                                                selected
                                                @endif
                                                >{{$size->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors',['fieldName' => 'size_id'])

                                    </div>

                                    <div class="form-group">
                                        <label>Choose New Photo 1</label>
                                        <input 
                                            name="photo1"
                                            type="file"
                                            class="form-control @if($errors->has('photo1')) is-invalid @endif"
                                         >
                                        @include('admin._layout.partials.form_errors',['fieldName' => 'photo1'])
                                    </div>
                                    <div class="form-group">
                                        <label>Choose New Photo 2</label>
                                        <input 
                                            name="photo2"
                                            type="file" 
                                            class="form-control @if($errors->has('photo2')) is-invalid @endif"
                                        >
                                        @include('admin._layout.partials.form_errors',['fieldName' => 'photo2'])
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label>Details</label>
                                        <textarea
                                            name="details"
                                            class="form-control @if($errors->has('details')) is-invalid @endif" 
                                            placeholder="Enter Details"
                                            >{{old('description', $product->details)}}</textarea>
                                        @include('admin._layout.partials.form_errors',['fieldName' => 'details'])
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Photo 1</label>

                                                <div class="text-right">
                                                    <button 
                                                        name="photo1"
                                                        type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-action="delete-photo"
                                                        data-photo ="photo1"
                                                    >
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
                                                        src="{{$product->getPhoto1Url()}}" 
                                                        alt="" 
                                                        class="img-fluid"
                                                        data-container="photo1"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Photo 2</label>

                                                <div class="text-right">
                                                    <button 
                                                        name="photo2"
                                                        type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-action="delete-photo"
                                                        data-photo="photo2"
                                                     >
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
                                                        src="{{$product->getPhoto2Url()}}" 
                                                        alt="" 
                                                        class="img-fluid"
                                                        data-container="photo2"
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
                            <a href="{{route('admin.products.index')}}" class="btn btn-outline-secondary">Cancel</a>
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
<script src="/themes/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/themes/admin/plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    
    $('#entity-form [name="details"]').ckeditor({
        "height": "400px",
        "filebrowserBrowseUrl": "{{route('elfinder.ckeditor')}}"
        //"allowedContent": true,
        //"contentsCss": [
        //    "{url('/themes/front/style.css')}"
        //]
    });
    
    $('#entity-form').on('click', '[data-action="delete-photo"]', function(e){
        e.preventDefault();
        
        let photo = $(this).attr('data-photo'); //bice ili photo1 ili photo2
        
        $.ajax({
            "url": "{{route('admin.products.delete_photo', ['product' => $product->id])}}",
            "type": "post",
            "data":{
                "_token":"{{csrf_token()}}",
                "photo": photo
            }
        }).done(function(response){
            toastr.success(response.system_message);
            $('img[data-container = "' + photo + '"]').attr('src', response.photo_url);
        }).fail(function(){
            toastr.error('Error while deleteing photo');
        });
    });

    $('#entity-form [name="brand_id"]').select2({
        "theme": 'bootstrap4'
    });
    
    $('#entity-form [name="product_category_id"]').select2({
        "theme": 'bootstrap4'
    });
    
    $('#entity-form [name="size_id[]"]').select2({
        "theme": 'bootstrap4'
    });

    $('#entity-form').validate({
        rules: {
            "brand_id": {
                "required": true
            },
            "product_category_id": {
                "required": true
            },
            "name": {
                "required": true,
                "maxlength": 255
            },
            "description": {
                "maxlength": 2000
            },
            "price": {
                "required": true,
                "min": 0.01
            },
            "old_price": {
                "min": 0.01
            },
            "index_page": {
                "required": true
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