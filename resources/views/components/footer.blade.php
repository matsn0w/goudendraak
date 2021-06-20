<div class="has-text-centered is-flex is-flex-direction-column is-align-items-center mt-3">
    <div class="block">
        <a href="{{ route('contact') }}" class="is-link">{{ __('messages.footer_to_contact') }}</a>
    </div>

    <form class="block" action="{{ route('lang.switch') }}" method="post">
        @csrf

        @php $locale = app()->getLocale();@endphp

        <div class="field has-addons">
            <div class="control">
                <div class="select">
                    <select name="lang" id="lang">
                        @foreach (config('languages') as $code => $name)
                            <option value="{{ $code }}"{{ $code == $locale ? ' selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="control">
                <button class="button" type="submit">{{ __('messages.footer_change') }}</button>
            </div>
        </div>
    </form>
</div>
