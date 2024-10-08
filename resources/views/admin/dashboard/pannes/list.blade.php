@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste des pannes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{route('dashboard')}}">Accueil</a></li>
                            <li class="breadcrumb-item active">Liste des pannes</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 py-3">
                        <a href="{{route('create.panne')}}" class="btn btn-success bg-gradient-success">
                            <i class="fas fa-plus-square"></i> Signaler une panne
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Consultation des pannes </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Utilisateur</th>
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
                                        @if($pannes === null)
                                            <p>Aucune panne signalée pour le moment.</p>
                                        @else
                                            @foreach ($pannes as $panne)
                                                <tr>
                                                    <td>{{ $panne->user->last_name }} {{ $panne->user->first_name }} </td>
                                                    <td>{{ Str::limit($panne->name, 10, ' ...') }}</td>
                                                    <td>{{ Str::limit($panne->description, 20, ' ...') }}</td>
                                                    <td>{{ $panne->type }}</td>
                                                    <td>{{ $panne->reporting_date }}</td>
                                                    <td>
                                                        @if($panne->resolution_date !== null)
                                                            {{ $panne->resolution_date}}
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
                                                        <a class="text-muted" style="font-size: 12px" href="{{ route('show.panne', $panne->id) }}">
                                                            <i class="fas fa-eye fa-1x"></i>
                                                        </a>
                                                        <a class="text-primary mx-1" style="font-size: 12px" href="{{ route('edit.panne', $panne->id) }}">
                                                            <i class="fas fa-pen fa-1x"></i>
                                                        </a>
                                                        <form action="{{ route('delete.panne', $panne->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="font-size: 12px" class="text-danger border-0 bg-transparent" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette panne ?')">
                                                                <i class="fas fa-trash fa-1x"></i>
                                                            </button>
                                                        </form>
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
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "pageLength":5,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });
    </script>
@endsection
