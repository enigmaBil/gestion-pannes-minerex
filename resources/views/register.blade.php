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
            margin: 0; /* Supprime la marge par défaut du body */
            height: 100vh; /* Assure que le body prend toute la hauteur de la vue */
            position: relative; /* Permet à l'overlay d'être positionné par rapport au body */
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
        .register-page {
            align-items: center !important;
            background-color: #e9ecef !important;
            display: flex !important;
            flex-direction: column !important;
            height: 100vh !important;
            justify-content: center !important;
        }
        .min-height-class {
            min-height: 120vh !important; /* Le style ajouté dynamiquement */
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
<body class="hold-transition register-page" >
<div class="login-box m-2">
    <div class="login-logo mt-3">
        <img src="{{asset('backend/dist/img/logo_minrex.png')}}" alt="Logo MINEREX">
    </div>
    <!-- /.login-logo -->
    <div class="card p-1">
        <div class="card-body login-card-body">
            <h3 class="login-box-msg">Inscription</h3>

            <form id="registrationForm" action="{{route('register')}}" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" autofocus  placeholder="Votre Prenom">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('first_name')
                    <span id="first_name_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="first_name_error" class="invalid-feedback" role="alert"></span>
                </div>

                <div class="input-group mb-2">
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Votre Nom">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('last_name')
                    <span id="last_name_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="last_name_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="input-group mb-2">
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror"  placeholder="Votre Numero de telephone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone-square-alt"></span>
                        </div>
                    </div>
                    @error('phone')
                    <span id="phone_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="phone_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="input-group mb-2">
                    <input type="email" name="email" id="email" value="{{ old('email') }}"   class="form-control @error('email') is-invalid @enderror" placeholder="Votre adresse email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span id="email_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="email_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Votre mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span id="password_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="password_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <span id="password_confirmation_error" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="password_confirmation_error" class="invalid-feedback" role="alert"></span>
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
<script>
    $(document).ready(function() {
        $('#registrationForm').on('submit', function(event) {
            console.log('Événement de soumission intercepté');
            // Empêche la soumission par défaut
            event.preventDefault();
            // Ajouter le style à la soumission du formulaire
            $('.register-page').addClass('min-height-class');
            // Validation du formulaire
            if (validateForm()) {
                // Retirer le style si des erreurs sont présentes
                $('.register-page').removeClass('min-height-class');
                // Soumettre le formulaire si tout est correct
                this.submit();
            }
        });

        function validateForm() {
            let valid = true;
            const phoneRegex = /^[6][0-9]{8}$/;

            console.log('Validation déclenchée');

            // Clear previous errors and classes
            $('.invalid-feedback').html('');
            $('.form-control').removeClass('is-invalid').removeClass('is-valid');

            // Validate first name
            const firstName = $('#first_name').val();
            if (firstName === '') {
                $('#first_name_error').html('Le prénom est requis');
                $('#first_name').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else {
                $('#first_name').addClass('is-valid'); // Ajoute la classe is-valid
            }

            // Validate last name
            const lastName = $('#last_name').val();
            if (lastName === '') {
                $('#last_name_error').html('Le nom est requis');
                $('#last_name').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else {
                $('#last_name').addClass('is-valid'); // Ajoute la classe is-valid
            }

            // Validate phone number
            const phone = $('#phone').val();
            if (!phoneRegex.test(phone)) {
                $('#phone_error').html('Numéro de téléphone invalide. Il doit commencer par 6 et contenir exactement 9 chiffres');
                $('#phone').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else {
                $('#phone').addClass('is-valid'); // Ajoute la classe is-valid
            }

            // Validate email
            const email = $('#email').val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $('#email_error').html('Adresse email invalide');
                $('#email').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else {
                $('#email').addClass('is-valid'); // Ajoute la classe is-valid
            }

            // Validate password
            const password = $('#password').val();
            if (password.length < 8) {
                $('#password_error').html('Le mot de passe doit contenir au moins 8 caractères');
                $('#password').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else {
                $('#password').addClass('is-valid'); // Ajoute la classe is-valid
            }

            // Validate password confirmation
            // Validate password confirmation only if password is filled
            const passwordConfirmation = $('#password_confirmation').val();
            if (password !== passwordConfirmation && password !== '') {
                $('#password_confirmation_error').html('Les mots de passe ne correspondent pas');
                $('#password_confirmation').addClass('is-invalid'); // Ajoute la classe is-invalid
                valid = false;
            } else if (password !== '') {
                $('#password_confirmation').addClass('is-valid'); // Ajoute la classe is-valid si le mot de passe est rempli
            }

            return valid;
        }
    });


</script>

</body>
</html>
