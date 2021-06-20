@extends('layouts.admin', [
    'title' => __('messages.edit_menu_item')
])

@section('content')
    <div class="box">
        <Menu-Edit id="{{ $ítem->id }}"></Menu-Edit>
    </div>
@endsection
