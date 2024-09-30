@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mise a jour de la panne : {{$panne->name}}</h1><br>
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
                            <li class="breadcrumb-item "><a class="text-success" href="{{route('list.panne')}}">gestion des pannes</a> </li>
                            <li class="breadcrumb-item active">Mise a jour de la panne</li>
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
                        <h3 class="card-title">Mise a jour</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.panne', $panne->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- Name field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$panne->name}}" placeholder="Ex: Licence office expiree">
                            </div>

                            <!-- Description field -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{$panne->description}}</textarea>
                            </div>

                            <!-- Row for Type and User -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-control" name="type">
                                            <option value="{{$panne->type}}" selected>{{$panne->type}}</option>
                                            <option value="matériel">Matériel</option>
                                            <option value="logiciel">Logiciel</option>
                                            <option value="réseau">Réseau</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Utilisateur</label>
                                        <select class="form-control" name="user_id">
                                            <option value="{{$panne->user_id}}" selected>{{$panne->user->last_name}}</option>
                                            @foreach ($users as $user)
                                                @if(Auth::user()->hasRole('Employee'))
                                                    <option value="{{ $user->id }}">{{ $user->last_name }}
                                                        {{ $user->first_name }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success form-control">Valider</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-danger form-control">Reinitialiser</button>
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
