<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
    <meta name="referrer" content="origin-when-cross-origin" />

    <!-- CSS -->
    <link href="/css/app.css" type="text/css" rel="stylesheet">
    @yield('styles')

    @yield('favicon')
    @yield('scriptsHead')
</head>
<body>
    <main id="page">
        @yield('content')
    </main>

    <!-- Body Scripts -->
    <script src="/js/app.js"></script>
    @yield('scriptsBody')
</body>
</html>
