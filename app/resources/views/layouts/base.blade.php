<!DOCTYPE html>
<html lang='nl'>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Mini Discord</title>
    {{--    <script src="https://livejs.com/live.js"></script>--}}
    @yield('head')
</head>
<body>
@yield('body')
</body>
</html>
