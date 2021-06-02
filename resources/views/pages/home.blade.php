@extends('layouts.base')

@section('content')
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
                <a href="#" class="button">Contact</a>
            </nav>
        </div>

        <div class="column is-narrow">
            <figure class="image">
                <img src="{{ asset('dist/img/dragon-small-flipped.png') }}" alt="Logo">
            </figure>
        </div>
    </section>

    <article class="section content">
        <p class="is-size-5">Al jaren is De Gouden Draak een begrip als het gaat om de beste afhaalgerechten in 's-Hertogenbosch.<br>
        Graag trakteren we u op authentieke gerechten uit de Cantonese keuken.</p>
        <h3 class="is-size-3 underline mt-5">Speciale Studentenaanbieding</h3>
        <h4 class="is-size-2">Chinese Rijsttafel (2 personen)</h1>
        <p>Maak een keuze uit 3 van onderstaande keuzegerechten:</p>

        <table>
            <tbody>
                <tr>
                    <td>Koe Loe Yuk</td>
                    <td>Foe Yong Hai</td>
                </tr>

                <tr>
                    <td>Tjap Tjoy</td>
                    <td>Garnalen met Gebakken Knoflook</td>
                </tr>

                <tr>
                    <td>Babi Pangang</td>
                    <td>Kipfilet in Zwarte Bonen saus</td>
                </tr>
            </tbody>
        </table>

        <p>Met witte rijst. (Nasi of bami voor meerprijs mogelijk.)</p>
        <p class="is-size-3">Prijs: €21,00</p>
    </article>

    <div class="has-text-centered">
        <a href="#" class="is-link">Naar Contact</a>
    </div>
@endsection
