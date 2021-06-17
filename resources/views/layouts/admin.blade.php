<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('dist/img/dragon-small.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('dist/css/admin.css') }}">
    @stack('styles')

    <script src="{{ asset('dist/js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
    <x-admin.navbar />

    <section class="section">
        <div class="container">
            <div id="app">
                <div class="level">
                    <div class="level-left">
                        <h1 class="title">{{ $title }}</h1>
                    </div>

                    <div class="level-right">
                        @yield('top-right')
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </section>
</body>
</html>
