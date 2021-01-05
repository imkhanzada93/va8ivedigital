<!DOCTYPE html>
<html>
<head>
    <title>Supermarket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('js')
</head>
<body>
   
    <div class="container">
        <div class="card bg-light mt-3">
            @yield('content')
        </div>
    </div>
   
</body>
</html>