@extends('layouts.dashboard')

@section('title', 'Users Management')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">User</li>
@endsection


@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- Info boxes -->
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header row">
                        <div class="col">
                            <span class="mt-1 d-block">Users Management</span>
                        </div>
                        <div class="col">
                            <a href="{{ route('user.create') }}" class="btn-sm btn btn-primary btn-flat float-right">Create User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <table id="userTable" class="table table-bordered table-striped">
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
    let datatable = $('#userTable').DataTable({
        serverSide: true,
        ajax: "{!! route('api.user', ['api_token' => Auth::user()->api_token]) !!}",
        columns: [
            {
                data: 'id',
                title: 'ID',
            },
            { data: 'fullname', title: 'Nama Lengkap' },
            { data: 'username', title: 'Nama Pengguna' },
            { data: 'email', title: 'Email' },
            {
                data: null,
                title: 'Action',
                orderable: false,
                defaultContent: "",
            }
        ],
        columnDefs: [
            {
                targets: 4,
                render: function (data, type, row, meta) {
                    if ({{ Auth::id() }} != row.id) {
                        return `<div class="btn-group align-middle text-center">
                                    <a href="/user/detail/${row.id}" class="btn btn-sm btn-primary" title="Detail"><i class="fas fa-search"></i></a>
                                    <a href="/user/edit/${row.id}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="/user/delete/${row.id}" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-times"></i></a>
                                </div>`;
                    }

                    return '-';
                }
            }
        ]
    });

    // datatable.on( 'order.dt search.dt', function () {
    //     datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();
});
</script>
@endsection
