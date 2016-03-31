<!DOCTYPE html>
<html>
    <head>
        <title>Empower Web</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
        crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    </head>
    <body>
      <!--Title-->
      <div class="container-fluid">
        <div class="row">
      <div class="col-md-12">
      <div class="title">Empower Web</div>
    </div>
      </div>
  <!--End Title-->
  <!--Login-->
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form class="form-horizontal" role="form" method="post" action="{{ url('/loging') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control"
                  placeholder="Empower ID" name="username">
                </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control"
                  placeholder="Password" name="password">
                </div>
              </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Login
                    </button>
                  </div>
                </div>
              </form>
</div>
<div class="col-md-4"></div>
</div>
          </div>
    </body>
</html>
