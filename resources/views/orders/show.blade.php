@extends('layouts.dashboard')

@section('title', 'Detail Request: ' . $order->title)

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
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Nomor: </label>
                            </div>
                            <div class="col-md-10">{{ $order->wo_number }}</div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Judul: </label>
                            </div>
                            <div class="col-md-10">{{ $order->title }}</div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Kategori: </label>
                            </div>
                            <div class="col-md-10">
                                @if ($order->category == 'technical')
                                <span class="badge bg-indigo">Teknis</span>
                                @else
                                <span class="badge bg-maroon">Non Teknis</span>
                                @endif
                            </div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Status: </label>
                            </div>
                            <div class="col-md-10">
                                @if ($order->status == 'open')
                                    <span class="badge bg-primary">Terbuka</span>
                                @elseif ($order->status == 'progress')
                                    <span class="badge bg-success">Proses</span>
                                @elseif ($order->status == 'finish')
                                    <span class="badge bg-warning">Selesai</span>
                                @endif
                            </div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Kepada: </label>
                            </div>
                            <div class="col-md-10">{{ $order->assign->fullname }}</div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Dari: </label>
                            </div>
                            <div class="col-md-10">{{ $order->from->fullname }}</div>
                        </div>
                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-md-2">
                                <label>Deskripsi: </label>
                            </div>
                            <div class="col-md-10">
                                {!! $order->description !!}</div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Dibuat pada: </label>
                            </div>
                            <div class="col-md-10">{{ $order->created_at->format('H:i:s - l, d F Y') }}</div>
                        </div>
                        <div class="row border-bottom mb-2">
                            <div class="col-md-2">
                                <label>Terakhir diubah pada: </label>
                            </div>
                            <div class="col-md-10">{{ $order->updated_at->format('H:i:s - l, d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
