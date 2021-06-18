@extends('layouts.admin', [
    'title' => __('messages.allergens')
])

@section('top-right')
    <a class="button is-primary" href="{{ route('admin.menu.allergens.create') }}">{{ __('messages.new') }}</a>
@endsection

@section('content')
    <div class="box">
        <Allergen-Index></Allergen-Index>
    </div>
@endsection
