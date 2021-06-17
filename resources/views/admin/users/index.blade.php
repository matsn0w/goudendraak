@extends('layouts.admin', [
    'title' => __('messages.users')
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.users.create') }}">{{ __('messages.new') }}</a>
@endsection

@section('content')
    <div class="box">
        <User-Index></User-Index>
    </div>
@endsection
