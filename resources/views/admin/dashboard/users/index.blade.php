@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste des utilisateurs</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{route('dashboard')}}">Accueil</a></li>
                            <li class="breadcrumb-item active">Liste du personnel</li>
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
                        <a href="{{route('technician.create')}}" class="btn btn-success bg-gradient-success">
                            <i class="fas fa-user-plus"></i> Ajouter un technicien
                        </a>
                        <a href="{{route('lead.technician.create')}}" class="btn btn-success bg-gradient-success">
                            <i class="fas fa-user-plus"></i> Ajouter un chef technicien
                        </a>
                        <a href="#" class="btn btn-info bg-gradient-info float-right">
                            <i class="fas fa-user-cog"></i> Gestion des permissions
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Liste de tout le personnel </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Noms</th>
                                        <th>Prenoms</th>
                                        <th>Emails</th>
                                        <th>Téléphone</th>
                                        <th>Direction</th>
                                        <th>Catégories</th>
                                        <th>Photos</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->last_name }}  </td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->departement }}</td>
                                            <td>
                                                @if($user->hasRole('Admin'))
                                                    Super Administrateur
                                                @elseif($user->hasRole('Lead_Technician'))
                                                    Chef des techniciens
                                                @elseif($user->hasRole('Technician'))
                                                    Technicien
                                                @elseif($user->hasRole('Employee'))
                                                    Employé
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('backend/dist/img/profil.png') }}" class="img-circle elevation-2 mt-n1 mx-1" alt="User Image" style="height: 35px; width: 35px">
                                            </td>
                                            <td>
                                                <a class="text-muted " href="">
                                                    <i class="fas fa-pen fa-1x"></i>
                                                </a>
                                                <a class="text-muted mx-1" href="">
                                                    <i class="fas fa-eye fa-1x"></i>
                                                </a>

                                                @if(!$user->hasRole('Admin'))
                                                    <a class="text-danger" href="">
                                                        <i class="fas fa-trash fa-1x"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
{{--                                <div class="d-flex justify-content-center">--}}
{{--                                    {{ $users->links() }}--}}
{{--                                </div>--}}
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
                "lengthChange": false,
                "searching": true,
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
