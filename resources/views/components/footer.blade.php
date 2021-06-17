<div class="has-text-centered mt-3">
    <a href="{{ route('contact') }}" class="is-link">{{ __('messages.footer_to_contact') }}</a>

    <form class="block" action="{{ route('lang.switch') }}" method="post">
        @csrf

        @php $locale = app()->getLocale();@endphp

        <select name="lang" id="lang">
            @foreach (config('languages') as $code => $name)
                <option value="{{ $code }}"{{ $code == $locale ? ' selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>

        <button type="submit">{{ __('messages.footer_change') }}</button>
    </form>
</div>
