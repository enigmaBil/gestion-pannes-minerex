<nav class="main-header navbar navbar-expand  navbar-white navbar-light">
    <div class="container">
        @if (Auth::user()->hasRole('Employee'))
            <a href="{{route('employee.dashboard')}}" class="navbar-brand">
                <img src="{{asset('backend/dist/img/logo_minrex.png')}}" alt="Logo MINEREX" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text text-success font-weight-bold">MINEREX</span>
            </a>
        @endif
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            @if (!Auth::user()->hasRole('Employee'))
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            @endif
{{--            @if (Auth::user()->hasRole('Employee'))--}}
{{--                <li class="nav-item d-none d-sm-inline-block">--}}
{{--                    <a href="{{route('employee.dashboard')}}" class="nav-link"><i class="fas fa-home mr-2"></i> Accueil</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item d-none d-sm-inline-block">--}}
{{--                    <a href="#" class="nav-link">Contact</a>--}}
{{--                </li>--}}
{{--            @endif--}}
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            @if (Auth::user()->hasRole('Employee'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('employee.dashboard')}}" class="nav-link"><i class="fas fa-home mr-2"></i> Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-hands-helping"></i> Services
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="{{route('panne.index')}}" class="dropdown-item">
                            <i class="fas fa-eye"></i> Consulter la liste des pannes
                        </a>
                        <a href="{{route('panne.create')}}" class="dropdown-item">
                            <i class="fas fa-user-cog"></i> Signaler une panne
                        </a>

                    </div>
                </li>

            @endif
            @if (!Auth::user()->hasRole('Employee'))
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('notif.index')}}" class="nav-link">
                        <i class="far fa-bell"></i>
                        @if(Auth()->user()->unreadNotifications()->count()>0)
                            <span class="badge badge-info navbar-badge">{{Auth()->user()->unreadNotifications()->count()}}</span>
                        @endif
                    </a>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link image" data-toggle="dropdown" href="#">
                    Bienvenue {{Auth::user()->first_name}} <img src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : asset('backend/dist/img/profil.png') }}" class="img-circle elevation-2 mt-n1 mx-1" alt="User Image" style="height: 35px; width: 35px">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    {{--                <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
                    <div class="dropdown-divider"></div>
                    <a href="{{route('profile.edit')}}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"  style="background: none; border: none; color: inherit; cursor: pointer;">
                            <i class="fas fa-door-closed mr-2"></i> Deconnexion
                        </button>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
