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
</style>
@stop

@section('content')
<div id="sommario">
    <h3>RIEPILOGO FATTURA n° {{ $data->id }}</h3>
    <div>
        <a href="{{ route('bill.index') }}">INDIETRO</a>
    </div>
    <div class="customCard">
    @foreach($recipt as $reciptDetail)
        @if(isset($reciptDetail->description))
            <div>Prodotto: <strong>{{$reciptDetail->description}}</strong></div>
        @endif
        @if(isset($reciptDetail->quantity))
            <div>Pezzi: <strong>{{$reciptDetail->quantity}}</strong></div>
        @endif
        @if(isset($reciptDetail->taxes))
            <div>Tasse applicate: <strong>{{$reciptDetail->taxes}}</strong> €</div>
        @endif
        @if(isset($reciptDetail->price))
            <div>Prezzo: <strong>{{$reciptDetail->price}}</strong> €</div>
        @endif
        @if(isset($reciptDetail->priceWithTaxes))
            <div>Prezzo prodotto comprensivo di tasse: <strong>{{$reciptDetail->priceWithTaxes}}</strong> €</div>
        @endif
        @if(isset($reciptDetail->billTotalTaxes))
            <div>Tasse totali: <strong>{{$reciptDetail->billTotalTaxes}}</strong> €</div>
        @endif
        @if(isset($reciptDetail->billTotalPriceWithTaxes))
            <div>Totale fattura comprensivo di tasse: <strong>{{$reciptDetail->billTotalPriceWithTaxes}}</strong> €</div>
        @endif
    @endforeach
    </div>
</div>
@stop