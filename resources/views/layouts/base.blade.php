<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('dist/img/dragon-small.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    @stack('styles')

    <script src="{{ asset('dist/js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
    <section class="section">
        <div class="container is-fluid">
            <nav class="topnav section level mb-0 outside-border">
                <div class="level-item">
                    <a href="{{ route('home') }}" class="is-ghost">
                        <img src="{{ asset('dist/img/dragon-small.png') }}" alt="logo">
                        <span>{{ config('app.name') }}</span>
                        <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="logo">
                    </a>
                </div>

                <div class="level-item shrink">
                    <a href="#">
                        <marquee class="mx-3" behavior="scroll" direction="left">
                            Welkom bij {{ config('app.name') }}. Klik op deze tekst om de aanbiedingen van deze week te zien!
                        </marquee>
                    </a>
                </div>

                <div class="level-item">
                    <a href="{{ route('home') }}" class="is-ghost">
                        <img src="{{ asset('dist/img/dragon-small.png') }}" alt="logo">
                        <span>{{ config('app.name') }}</span>
                        <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="logo">
                    </a>
                </div>
            </nav>

            <div id="app" class="outside-border">
                <x-header />

                @yield('content')

                <x-footer />
            </div>
        </div>
    </section>
</body>
</html>
