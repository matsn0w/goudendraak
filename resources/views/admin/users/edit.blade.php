@extends('layouts.admin', [
    'title' => __('messages.edit_user')
])

@section('top-right')
    @if ($user->id != auth()->user()->id)
        <Delete route="{{ route('users.destroy', $user) }}" redirect="{{ route('admin.users.index') }}"></Delete>
    @endif
@endsection

@section('content')
    <div class="box">
        <User-Edit id="{{ $user->id }}"></User-Edit>
    </div>
@endsection
