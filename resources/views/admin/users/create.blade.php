@extends('layouts.admin', [
    'title' => __('messages.add_user')
])

@section('content')
    <div class="box">
        <User-Create></User-Create>
    </div>
@endsection
