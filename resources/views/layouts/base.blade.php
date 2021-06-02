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
        <div class="container is-fluid">
            <nav class="topnav section level mb-0 outside-border">
                <div class="level-item">
                    <img src="{{ asset('dist/img/dragon-small.png') }}" alt="logo">
                    <span>{{ config('app.name') }}</span>
                    <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="logo">
                </div>

                <div class="level-item shrink">
                    <marquee class="mx-3" behavior="scroll" direction="left">
                        Welkom bij {{ config('app.name') }}. Klik op deze tekst om de aanbiedingen van deze week te zien!
                    </marquee>
                </div>

                <div class="level-item">
                    <img src="{{ asset('dist/img/dragon-small.png') }}" alt="logo">
                    <span>{{ config('app.name') }}</span>
                    <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="logo">
                </div>
            </nav>

            <div id="app" class="outside-border">
                @yield('content')
            </div>
        </div>
    </section>
</body>
</html>
