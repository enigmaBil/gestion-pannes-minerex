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
                                    <h3 class="card-title"> Pannes signalées </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="list-group">
                                        @forelse ($notifications as $notification)

                                            <li class="list-group-item">
                                                <a href="{{route('notif.show', $notification->id)}}" class=" text-bold" style="color: #818182!important;">
                                                    {{ $notification->data['titre'] }}
                                                </a>
                                                <span class="float-right">
{{--                                                    <a title="Marquer comme lu" href="#" >--}}
{{--                                                        <i class="fas fa-check-square fa-1x"></i>--}}
{{--                                                    </a>--}}
                                                    <a title="Supprimer" class="text-danger ml-1" href="">
                                                        <i class="fas fa-trash fa-1x"></i>
                                                    </a>
                                                </span>


                                            </li>
                                        @empty
                                            <li class="list-group-item">Aucune notification</li>
                                        @endforelse
                                    </ul>
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
