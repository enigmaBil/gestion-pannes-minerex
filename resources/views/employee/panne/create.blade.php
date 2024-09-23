@extends('layouts.employee')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container py-2">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gestion des pannes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-success" href="{{route('employee.dashboard')}}">Accueil</a></li>
                                <li class="breadcrumb-item active">Signaler une panne</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container">

                    @if (session('success'))
                        <div class="row py-3 bg-white my-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="row p-3  bg-white my-2">
                            <div class=" col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreurs: </strong><br>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row py-3 bg-white my-2 ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"> Signaler une panne </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <form method="POST" action="{{ route('panne.store') }}">
                                        @csrf
                                        <!-- Name field -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Titre</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Licence office expiree">
                                        </div>

                                        <!-- Description field -->
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Entrer la description"></textarea>
                                        </div>

                                        <!-- Row for Type and User -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select class="form-control" name="type">
                                                        <option selected>Choisir un type</option>
                                                        <option value="matériel">Matériel</option>
                                                        <option value="logiciel">Logiciel</option>
                                                        <option value="réseau">Réseau</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
{{--                                                    <label for="user" class="form-label">Utilisateur</label>--}}
                                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden="hidden">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success">Signaler</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
