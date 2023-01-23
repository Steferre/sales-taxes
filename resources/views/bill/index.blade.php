@extends('layouts.app')

@section('scripts')

@stop

@section('styles')
<style>
    #sommario {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }
    .linkBTN {
        background: blue;
        cursor: pointer;
        padding: 10px;
        border-radius: 10px;
    }
    .linkBTN:hover {
        background: #3c3cfb;
    }
    .linkStyle {
        text-decoration: none;
        color: #fff;
    }
    #tableBox {
        width: 650px;
        text-align: center;
        margin-top: 10px;
    }
</style>
@stop

@section('content')
<div id="sommario">
    <h3>RIEPILOGO ACQUISTI</h3>
    <div class="linkBTN">
        <a href="{{ route('bill.create') }}" class="linkStyle">AGGIUNGI FATTURA</a>
    </div>
    <table id="tableBox">
        <tr>
            <td>ID FATTURA</td>
            <td>TASSE</td>
            <td>TOTALE</td>
        </tr>
        @foreach($recipts as $key => $recipt)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $recipt["billTotalTaxes"] }}</td>
                <td>{{ $recipt["billTotalPriceWithTaxes"] }}</td>
                <td style="width: 200px;">
                    <div class="linkBTN">
                        <a href="{{ route('bill.show', ['id' => $key+1]) }}" class="linkStyle">
                            DETTAGLIO FATTURA
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@stop