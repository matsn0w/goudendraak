@extends('layouts.admin', [
    'title' => __('messages.edit_menu_category')
])

@section('content')
    <div class="box">
        <Menu-Category-Edit id="{{ $category->id }}"></Menu-Category-Edit>
    </div>
@endsection
