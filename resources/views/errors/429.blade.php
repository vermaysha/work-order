@extends('layouts.guest')

@section('content')
<body class="hold-transition register-page">
  <div class="register-box">
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning">429</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Too Many Request</h3>

          <p>
            Please wait, too many access to this page
            Meanwhile, you may <a href="">return to dashboard</a> or try using the search form.
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
</body>
@endsection
