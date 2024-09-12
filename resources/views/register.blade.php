<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Inscription">
    <meta name="keywords" content="gestion des pannes" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <style>
        body {
            background: url('{{ asset('backend/dist/img/bg_login.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.675);
            z-index: -1;
        }

        .login-box {
            position: relative;
            z-index: 1; /* Bring login box in front of the overlay */
        }
        .login-logo>img{
            width: 5rem;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box m-2">
    <div class="login-logo mt-3">
        <img src="{{asset('backend/dist/img/logo_minrex.png')}}" alt="Logo MINEREX">
    </div>
    <!-- /.login-logo -->
    <div class="card p-1">
        <div class="card-body login-card-body">
            <h3 class="login-box-msg">Inscription</h3>

            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" autofocus required placeholder="Votre Prenom">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required placeholder="Votre Nom">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" required placeholder="Votre Numero de telephone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone-square-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="email" name="email" value="{{ old('email') }}" required  class="form-control" placeholder="Votre adresse email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Votre mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">S'inscrire</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <p class="mb-0">
                Vous avez déjà un compte? <a href="{{route('login')}}" class="text-center text-success">Connectez-vous</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
