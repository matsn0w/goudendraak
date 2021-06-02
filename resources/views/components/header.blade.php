<section class="header columns">
    <div class="column is-narrow">
        <figure class="image">
            <img src="{{ asset('dist/img/dragon-small.png') }}" alt="Logo">
        </figure>
    </div>

    <div class="column has-text-centered">
        <h2 class="subtitle">Chinees Indische Specialiteiten</h2>
        <h1 class="title">{{ config('app.name') }}</h1>

        <nav class="buttons has-addons is-justify-content-center">
            <a href="#" class="button">Menukaart</a>
            <a href="#" class="button">Nieuws</a>
            <a href="{{ route('contact') }}" class="button">Contact</a>
        </nav>
    </div>

    <div class="column is-narrow">
        <figure class="image">
            <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="Logo">
        </figure>
    </div>
</section>
