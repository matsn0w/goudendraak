@extends('layouts.admin', [
    'title' => __('messages.edit_news')
])

@section('content')
    <div class="box">
        <News-Edit id="{{ $ítem->id }}"></News-Edit>
    </div>
@endsection
