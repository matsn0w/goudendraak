@extends('layouts.admin', [
    'title' => __('messages.add_allergen')
])

@section('content')
    <div class="box">
        <Allergen-Create></Allergen-Create>
    </div>
@endsection
