<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blizrd</title>
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    @stack('styles')
    @yield('scripts')
    <script src="https://kit.fontawesome.com/390c55ff1f.js" crossorigin="anonymous"></script>
</head>
<header>
    @include('layouts.header')
</header>
<body>
    @yield('content')
</body>
<footer>
    @include('layouts.footer')
</footer>
</html>