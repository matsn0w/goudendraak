@extends('layouts.admin', [
    'title' => __('messages.add_news')
])

@section('content')
    <div class="box">
        <News-Create></News-Create>
    </div>
@endsection
