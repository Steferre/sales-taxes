<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Versione PHP

Usata versione php@7.4

## NOTE GENERALI PER AVVIO APPLICATIVO

Una volta clonato il repository, sarà necessario copiare il file .env.example e rinominarlo .env

Una volta fatto questo, bisogna lanciare il comando:
- php artisan key:generate

Questo comando popolerà il vostro campo APP_KEY nel file .env

L'applicativo ha la necessità di collegarsi ad un database, dove andrà a salvare dei dati, per questo motivo dovete settare, sempre nel file .env, i dati del databse che andrete a creare. Il nome del db è una vostra scelta (io l'ho chiamato sales-taxes)

Completati questi passaggi sarete pronti per lancare la migrate che creerà la tabella in db che servirà all'applicativo, il comando da lanciare sarà:
- php artisan migrate

Una volta effettuati tutti questi passaggi, sarete pronti per avviare l'applicativo,
il comando in questo caso sarà:
- php artisan serve

Si avvierà un server di sviluppo di Laravel e troverete un indirizzo dove sarà possibile testare l'app

## INDICAZIONI DI MASSIMA SUL FUNZINAMENTO

Una volta avviato il serve di sviluppo di Laravel, recandosi alla pagina che suggerirà il terminale, verrete indirizzati alla pagina di creazione di una nuova lista di prodotti acquistati.

Sarà necessario compilare i campi del form proposto e premere il bottone 'AGGIUNGI'

Una volta premuto questo bottone, si aprirà un box sottostante che vi mostrerà il dato appena inserito, e comparirà un pulsante che permetterà di calcorare il totale della spesa effettuata, comprensivo di tasse, qualora siano previste.

Con la comparsa del box di riepilogo dei dati inseriti, oltre al bottone per calcolare il totale, apparirà il pulsante 'SALVA', che permette di salvare i dati elaborati nel database.

N.B. Per vedere il risultato del calcolo effetuato dall'applicativo è necessario salvare i dati, viene volutamente celato per far si che si provi la funzione di salvataggio.
Procedurà corretta da eseguire:
- compilazione form, in ogni sua parte
- click sul bottone per effettuare il calcolo, una volta inseriti tutti i prodotti desiderati
- click sul bottone del salvataggio

Una volta salvati i dati, si verrà indirizzati ad una pagina riepilogativa, dove saà indicato il totale delle tasse e il prezzo totale della spesa.

Inolte sarà disponibile un pulsante che porterà alla pagina di dettaglio del singolo scontrino, dove sarà possibile vedere i singoli prodotti con costo e tasse.


## ALTRI APPUNTI

Css minimale, solo per centrare i contenuti

Non sono presenti i controlli per i dati inseriti nel form di creazione della lista acquisti, si prega quindi di inserire dati consoni, altrimenti si incorrerebbe in errori non gestiti.

- ESEMPIO

Il campo 'prezzo' prevede che il separatore tra cifre intere e cifre decimali sia il . (punto) e NON la virgola

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).





