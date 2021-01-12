@extends('layouts.guest')

@section('content')
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Verify Your Email Address</p>
    @if (session('resent'))
      <div class="alert alert-success" role="alert">
        A fresh verification link has been sent to your email address.
      </div>
    @endif
    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        {{ $error }}
      </div>
      @endforeach
    @endif

    <p>Before proceeding, please check your email for a verification link, If you did not receive the email,</p>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block">click here to request another</button>.
    </form>
    {{-- <form action="{{ route('password.email') }}" method="post">
      @csrf
      @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
        @endforeach
      @endif
      <div class="input-group mb-3">
        <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Request new password</button>
        </div>
        <!-- /.col -->
      </div>
    </form> --}}

    <p class="mt-3 mb-1">
      <a href="{{ route('login') }}">Login</a>
    </p>
    <p class="mb-0">
      <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
    </p>
  </div>
</div>
@endsection
