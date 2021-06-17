@extends('layouts.admin', [
    'title' => __('messages.admin')
])

@section('content')
    <div class="box">
        <div class="block">
            {!! __('messages.admin_body') !!}
        </div>

        <div class="buttons block">
            <a class="button" href="{{ route('home') }}">{{ __('messages.admin_home') }}</a>
            <a class="button" href="{{ route('admin.news.index') }}">{{ __('messages.news') }}</a>
            <a class="button" href="{{ route('admin.menu.index') }}">{{ __('messages.dishes') }}</a>
            <a class="button" href="{{ route('admin.menu.categories.index') }}">{{ __('messages.categories') }}</a>
            <a class="button" href="{{ route('admin.users.index') }}">{{ __('messages.users') }}</a>
            <a class="button" href="{{ route('cashier.index') }}">{{ __('messages.cashier') }}</a>
        </div>
    </div>
@endsection
