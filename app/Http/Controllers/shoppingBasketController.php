<?php

namespace App\Http\Controllers;

use App\Models\shoppingBasket;
use Illuminate\Http\Request;

class shoppingBasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = shoppingBasket::get();
        $recipts = [];
        foreach ($data as $key => $item) {
            $itemDecode = json_decode($item["billStructure"]);
            $obj = [];
            for ($i=0; $i < count($itemDecode); $i++) {
                $itemDetail = $itemDecode[$i]; 
                if(isset($itemDetail->category)) {
                    $obj["category".($i+1)] = $itemDetail->category;
                };
                if(isset($itemDetail->description)) {
                    $obj["description".($i+1)] = $itemDetail->description;
                };
                if(isset($itemDetail->quantity)) {
                    $obj["quantity".($i+1)] = $itemDetail->quantity;
                };
                if(isset($itemDetail->price)) {
                    $obj["price".($i+1)] = $itemDetail->price;
                };
                if(isset($itemDetail->taxes)) {
                    $obj["taxes".($i+1)] = $itemDetail->taxes;
                };
                if(isset($itemDetail->priceWithTaxes)) {
                    $obj["priceWithTaxes".($i+1)] = $itemDetail->priceWithTaxes;
                };
                if(isset($itemDetail->billTotalTaxes)) {
                    $obj["billTotalTaxes"] = $itemDetail->billTotalTaxes;
                };
                if(isset($itemDetail->billTotalPriceWithTaxes)) {
                    $obj["billTotalPriceWithTaxes"] = $itemDetail->billTotalPriceWithTaxes;
                };
            }
            
            array_push($recipts, $obj);

        }
        /* echo '<pre>';
        var_dump($recipts);
        echo '</pre>';
        die('stop per analisi valore $recipts'); */
        if(count($recipts) > 0) {
            return view('bill.index', [ 'recipts' => $recipts, 'data' => $data ]);
        } else {
            return view('bill.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataSendedFromBladeView = $request->all();
        //$arrayData = json_decode($dataSendedFromBladeView["arrayData"]);
        /* echo '<pre>';
        var_dump($arrayData);
        echo '</pre>';
        die('siamo qui per analizzare la variabile $arrayData'); */

        $recap = New shoppingBasket();

        $recap['billStructure'] = $dataSendedFromBladeView["arrayData"];

        $recap->save();

        /* return back()->with(['message' => 'Scontrino salvato con successo']); */
        return redirect()->route('bill.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = shoppingBasket::findOrFail($id);
        $recipt = json_decode($data["billStructure"]);
        $reciptID = $data["id"];
        /* echo '<pre>';
        print_r($reciptID);
        echo '</pre>';
        die('stop per valutare valore recipt'); */
        return view('bill.show', [ 'recipt' => $recipt, 'data' => $data ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
