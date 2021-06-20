@extends('layouts.base')

@section('content')
    <form action="{{ route('auth.login') }}" method="post" class="login">
        @csrf

        <div class="field">
            <label class="label" for="code">{{ ucfirst(__('validation.attributes.number')) }}</label>

            <div class="control">
                <input class="input" type="number" name="code" id="code" min="1" value="{{ old('code') }}">
            </div>

            @error('code')
                <p class="help">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="password">{{ ucfirst(__('validation.attributes.password')) }}</label>

            <div class="control">
                <input class="input" type="password" name="password" id="password" autocomplete="current-password">
            </div>

            @error('password')
                <p class="help">{{ $message }}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button">{{ __('messages.login') }}</button>
            </div>
        </div>
    </form>
@endsection
