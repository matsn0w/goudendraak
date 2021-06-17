@extends('layouts.admin', [
    'title' => __('messages.edit_user')
])

@section('content')
    <div class="box">
        <User-Edit id="{{ $user->id }}"></User-Edit>
    </div>
@endsection
