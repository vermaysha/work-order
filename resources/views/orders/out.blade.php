@extends('layouts.dashboard')

@section('title', 'Request Keluar')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">Request</li>
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- Info boxes -->
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">Request</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <table id="historyTable" class="table table-bordered table-striped">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script>
$(document).ready( function () {
    $('#historyTable').DataTable({
        serverSide: true,
        ajax: "{!! route('api.history', ['api_token' => Auth::user()->api_token, 'type' => 'out']) !!}",
        columns: [
            { data: 'wo_number', title: 'Nomor' },
            { data: 'title', title: 'Judul' },
            { data: 'category', title: 'Kategori', render: function (data, type, row, meta) {
                if (row.category == 'technical') {
                    return '<span class="badge bg-indigo">Teknis</span>'
                } else {
                    return '<span class="badge bg-maroon">Non Teknis</span>'
                }
            } },
            { data: 'from.fullname', title: 'Dari'},
            { data: 'status', title: 'Status', render: function (data, type, row, meta) {
                if (row.status == 'open') {
                    return '<span class="badge bg-primary">Terbuka</span>'
                } else if (row.status == 'progress') {
                    return '<span class="badge bg-success">Proses</span>'
                } else if (row.status == 'finish') {
                    return '<span class="badge bg-warning">Selesai</span>'
                }
            } },
            { data: 'created_at', title: 'Tanggal', render: function(data, type, row, meta) {
                return moment(row.created_at).format('ddd, D MMM YYYY');
            }},
            {
                data: null,
                title: 'Action',
                orderable: false,
                defaultContent: "",
                // className: "center",
                // defaultContent: function ( data, type, row ) {
                //     return `<div class="btn-group">
                //                 <button class="btn btn-sm btn-primary" title="Detail"><i class="fas fa-search">${data.id}</i></button>
                //                 <button class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></button>
                //                 <button class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-times"></i></button>
                //             </div>`
                // },
            }
        ],
        columnDefs: [
            {
                targets: 6,
                render: function (data, type, row, meta) {
                    return `<div class="btn-group align-middle text-center">
                                <a href="/order/show/${row.wo_number}" class="btn btn-sm btn-primary" title="Detail"><i class="fas fa-search"></i></a>
                                <a href="/order/edit/${row.wo_number}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></a>
                                 <a href="/order/delete/${row.wo_number}" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-times"></i></a>
                            </div>`;
                }
            }
        ]
    });
});
</script>
@endsection
