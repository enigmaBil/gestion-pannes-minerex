@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste des Stocks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{ route('dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Liste des Stocks</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Boutons d'action -->
                <div class="row">
                    <div class="col-md-12 py-3">
                        <a href="{{ route('stock.create') }}" class="btn btn-success bg-gradient-success">
                            <i class="fas fa-plus-square"></i> Ajouter un Stock
                        </a>
                        <a href="{{route('stock.export.pdf')}}" class="btn btn-info bg-gradient-info float-right">
                            <i class="fas fa-file-export"></i> Exporter les Stocks
                        </a>
                    </div>
                </div>
                <!-- Table des Stocks -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste de tous les Stocks</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Succès: </strong> {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Description</th>
                                        <th>Quantité</th>
                                        <th>Emplacement</th>
                                        <th>Ajouté par</th>
                                        <th>Mis à jour par</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($stocks as $stock)
                                        <tr>
                                            <td>{{ $stock->product_name }}</td>
                                            <td>{{ Str::limit($stock->description, 15, '...') }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->location }}</td>
                                            <td>
                                                @if($stock->creator)
                                                    {{ $stock->creator->last_name }} {{ $stock->creator->first_name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($stock->updater)
                                                    {{ $stock->updater->last_name }} {{ $stock->updater->first_name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a class="text-muted" href="{{ route('stock.show', $stock->id) }}">
                                                    <i class="fas fa-eye fa-1x"></i>
                                                </a>
                                                <a class="text-primary mx-1" href="{{ route('stock.edit', $stock->id) }}">
                                                    <i class="fas fa-pen fa-1x"></i>
                                                </a>
                                                <form action="{{ route('stock.delete', $stock->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger border-0 bg-transparent" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock ?')">
                                                        <i class="fas fa-trash fa-1x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- Pagination (si nécessaire) --}}
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $stocks->links() }}
                                </div> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example2").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true, // Active la recherche
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });
    </script>
@endsection
