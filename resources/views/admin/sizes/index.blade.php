@extends('admin._layout.layout')
@section('seo_title', __('Sizes'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Sizes')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Sizes')</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('All Sizes')</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.sizes.add')}}" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>
                                @lang('Add new Size')
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="entities-list-table">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 40%;">@lang('Name')</th>
                                    <th class="text-center">@lang('Created At')</th>
                                    <th class="text-center">@lang('Last Change')</th>
                                    <th class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sizes as $size)
                                <tr>
                                    <td>#{{$size->id}}</td>
                                    <td>
                                        <strong>{{$size->name}}</strong>
                                    </td>
                                    <td class="text-center">{{$size->created_at}}</td>
                                    <td class="text-center">{{$size->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('admin.sizes.edit', ['size' => $size->id])}}" 
                                               class="btn btn-info"
                                               >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button 
                                                type="button"
                                                class="btn btn-info"
                                                data-toggle="modal"
                                                data-target="#delete-modal"

                                                data-action="delete"
                                                data-id="{{$size->id}}"
                                                data-name="{{$size->name}}"
                                                >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<form action="{{route('admin.sizes.delete')}}" method="post" class="modal fade" id="delete-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Size</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete size?</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->

@endsection

@push('footer_javascript')
<script type="text/javascript">
    $('#entities-list-table').on('click', '[data-action="delete"]', function (e) {
        // e.stopPropagation();
        // e.preventDefault();

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#delete-modal [name="id"]').val(id); //u necemu sto ima id delete-modal nadji ono sto ima name="id"

        $('#delete-modal [data-container="name"]').html(name);
    });
</script>
@endpush