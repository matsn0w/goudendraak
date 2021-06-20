@extends('layouts.admin', [
    'title' => __('messages.news')
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.news.create') }}">{{ __('messages.new') }}</a>
@endsection

@section('content')
    <div class="box">
        <News-Index></News-Index>
    </div>
@endsection
