<nav class="level header">
    <div class="level-left">
        <figure class="level-item">
            <img class="logo" src="{{ asset('dist/img/goodpay.png') }}" alt="GoodPay">
        </figure>
    </div>

    <div class="level-right">
        <a href="{{ route('cashier.index') }}" class="level-item button">Kassa</a>
        <a href="{{ route('cashier.dishes') }}" class="level-item button">Gerechten</a>
        <a href="{{ route('cashier.overview') }}" class="level-item button">Verkoop Overzicht</a>

        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            <button class="level-item button" type="submit">Log uit</a>
        </form>
    </div>
</nav>
