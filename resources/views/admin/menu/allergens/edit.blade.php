@extends('layouts.admin', [
    'title' => __('messages.edit_allergen')
])

@section('content')
    <div class="box">
        <Allergen-Edit id="{{ $allergen->id }}"></Allergen-Edit>
    </div>
@endsection
