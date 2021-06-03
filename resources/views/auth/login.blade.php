@extends('layouts.base')

@section('content')
    <form action="{{ route('auth.login') }}" method="post">
        @csrf

        <div class="field">
            <label class="label" for="code">Personeelsnummer</label>

            <div class="control">
                <input class="input" type="number" name="code" id="code" min="1" value="{{ old('code') }}">
            </div>

            @error('code')
                <p class="help">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="password">Wachtwoord</label>

            <div class="control">
                <input class="input" type="password" name="password" id="password" autocomplete="current-password">
            </div>

            @error('password')
                <p class="help">{{ $message }}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Inloggen</button>
            </div>
        </div>
    </form>
@endsection
