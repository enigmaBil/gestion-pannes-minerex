@extends('layouts.admin')

@section('content')

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
