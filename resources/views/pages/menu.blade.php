@extends('layouts.base')

@section('content')
    <article class="content">
        <p>Dit is onze menukaart. Klik om te vergroten.</p>
        <p>
            <a class="has-text-black underline" href="{{ route('menu.download') }}">Download de menukaart als PDF</a>
        </p>

        <figure class="image">
            <a href="{{ asset('dist/img/menu_1.jpg') }}" target="_blank">
                <img src="{{ asset('dist/img/menu_1.jpg') }}" alt="Menukaart">
            </a>
        </figure>

        <figure class="image">
            <a href="{{ asset('dist/img/menu_2.jpg') }}" target="_blank">
                <img src="{{ asset('dist/img/menu_2.jpg') }}" alt="Menukaart">
            </a>
        </figure>
    </article>
@endsection
