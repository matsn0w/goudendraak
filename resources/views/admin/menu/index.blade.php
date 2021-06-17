@extends('layouts.admin', [
    'title' => __('messages.menu')
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.menu.create') }}">{{ __('messages.new') }}</a>
@endsection

@section('content')
    <div class="box">
        <Menu-Index></Menu-Index>
    </div>
@endsection
