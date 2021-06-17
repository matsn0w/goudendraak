@extends('layouts.admin', [
    'title' => __('messages.add_menu_category')
])

@section('content')
    <div class="box">
        <Menu-Category-Create></Menu-Category-Create>
    </div>
@endsection
