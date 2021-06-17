<nav class="level header">
    <div class="level-left">
        <a href="{{ route('cashier.index') }}">
            <figure class="level-item">
                <img class="logo" src="{{ asset('dist/img/goodpay.png') }}" alt="GoodPay">
            </figure>
        </a>
    </div>

    <div class="level-right">
        @roles(['admin', 'manager', 'cashier'])
            <a href="{{ route('cashier.payment') }}" class="level-item button big">Kassa</a>
        @endroles

        @roles(['admin', 'manager', 'cashier', 'waiter'])
            <a href="{{ route('cashier.dishes') }}" class="level-item button big">Gerechten</a>
        @endroles

        @roles(['admin', 'manager'])
            <a href="{{ route('cashier.overview') }}" class="level-item button big">Verkoopoverzicht</a>
        @endroles

        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            <button class="level-item button big" type="submit">Log uit</a>
        </form>
    </div>
</nav>
