@extends('layouts.admin', [
    'title' => 'Menu'
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.menu.create') }}">Nieuw</a>
@endsection

@section('content')
    <div class="box">
        <Menu-Index></Menu-Index>
    </div>
@endsection
