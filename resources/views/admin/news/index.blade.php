@extends('layouts.admin', [
    'title' => 'Nieuws'
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.news.create') }}">Nieuw</a>
@endsection

@section('content')
    <div class="box">
        <News-Index></News-Index>
    </div>
@endsection
