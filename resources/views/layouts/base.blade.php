<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    @stack('styles')

    <script src="{{ asset('dist/js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
    <section class="section">
        <div id="app" class="container">
            @yield('content')
        </div>
    </section>
</body>
</html>
