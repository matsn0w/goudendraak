@extends('layouts.admin', [
    'title' => __('messages.edit_news')
])

@section('top-right')
    <Delete route="{{ route('newsitems.destroy', $ítem) }}" redirect="{{ route('admin.news.index') }}"></Delete>
@endsection

@section('content')
    <div class="box">
        <News-Edit id="{{ $ítem->id }}"></News-Edit>
    </div>
@endsection
