<section class="header columns">
    <div class="column is-narrow">
        <figure class="image">
            <img src="{{ asset('dist/img/dragon-small.png') }}" alt="Logo">
        </figure>
    </div>

    <div class="column has-text-centered">
        <h2 class="subtitle">{{ __('messages.header_subtitle') }}</h2>
        <h1 class="title">{{ config('app.name') }}</h1>

        <nav class="buttons has-addons is-justify-content-center">
            <a href="{{ route('menu') }}" class="button">{{ __('messages.header_menu_menu') }}</a>
            <a href="{{ route('news') }}" class="button">{{ __('messages.news') }}</a>
            <a href="{{ route('contact') }}" class="button">{{ __('messages.contact') }}</a>
            <a href="{{ route('order') }}" class="button">{{ __('messages.order') }}</a>
        </nav>
    </div>

    <div class="column is-narrow">
        <figure class="image">
            <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="Logo">
        </figure>
    </div>
</section>
