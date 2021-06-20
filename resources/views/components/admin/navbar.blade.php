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
                <a class="navbar-item" href="{{ route('admin.index') }}">{{ __('messages.home') }}</a>
                <a class="navbar-item" href="{{ route('admin.news.index') }}">{{ __('messages.news') }}</a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">{{ __('messages.menu') }}</a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('admin.menu.index') }}">{{ __('messages.dishes') }}</a>
                        <a class="navbar-item" href="{{ route('admin.menu.categories.index') }}">{{ __('messages.categories') }}</a>
                        <a class="navbar-item" href="{{ route('admin.menu.allergens.index') }}">{{ __('messages.allergens') }}</a>
                    </div>
                </div>

                <a class="navbar-item" href="{{ route('admin.users.index') }}">{{ __('messages.users') }}</a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <em>{{ __('messages.admin_navbar_logged') }} #<strong>{{ auth()->user()->code }}</strong> ({{ auth()->user()->roles->first()->name }})</em>
                </div>

                <div class="navbar-item">
                    <div class="buttons">
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button class="button is-light" type="submit">{{ __('messages.log_out') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
