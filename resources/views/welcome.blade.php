<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ env('APP_NAME') }}</title>

    <script src="{{ asset('/js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <h1>De Gouden Draak</h1>
        {{-- <example-component></example-component> --}}
    </div>
</body>
</html>
