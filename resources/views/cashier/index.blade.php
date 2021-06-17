@extends('layouts.cashier')

@section('content')
    <div class="content">
        {!! __('messages.cashier_body') !!}

        <div class="buttons">
            @roles(['admin', 'manager', 'cashier'])
                <a class="button" href="{{ route('cashier.payment') }}">{{ __('messages.cashier') }}</a>
            @endroles

            @roles(['admin', 'manager', 'cashier', 'waiter'])
                <a class="button" href="{{ route('cashier.dishes') }}">{{ __('messages.dishes') }}</a>
            @endroles

            @roles(['admin', 'manager'])
                <a class="button" href="{{ route('cashier.overview') }}">{{ __('messages.sales_overview') }}</a>
            @endroles
        </div>
    </div>
@endsection
