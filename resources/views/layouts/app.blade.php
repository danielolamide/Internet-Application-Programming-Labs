<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>{{config('app.name')." / ".$title}}</title>
    
</head>
<body>
    <nav style="margin-bottom: 10px;">
        <div class="teal lighten-2 nav-wrapper">
            <a href="/" class="brand-logo">{{config('app.name')}}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/">Home</a></li>
                <li><a href="/register">Student</a></li>
                <li><a href="/fees">Fees</a></li>
                <li><a href="/search">Search</a></li>
                <li><a href="/payments">Payments</a></li>
            </ul>
        </div>
    </nav>
    @yield('content')
</body>
</html>