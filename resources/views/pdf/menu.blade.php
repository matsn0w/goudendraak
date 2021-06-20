@extends('layouts.print')

@push('styles')
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        .right {
            text-align: right;
        }
    </style>
@endpush

@section('content')
    <h1>{{ __('messages.header_menu_menu') }}</h1>

    @foreach ($categories as $category)
        <p><strong>{{ $category->name }}</strong></p>

        <table>
            <tbody>
                @foreach ($items->where('category', $category) as $item)
                    <tr>
                        <td>
                            @if ($item->number)
                                {{ $item->number . $item->numbber_addition }}.
                            @else
                                -
                            @endif
                        </td>
                        <td>{!! $item->name !!}</td>
                        <td class="right">&euro; {{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>

                    @if ($item->description)
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <small><em>{{ $item->description }}</em></small>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach
@endsection

