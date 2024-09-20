@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajouter un chef technicien</h1><br>
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
                            <li class="breadcrumb-item active">Ajouter un chef technicien</li>
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
                        <h3 class="card-title">Ajout d'un chef technicien</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('lead.technician.store') }}">
                            @csrf
                            <!-- Row for Type and User -->
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Utilisateur</label>
                                        <select class="form-control" name="technician_id" id="user_id" onchange="updateTechnicianFields()">
                                            <option selected value="">Choisir un utilisateur</option>
                                            @foreach ($techniciens as $technicien)
                                                <option  value="{{ $technicien->id }}">{{ $technicien->user->last_name }}
                                                    {{ $technicien->user->first_name }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="speciality" class="form-label">Spécialité</label>
                                        <input type="text" class="form-control" id="speciality" name="speciality" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="grade" class="form-label">Grade</label>
                                        <input type="text" class="form-control" id="grade" name="grade" value="">
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Valider</button>
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
        function updateTechnicianFields() {
            let userId = $('#user_id').val();
            let technicianData = @json($techniciens);
            console.log(technicianData);
            let selectedTechnician = technicianData.find(function(tech) {
                return tech.id == userId;
            });
            console.log(selectedTechnician);
            if (selectedTechnician) {
                $('#speciality').val(selectedTechnician.speciality);
                $('#grade').val(selectedTechnician.grade);
            } else {
                $('#speciality').val('');
                $('#grade').val('');
            }
        }
    </script>
@endsection
