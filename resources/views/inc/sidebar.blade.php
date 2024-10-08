<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('backend/dist/img/logo_minrex.png')}}" alt="Logo MINEREX" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">MINEREX</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">Alexander Pierce</a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('list.panne') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-bug"></i>
                        <p>
                            Gestion Des Pannes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('list.panne') }}" class="nav-link {{ request()->routeIs('list.panne') ? 'active' : '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Consulter Les Pannes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create.panne') }}" class="nav-link {{ request()->routeIs('create.panne') ? 'active' : '' }}">
                                <i class="fa fa-bug nav-icon"></i>
                                <p>Signaler Une Panne</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            Gestion Interventions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="fa fa-cog nav-icon"></i>
                                <p>Creer Une Intervention</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Consulter Intervention</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->hasRole('Admin')||Auth::user()->hasRole('Lead_Technician'))
                    <li class="nav-item">
                        <a href="{{route('stock.index')}}" class="nav-link {{ request()->routeIs('stock.index') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-weight-hanging"></i>
                            <p>
                                Gestion De Stocks
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole('Admin'))
                <li class="nav-item">
                    <a href="{{route('admin.users')}}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Gestion Des Utilisateurs
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
