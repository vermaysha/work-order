@extends('layouts.dashboard')

@section('title', 'Request')

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
                    <div class="card-header">Detail</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th class="col-md-3">Nomor</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->wo_number }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Judul</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->title }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Kategori</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">
                                    @if ($order->category == 'technical')
                                    <span class="badge bg-indigo">Teknis</span>
                                    @else
                                    <span class="badge bg-maroon">Non Teknis</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Status</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">
                                    @if ($order->status == 'open')
                                        <span class="badge bg-primary">Terbuka</span>
                                    @elseif ($order->status == 'progress')
                                        <span class="badge bg-success">Proses</span>
                                    @elseif ($order->status == 'finish')
                                        <span class="badge bg-warning">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Kepada</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->assign->fullname }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Dari</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->from->fullname }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Deskripsi</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{!! $order->description !!}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Dibuat pada</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->created_at->format('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-3">Terakhir diubah pada</th>
                                <td class="col-md-1">:</td>
                                <td class="col-md-8">{{ $order->updated_at->format('l, d F Y') }}</td>
                            </tr>
                        </table>
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <strong>Judul:</strong>
                            </div>
                            <div class="col-md-9">{{ $order->title }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Kategori:</strong>
                            </div>
                            <div class="col-md-9">
                                @if ($order->category == 'technical')
                                <span class="badge bg-indigo">Teknis</span>
                                @else
                                <span class="badge bg-maroon">Non Teknis</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Judul:</strong>
                            </div>
                            <div class="col-md-9">{{ $order->title }}</div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
