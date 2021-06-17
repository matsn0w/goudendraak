@extends('layouts.admin', [
    'title' => 'Menu categorieën'
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.menu.categories.create') }}">Nieuw</a>
@endsection

@section('content')
    <div class="box">
        <Menu-Category-Index></Menu-Category-Index>
    </div>
@endsection
