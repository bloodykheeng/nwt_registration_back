<?php

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendInvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get("/testemail", function () {
    Mail::to("test@gmail.com")->send(new InvoiceMail);
});

// Route::get("/sendinvoice", [SendInvoiceController::class, "contact"]);
// Route::get("/sendinvoicefromdb/{id}", [SendInvoiceController::class, "sendInvoice"]);

require __DIR__ . '/auth.php';
