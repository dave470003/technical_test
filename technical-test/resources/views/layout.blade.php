<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice Reports</title>

        <script src="/js/app.js"></script>
        <link rel="stylesheet" href="/css/app.css" />
        <link rel="stylesheet" href="/css/flatpickr.min.css" />

    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
