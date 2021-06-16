@extends('layouts.admin', [
    'title' => 'Nieuws bewerken'
])

@section('content')
    <div class="box">
        <News-Edit id="{{ $ítem->id }}"></News-Edit>
    </div>
@endsection
