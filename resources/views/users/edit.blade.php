@extends('layouts.dashboard')

@section('title', 'Edit User')

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
                        Edit user
                    </div>
                    <div class="card-body">
                        <form action="{{ url()->current() }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Fullname</label>
                                <div class="col-md-8">
                                    <input type="text" name="fullname" class="form-control" placeholder="Fullname" value="{{ empty(old('fullname')) ? $user->fullname : old('fullname') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ empty(old('username')) ? $user->username : old('username') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Email</label>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control" placeholder="email" value="{{ empty(old('email')) ? $user->email : old('email') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Role</label>
                                <div class="col-md-8">
                                    @php
                                        $role = empty(old('role')) ? $user->role : old('role');
                                    @endphp
                                    <select name="role" class="form-control">
                                        <option value="">-- Select Role --</option>
                                        <option value="user" @if ($role == 'user') selected @endif>Basic User</option>
                                        <option value="developer" @if ($role == 'developer') selected @endif>Developer</option>
                                        <option value="admin" @if ($role == 'admin') selected @endif>Administrator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input name="password" type="password" class="form-control" placeholder="New Password">
                                    <div class="text-muted">*Kosongkan bila tidak ingin mengubah password</div>
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
