@extends('layouts.dashboard')

@section('title', 'Profile')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">Profile</li>
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
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('/img/default-avatar.png') }}"
                                alt="{{ Auth::user()->fullname }} profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->fullname }}</h3>

                        <p class="text-muted text-center">
                            @if (Auth::user()->role == 'admin')
                                Administrator
                            @elseif (Auth::user()->role == 'developer')
                                Developer
                            @else
                                Basic user
                            @endif
                        </p>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>Fullname</strong>

                        <p class="text-muted">
                            {{ Auth::user()->fullname }}
                        </p>

                        <hr>

                        <strong>Username</strong>

                        <p class="text-muted">{{ Auth::user()->username }}</p>

                        <hr>

                        <strong>Email</strong>

                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>

                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="ProfilePageTab" data-toggle="pill" href="#TabProfile" role="tab" aria-controls="TabProfile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="PasswordPageTab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Password</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active" id="TabProfile" role="tabpanel" aria-labelledby="ProfilePageTab">
                            <form action="{{ route('profile') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Fullname</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fullname" class="form-control" placeholder="Fullname" value="{{ empty(old('fullname')) ? Auth::user()->fullname : old('fullname') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Username</label>
                                    <div class="col-md-8">
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ empty(old('username')) ? Auth::user()->username : old('username') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" class="form-control" placeholder="email" value="{{ empty(old('email')) ? Auth::user()->email : old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="PasswordPageTab">
                            <form action="{{ route('profile.password') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Old Password</label>
                                    <div class="col-md-8">
                                        <input name="oldpassword" type="password" class="form-control" placeholder="Old Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">New Password</label>
                                    <div class="col-md-8">
                                        <input name="newpassword" type="password" class="form-control" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Re-Type Password</label>
                                    <div class="col-md-8">
                                        <input name="newpassword_confirmation" type="password" class="form-control" placeholder="Password Confirmation">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
            </div>
        </div>
    </div>
</section>
@endsection
