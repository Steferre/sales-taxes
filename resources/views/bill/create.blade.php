@extends('layouts.app')

@section('scripts')
<script>
    const bill = [];
    addRow = (category, description, price, quantity, imported) => {
        const sommario = document.getElementById("sommario");
        const table = document.getElementById("tableBox");

        const tr = document.createElement('tr');
        tr.className = 'tableRow';
        tr.innerHTML = `<tr>
            <td>${category}</td>
            <td>${description}</td>
            <td>${price}</td>
            <td>${quantity}</td>
            <td>${imported}</td>
        </tr>`;
        table.appendChild(tr);

        if(!sommario.style.display) {
            sommario.style.display = "flex";
        }
    }
    createBillRow = () => {
        event.preventDefault();
        const category = document.getElementById("category");
        const imported = document.getElementById("imported");
        const description = document.getElementById("description");
        const price = document.getElementById("price");
        const quantity = document.getElementById("quantity");

        const sommario = document.getElementById("sommario");

        // definizione oggetto che servirà come immagine per la riga dello scontrino
        const billRow = {
            category: '',
            description: '',
            price: null,
            quantity: null,
            imported: false
        }

        /* controlli campi */
        if(!category.value) {
            category.value = 'generic';
            billRow.category = category.value;
        } else {
            billRow.category = category.value;
        }
        if(!description.value) {
            console.log('ERRORE, campo description è obbligatorio');
        } else {
            billRow.description = description.value;
        }
        if(!price.value) {
            console.log('ERRORE, campo price è obbligatorio');
        } else {
            billRow.price = price.value;
        }
        if(!quantity.value) {
            console.log('ERRORE, campo quantity è obbligatorio');
        } else {
            billRow.quantity = quantity.value;
        }
        /* console.log('VALORE campo imported @@@');
        console.log(imported.checked); */
        if(imported.checked) {
            billRow.imported = imported.checked;
        }

        /* console.log('VALORE billRow @@@@@');
        console.log(billRow); */
        bill.push(billRow);
        /* // creare div da inserire nel box sommario
        const div = document.createElement('div');
        div.className = 'row';
        div.innerHTML = `<div>
            Qui verrà inserito un messaggio con la riga inserita e i dati
        </div>`;
        sommario.appendChild(div); */

        // provo ad invocare la funzione addRow
        addRow(category.value, description.value, price.value, quantity.value, imported.checked);
        /* console.log('VALORE ARRAY bill ######');
        console.log(bill); */
        // reset campi per nuovo inserimento
        category.value = "";
        description.value = null;
        price.value = null;
        quantity.value = null;
        imported.checked = false;
        
        
        //console.log('ho triggherato la funzione createBillRow @@');
    }
    calcTotal = (arrayBill) => {
        const categoria = document.getElementById("categoria");
        const btnSalva = document.getElementById("btnSaveBox");
        // funzione che calcola il totale dello scontrino
        // considerando le tasse
        /* REGOLE PER LE TASSE
            - 10% su ogni bene acquistato (ESENTI book, medical, food)
            - 5% ADDIZIONALE su ogni bene acquistato che viene importato (NO ESENZIONI)
            REGOLE PER ARROTONDAMENTO
            (prezzo * percentuale di tassazione)/100
            arrotondata allo 0.05 più vicino
        */
        const total = [];
        const recap = [];

        for (let i = 0; i < arrayBill.length; i++) {
            const billRow = arrayBill[i];
            const row = {
                category: '',
                description: '',
                quantity: null,
                price: null,
                taxes: null,
                priceWithTaxes: null 
            };
            let taxes;
            let rowPrice;
            let rowTaxes;
            let rowPriceWithTaxes;

            if(billRow.category === 'book' || billRow.category === 'food' || billRow.category === 'medical') {
                // esente da tassa del 10%
                row.category = billRow.category;
                row.description = billRow.description;
                row.quantity = billRow.quantity;
                if(billRow.imported) {
                    // importato => tassa del 5% obbligatoria
                    taxes = ((parseFloat(billRow.price)*5)/100).toFixed(2);
                    const integerDigits = taxes.split('.')[0];
                    const decimalDigits = taxes.split('.')[1];
                    /* console.log(decimalDigits);
                    console.log(decimalDigits[1]); */
                    // se la cifra decimale delle centinaia è = 1 a 4 compresi
                    if(decimalDigits[1] == 0 || decimalDigits[1] == 5) {
                        console.log('sono qui @@@@@ if');
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(decimalDigits[1] <= 4) {
                        console.log('sono qui @@@@@ else if 1');
                        taxes = `${integerDigits}.${decimalDigits[0]}5`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(decimalDigits[1] <= 9) {
                        console.log('sono qui @@@@@ else if 2');
                        taxes = `${integerDigits}.${parseInt(decimalDigits[0])+1}0`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    }
                    rowPrice = (parseFloat(billRow.price)*parseInt(billRow.quantity));
                    row.price = rowPrice.toFixed(2);
                    rowPriceWithTaxes = (parseFloat(row.price)+parseFloat(row.taxes));
                    row.priceWithTaxes = rowPriceWithTaxes.toFixed(2);
                    
                    /* console.log('valore row  da pushare nell array del totale ####');
                    console.log(row); */
                    total.push(row); 
                } else {
                    taxes = 0;
                    rowPrice = (parseFloat(billRow.price)*parseInt(billRow.quantity));
                    row.price = rowPrice.toFixed(2);
                    rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                    row.taxes = parseFloat(rowTaxes).toFixed(2);
                    rowPriceWithTaxes = (parseFloat(row.price)+parseFloat(row.taxes));
                    row.priceWithTaxes = rowPriceWithTaxes.toFixed(2);
                    
                    /* console.log('valore row  da pushare nell array del totale ####');
                    console.log(row); */
                    total.push(row); 
                }
            } else {
                // category === generic
                row.category = billRow.category;
                row.description = billRow.description;
                row.quantity = billRow.quantity;
                if(billRow.imported) {// applicare tassa del 15%
                    taxes = ((parseFloat(billRow.price)*15)/100).toFixed(2);
                    /* console.log('valore taxes per profumo importato');
                    console.log(taxes); */
                    const integerDigits = taxes.split('.')[0];
                    const decimalDigits = taxes.split('.')[1];
                    // console.log(decimalDigits);
                    // se la cifra decimale delle centinaia è = 1 a 4 compresi
                    if(decimalDigits[1] == 0 || decimalDigits[1] == 5) {
                        console.log('sono qui @@@@@ if');
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(1 >= decimalDigits[1] <= 4) {
                        console.log('sono qui @@@@@ else if 1');
                        taxes = `${integerDigits}.${decimalDigits[0]}5`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(6 >= decimalDigits[1] <= 9) {
                        console.log('sono qui @@@@@ else if 2');
                        taxes = `${integerDigits}.${parseInt(decimalDigits[0])+1}0`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    }
        
                    rowPrice = (parseFloat(billRow.price)*parseInt(billRow.quantity));
                    row.price = rowPrice.toFixed(2);
                    
                    rowPriceWithTaxes = (parseFloat(row.price)+parseFloat(row.taxes));
                    row.priceWithTaxes = rowPriceWithTaxes.toFixed(2);
                    
                    /* console.log('valore row  da pushare nell array del totale ####');
                    console.log(row); */
                    total.push(row);     
                } else {// applicare tassa del 10%
                    taxes = ((parseFloat(billRow.price)*10)/100).toFixed(2);
                    const integerDigits = taxes.split('.')[0];
                    const decimalDigits = taxes.split('.')[1];
                    // console.log(decimalDigits);
                    // se la cifra decimale delle centinaia è = 1 a 4 compresi
                    if(decimalDigits[1] == 0 || decimalDigits[1] == 5) {
                        console.log('sono qui @@@@@ if');
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(1 >= decimalDigits[1] <= 4) {
                        console.log('sono qui @@@@@ else if 1');
                        taxes = `${integerDigits}.${decimalDigits[0]}5`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    } else if(6 >= decimalDigits[1] <= 9) {
                        console.log('sono qui @@@@@ else if 2');
                        taxes = `${integerDigits}.${parseInt(decimalDigits[0])+1}0`;
                        rowTaxes = (parseFloat(taxes)*parseInt(billRow.quantity));
                        row.taxes = parseFloat(rowTaxes).toFixed(2);
                    }
                    rowPrice = (parseFloat(billRow.price)*parseInt(billRow.quantity));
                    row.price = rowPrice.toFixed(2);
                    rowPriceWithTaxes = (parseFloat(row.price)+parseFloat(row.taxes));
                    row.priceWithTaxes = rowPriceWithTaxes.toFixed(2);
                    
                    /* console.log('valore row  da pushare nell array del totale ####');
                    console.log(row); */
                    total.push(row);
                }

            }            
        }

        /* console.log('VALORE array total @@@@');
        console.log(total); */
        let bTT2DecimalDigits = 0;
        let bTPWT2DecimalDigits = 0;

        for (let j = 0; j < total.length; j++) {
            const item = total[j];
            console.log(`valore item nel for dell array total con indice ${j}`);
            console.log(item);
            
            bTT2DecimalDigits += parseFloat(item.taxes);
            bTPWT2DecimalDigits += parseFloat(item.priceWithTaxes);
            
        }

        
        const billTotalTaxes = bTT2DecimalDigits.toFixed(2);
        const billTotalPriceWithTaxes = bTPWT2DecimalDigits.toFixed(2);
        total.push({billTotalTaxes}, {billTotalPriceWithTaxes});
        
        dati.value = JSON.stringify(total);
        // comparsa bottone per salvataggio in db
        console.log(dati.value);
        if(!btnSalva.style.display) {
            btnSalva.style.display = 'block';
        }
    
    }
    window.addEventListener('load', () => {
        const btnCalcTot = document.getElementById("btnCalcTot");
        console.log(btnCalcTot);
        btnCalcTot.addEventListener('click', (event) => {
            event.preventDefault();
            calcTotal(bill);
        });
        console.log('pagina caricata con successo');

    });
</script>
@stop

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .box {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 50px;
        margin-bottom: 35px;
        padding: 30px 0;
        background: lightblue;
    }
    .categoryBox {
        display: flex;
        width: 700px;
        justify-content: center;
    }
    #category {
        margin-left: 10px;
    }
    #btnAdd {
        background: blue;
        color: #fff;
        cursor: pointer;
        padding: 10px;
        border-radius: 10px;
        border: none;
    }
    #btnAdd:hover {
        background: #3c3cfb;
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
    #btnCalcTot {
        background: blue;
        color: #fff;
        cursor: pointer;
        padding: 10px;
        border-radius: 10px;
        border: none;
    }
    #btnCalcTot:hover {
        background: #3c3cfb;
    }
    #sommario {
        width: 100%;
        max-width: 800px;
        margin: 0 auto 100px;
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background: yellow;
        padding: 50px 0;
    }
    #tableBox {
        width: 100%;
    }
    .tableRow {
        text-align: center;
    }
    .btnCustomStyle {
        background: blue;
        color: #fff;
        cursor: pointer;
        padding: 10px;
        border-radius: 10px;
        border: none;
        margin-left: 5px;
    }
    .btnCustomStyle:hover {
        background: #3c3cfb;
    }
    #btnSaveBox {
        display: none;
    }
