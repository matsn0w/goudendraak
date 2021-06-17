@extends('layouts.admin', [
    'title' => __('messages.menu_categories')
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.menu.categories.create') }}">{{ __('messages.new') }}</a>
@endsection

@section('content')
    <div class="box">
        <Menu-Category-Index></Menu-Category-Index>
    </div>
@endsection
