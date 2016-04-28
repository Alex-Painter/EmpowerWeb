<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Empower Web</title>
        <script src="https://code.jquery.com/jquery-1.12.2.min.js"   integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUthy-BH1YHjVjEvltuDc7QF0GT_AjmWI&callback=initMap"
        async defer></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
        crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::asset('css/simple-sidebar.css') }}">
        <style>
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
        #map {
          height: 40%;
        }
        </style>
    @yield('extraHeaders')
    </head>

    <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/issues') }}">Empower Web</a>

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('/admin') }}">Administrator Settings</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
              </li>
            </ul>

        </div>
      </nav>

      <div class="container-fluid ">
        <div class="row">
          <div class="sidebar-wrapper">
            <ul class="nav nav-stacked affix">
              <li><a href="{{ url('/issues') }}">Issue Feed <span class="badge">to-do</span></a></li>
              <li><a href="{{ url('/analytics') }}">Analytics</a></li>
              <li><a href="{{ url('/settings') }}">Settings</a></li>
              </ul>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-9 col-md-offset-2">
            @yield('content')
          </div>
        </div>
        @yield('foot')
        @yield('maps')
    </body>
</html>
