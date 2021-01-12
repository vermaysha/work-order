@extends('layouts.guest')

@section('content')
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Please confirm your password before continuing.</p>

    <form action="{{ route('password.confirm') }}" method="post">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
        @endforeach
      @endif
      @csrf
      <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mt-3 mb-1">
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              Forgot Your Password?
          </a>
      @endif
    </p>
  </div>
  <!-- /.login-card-body -->
</div>
@endsection
