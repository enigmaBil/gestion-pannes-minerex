@extends('layouts.admin')
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
                                <li class="breadcrumb-item active">Liste des pannes </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row py-3 bg-white mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"> Panne: {{ $panne->code ? $panne->code : 'Non defini' }} </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            Code:<b> {{$panne->code ? $panne->code : 'Non defini'}}</b>
                                            <br>
                                            Titre: <b>{{$panne->name}}</b><br>
                                            Type: <b>{{$panne->type}}</b><br>
                                            Status: <b>{{$panne->status}}</b>

                                        </div>
                                        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Assigner la panne au technicien</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('panne.assignTechnician', $panne->id) }}">
                                                            @csrf
                                                            <!-- Row for Type and User -->
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <div class="mb-3">
                                                                        <label for="user" class="form-label">Choisir un technicien</label>
                                                                        <select class="form-control" name="user_id">
                                                                            <option selected>Choisir un utilisateur</option>
                                                                            @foreach ($users as $user)
                                                                                @if($user->hasRole('Technician'))
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
                                                                <div class="col-md">
                                                                    <button type="submit" class="btn btn-success form-control">Valider</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Annuler</button>
{{--                                                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <b>Description</b><br>
                                            <p>
                                                {{$panne->description}}
                                            </p>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            Signalée le: <b>{{$panne->reporting_date}}</b><br>
                                            <p>
                                                Utilisateur: <b>{{ $panne->user->last_name }} {{ $panne->user->first_name }}</b><br>
                                            </p>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default">
                                        Assigner la panne
                                    </button>
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
        </div>
    </div>
@endsection
