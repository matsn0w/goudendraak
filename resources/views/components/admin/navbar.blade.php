<nav class="navbar is-light" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="{{ asset('dist/img/dragon-small.png') }}">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{ route('admin.index') }}">Home</a>
                <a class="navbar-item" href="{{ route('admin.news.index') }}">Nieuws</a>
                <a class="navbar-item" href="{{ route('admin.menu.index') }}">Menu</a>
                <a class="navbar-item" href="{{ route('admin.users.index') }}">Gebruikers</a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <em>Ingelogd als #<strong>{{ auth()->user()->code }}</strong> ({{ auth()->user()->roles->first()->name }})</em>
                </div>

                <div class="navbar-item">
                    <div class="buttons">
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button class="button is-light" type="submit">Log uit</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
