@extends('layouts.admin', [
    'title' => 'Menu categorie bewerken'
])

@section('content')
    <div class="box">
        <Menu-Category-Edit id="{{ $category->id }}"></Menu-Category-Edit>
    </div>
@endsection
