@extends('layouts.cashier')

@section('content')
    <div class="content">
        <h1>Welkom!</h1>
        <p>Wat wil je doen?</p>

        <div class="buttons">
            @roles(['admin', 'manager', 'cashier'])
                <a class="button" href="{{ route('cashier.payment') }}">Kassa</a>
            @endroles

            @roles(['admin', 'manager', 'cashier', 'waiter'])
                <a class="button" href="{{ route('cashier.dishes') }}">Gerechten</a>
            @endroles

            @roles(['admin', 'manager'])
                <a class="button" href="{{ route('cashier.overview') }}">Verkoopoverzicht</a>
            @endroles
        </div>
    </div>
@endsection