</style>
@stop

@section('content')
<div class="box">
    <h2>INSERISCI I TUOI ACQUISTI E CALCOLA IL TOTALE DELLA TUA SPESA</h2>
    <div class="linkBTN">
        <a href="{{ route('bill.index') }}" class="linkStyle">INDIETRO</a>
    </div>
    <div class="categoryBox">
        <label for="category">Categoria prodotto</label>
        <select name="category" id="category">
            <option value="">Seleziona una categoria</option>
            <option value="book">Book</option>
            <option value="food">Food</option>
            <option value="medical">Medical</option>
            <option value="generic">Generic</option>
        </select>
    </div>
    <div class="importedBox">
        <label for="imported">Prodotto importato</label>
        <input type="checkbox" name="imported" id="imported">
    </div>
    <div class="descriptionBox">
        <label for="description">Descrizione prodotto</label>
        <input type="text" id="description">
    </div>
    <div class="priceBox">
        <label for="price">Prezzo</label>
        <input type="text" name="price" id="price" placeholder="es 12.49">
    </div>
    <div class="quantityBox">
        <label for="quantity">Quantità</label>
        <input type="number" name="quantity" id="quantity">
    </div>
    <div class="btnBox">
        <button type="submit" id="btnAdd" onclick="createBillRow()">AGGIUNGI</button>
    </div>
</div>
<div id="sommario">
    <h3>RIEPILOGO ACQUISTI</h3>
    <table id="tableBox">
        <tr>
            <th>CATEGORIA</th>
            <th>PRODOTTO</th>
            <th>PREZZO</th>
            <th>QUANTITA</th>
            <th>IMPORTATO</th>
        </tr>
    </table>
    <button id="btnCalcTot">CALCOLA TOTALE</button>

    <form action="{{ route('bill.store') }}" method="post" id="btnSaveBox">
        @csrf
        <span>Per poter vedere il calcolo totale, è necessario salvare i dati</span>

        <input type="hidden" name="arrayData" id="dati">
        
        <button type="submit" class="btnCustomStyle">SALVA</button>
    </form>
</div>
@stop