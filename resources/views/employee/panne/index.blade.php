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
                                <li class="breadcrumb-item active">Liste des pannes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 py-2 bg-white">
                            <a href="{{route('panne.create')}}" class="btn btn-success bg-gradient-success text-white" style="color: #fff !important;"><i class="fas fa-plus-square"></i> Signaler une panne</a>

                        </div>
                    </div>
                    <div class="row py-3 bg-white mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"> Mes pannes signalées </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table-panne" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Date de signalisation</th>
                                            <th>Date de resolution</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if($pannes->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">Aucune panne signalée pour le moment.</td>
                                            </tr>
                                        @else
                                            @foreach ($pannes as $panne)
                                                <tr>
                                                    <td>{{ Str::limit($panne->name, 10, ' ...') }}</td>
                                                    <td>{{ Str::limit($panne->description, 20, ' ...') }}</td>
                                                    <td>{{ $panne->type }}</td>
                                                    <td>{{ $panne->reporting_date }}</td>
                                                    <td>
                                                        @if($panne->resolution_date !== null)
                                                            {{ $panne->resolution_date }}
                                                        @else
                                                            <span class="badge badge-danger">Non résolue</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($panne->status == 'en attente')
                                                            <span class="badge badge-warning text-white">{{ $panne->status }}</span>
                                                        @elseif($panne->status == 'en cours')
                                                            <span class="badge badge-info">{{ $panne->status }}</span>
                                                        @elseif($panne->status == 'résolue')
                                                            <span class="badge badge-success">{{ $panne->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
{{--                                                        <a class="text-muted " href="">--}}
{{--                                                            <i class="fas fa-pen fa-1x"></i>--}}
{{--                                                        </a>--}}
                                                        <a class="text-muted mx-1" href="">
                                                            <i class="fas fa-eye fa-1x"></i>
                                                        </a>
                                                        @if($panne->status == 'résolue')
                                                            <a class="text-danger" href="">
                                                                <i class="fas fa-trash fa-1x"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>
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
@section('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#table-panne').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
            });
        });
    </script>
@endsection
