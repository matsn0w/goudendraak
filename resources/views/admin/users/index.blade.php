@extends('layouts.admin', [
    'title' => 'Gebruikers'
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.users.create') }}">Nieuw</a>
@endsection

@section('content')
    <div class="box">
        <User-Index></User-Index>
    </div>
@endsection
