@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajouter un technicien</h1><br>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreurs: </strong><br>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{route('dashboard')}}">Accueil</a></li>
                            <li class="breadcrumb-item"><a class="text-success" href="{{route('admin.users')}}">Utilisateurs</a></li>
                            <li class="breadcrumb-item active">Ajouter un technicien</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Ajout d'un technicien</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="createTEchnicianForm" method="POST" action="{{ route('technician.store') }}">
                            @csrf
                            <!-- Row for Type and User -->
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Utilisateur</label>
                                        <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                            <option  disabled>Choisir un utilisateur</option>
                                            @foreach ($users as $user)
                                                @if($user->hasRole('Employee'))
                                                    <option selected value="{{ $user->id }}">{{ $user->last_name }}
                                                        {{ $user->first_name }}
                                                    </option>
                                                @endif

                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span id="user_error" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <span id="user_error" class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="speciality" class="form-label">Spécialité</label>
                                        <input type="text" class="form-control @error('speciality') is-invalid @enderror" id="speciality" name="speciality" placeholder="Entrer la specialite du technicien">
                                    </div>
                                    @error('speciality')
                                    <span id="speciality_error" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="speciality_error" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="grade" class="form-label">Grade</label>
                                        <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" placeholder="Entrer le grade du technicien">
                                    </div>
                                    @error('grade')
                                    <span id="grade_error" class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="grade_error" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#createTEchnicianForm').on('submit', function(event) {
                console.log('Événement de soumission intercepté');
                // Empêche la soumission par défaut
                event.preventDefault();

                // Validation du formulaire
                if (validateForm()) {
                    // Soumettre le formulaire si tout est correct
                    this.submit();
                }
            });

            function validateForm() {
                let valid = true;
                // Clear previous errors and classes
                $('.invalid-feedback').html('');
                $('.form-control').removeClass('is-invalid').removeClass('is-valid');

                // Validate user
                const userId = $('#user_id').val();
                if (userId === '') {
                    $('#user_error').html('Le choix de l\'employe est obligatoire.');
                    $('#user_id').addClass('is-invalid'); // Ajoute la classe is-invalid
                    valid = false;
                } else {
                    $('#user_id').addClass('is-valid'); // Ajoute la classe is-valid
                }

                // Validate speciality
                const speciality = $('#speciality').val();
                if (speciality === '') {
                    $('#speciality_error').html('Ce champ est obligatoire');
                    $('#speciality').addClass('is-invalid'); // Ajoute la classe is-invalid
                    valid = false;
                } else {
                    $('#speciality').addClass('is-valid'); // Ajoute la classe is-valid
                }

                // Validate speciality
                const grade = $('#grade').val();
                if (speciality === '') {
                    $('#grade_error').html('Ce champ est obligatoire');
                    $('#grade').addClass('is-invalid'); // Ajoute la classe is-invalid
                    valid = false;
                } else {
                    $('#grade').addClass('is-valid'); // Ajoute la classe is-valid
                }

                return valid;
            }
        });
    </script>
@endsection
