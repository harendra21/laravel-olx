<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Assignment</title>
        <link rel="stylesheet" href="{{ url('/') }}/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/node_modules/bootstrap-fileinput/css/fileinput.min.css">
        <link href="{{ url('/') }}/node_modules/bootstrap4-glyphicons/css/bootstrap-glyphicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">OLX</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                        <!-- <a href="#" class="nav-item nav-link">Profile</a> -->
                    </div>
                    
                    <div class="navbar-nav">
                       
                        @if(empty(session('user_login')))
                            <a href="{{ url('/') }}/register" class="nav-item nav-link">Register</a>
                            <a href="{{ url('/') }}/login" class="nav-item nav-link btn btn-xs btn-primary">Login</a>
                        @else
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu">
                                    <!-- <a href="{{ url('/') }}/my-profile" class="dropdown-item">My Profile</a> -->
                                    <a href="{{ url('/') }}/add-product" class="dropdown-item">Add New</a>
                                    <a href="{{ url('/') }}/my-products" class="dropdown-item">My Products</a>
                                    <a href="{{ url('/') }}/logout" class="dropdown-item">Logout</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
            <div class="container">
                @yield('content')
            </div>
            <br>
        <script src="{{ url('/') }}/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap-fileinput/js/plugins/piexif.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap-fileinput/js/plugins/sortable.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap-fileinput/js/plugins/purify.min.js"></script>
        <script src="{{ url('/') }}/node_modules/popper.js/dist/popper.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap-fileinput/js/fileinput.min.js"></script>
        <script src="{{ url('/') }}/node_modules/bootstrap-fileinput/themes/fa/theme.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'#tiny'});</script>
        <script src="{{ url('/') }}/assets/js/main.js"></script>
        @yield('js')
    </body>
</html>