@extends('layouts.admin', [
    'title' => 'Admin'
])

@section('content')
    <div class="box">
        <div class="block">
            <p>Wat wil je doen vandaag?</p>
        </div>

        <div class="buttons block">
            <a class="button" href="{{ route('home') }}">Site</a>
            <a class="button" href="{{ route('admin.news.index') }}">Nieuws</a>
            <a class="button" href="{{ route('admin.menu.index') }}">Menu</a>
            <a class="button" href="#">Gebrukers</a>
            <a class="button" href="{{ route('cashier.index') }}">Kassa</a>
        </div>
    </div>
@endsection