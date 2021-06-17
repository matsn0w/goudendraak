<div class="has-text-centered mt-3">
    <a href="{{ route('contact') }}" class="is-link">Naar Contact</a>

    <form class="block" action="{{ route('lang.switch') }}" method="post">
        @csrf

        @php
            $locale = Session::get('locale');
            $nl = $locale == 'nl' ? 'selected' : null;
            $en = $locale == 'en' ? 'selected' : null;
        @endphp

        <select name="lang" id="lang">
            <option value="nl" {{ $nl }}>Nederlands</option>
            <option value="en" {{ $en }}>English</option>
        </select>

        <button type="submit">Wissel</button>
    </form>
</div>
