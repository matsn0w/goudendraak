@extends('layouts.admin', [
    'title' => 'Gebruiker bewerken'
])

@section('content')
    <div class="box">
        <User-Edit id="{{ $user->id }}"></User-Edit>
    </div>
@endsection
