@extends('layouts.dashboard')

@section('title', 'Edit Status')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">Edit Status</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- Info boxes -->
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">Edit Status</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ url()->current() }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="open" @if ($order->status == 'open') selected @endif>Opej</option>
                                    <option value="progress" @if ($order->status == 'progress') selected @endif>Progress</option>
                                    <option value="finish" @if ($order->status == 'finish') selected @endif>Finish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
