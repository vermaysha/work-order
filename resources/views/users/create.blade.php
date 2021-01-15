@extends('layouts.dashboard')

@section('title', 'Create User')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                {{ $error }}
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        Create user
                    </div>
                    <div class="card-body">
                        <form action="{{ url()->current() }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Fullname</label>
                                <div class="col-md-8">
                                    <input type="text" name="fullname" class="form-control" placeholder="Fullname" value="{{ old('fullname') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Email</label>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control" placeholder="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input name="password" type="password" class="form-control" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Re-Type Password</label>
                                <div class="col-md-8">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation">
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
