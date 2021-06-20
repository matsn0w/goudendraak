@extends('layouts.admin', [
    'title' => __('messages.add_menu_item')
])

@section('content')
    <div class="box">
        <Menu-Create></Menu-Create>
    </div>
@endsection
