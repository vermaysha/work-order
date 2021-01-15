@extends('layouts.dashboard')

@section('title', 'Show User')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('/img/default-avatar.png') }}"
                                alt="{{ $user->fullname }} profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->fullname }}</h3>

                        <p class="text-muted text-center">
                            @if ($user->role == 'admin')
                                Administrator
                            @elseif ($user->role == 'developer')
                                Developer
                            @else
                                Basic user
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>Fullname</strong>

                        <p class="text-muted">
                            {{ $user->fullname }}
                        </p>

                        <hr>

                        <strong>Username</strong>

                        <p class="text-muted">{{ $user->username }}</p>

                        <hr>

                        <strong>Email</strong>

                        <p class="text-muted">
                            {{ $user->email }}
                        </p>

                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
