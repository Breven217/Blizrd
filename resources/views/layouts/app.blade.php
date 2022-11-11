<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blizrd</title>
    @stack('styles')
</head>
<header>
    @include('layouts.header')
</header>
<body>
    @yield('content')
</body>
<footer>
    <h2>Footer</h2>
</footer>
</html>