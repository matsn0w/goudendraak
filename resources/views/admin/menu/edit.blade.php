@extends('layouts.admin', [
    'title' => 'Menu item bewerken'
])

@section('content')
    <div class="box">
        <Menu-Edit id="{{ $ítem->id }}"></Menu-Edit>
    </div>
@endsection
