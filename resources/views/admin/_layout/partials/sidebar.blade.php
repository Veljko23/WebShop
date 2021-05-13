<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/themes/admin/dist/img/AdminLTELogo.png" alt="Cubes School Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Cubes School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Sizes')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.sizes.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Sizes list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sizes.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Size')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Product Categories')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.product_categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Product categories list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.product_categories.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add product category')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Brands')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.brands.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Brands list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.brands.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Brand')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Products')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Products list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Product')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Users')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Users list')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add User')</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>