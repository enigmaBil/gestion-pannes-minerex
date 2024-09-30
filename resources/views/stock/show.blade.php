@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Détail du Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{ route('dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a class="text-success" href="{{ route('stock.index') }}">Stocks</a></li>
                            <li class="breadcrumb-item active">Détail du Stock</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Card pour le détail du stock -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Informations sur le Stock</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Nom du Produit:</strong>
                                <p>{{ $stock->product_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Quantité:</strong>
                                <p>{{ $stock->quantity }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Description:</strong>
                                <p>{{ $stock->description }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Emplacement:</strong>
                                <p>{{ $stock->location }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Ajouté par:</strong>
                                <p>
                                    @if($stock->creator)
                                        {{ $stock->creator->last_name }} {{ $stock->creator->first_name }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Mis à jour par:</strong>
                                <p>
                                    @if($stock->updater)
                                        {{ $stock->updater->last_name }} {{ $stock->updater->first_name }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-primary">Modifier</a>
                                <a href="{{ route('stock.index') }}" class="btn btn-secondary">Retour</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
