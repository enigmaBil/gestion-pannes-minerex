@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="#">Accueil</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) signalé (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('panne.create')}}" class="small-box-footer">
                                    Signaler une panne <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) en cours de resolution</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Consulter les panne en cours de resolution <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-green">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) resolue (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('list.panne')}}" class="small-box-footer">
                                    Consulter la liste des pannes <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->

        <!-- /.content -->
    </div>
@endsection
