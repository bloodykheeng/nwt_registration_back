<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientDetailsController;

use App\Http\Controllers\InvoiceAddressController;
use App\Http\Controllers\ServiceStateController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/test', function (Request $request) {
//     return "tesiting route accesed";
// });



Route::get('/test2', function (Request $request) {
    return "tesiting2 route accesed";
});
Route::middleware('auth:sanctum')->group(
    function () {

        Route::get('/test', function (Request $request) {
            return "tesiting route accesed";
        });
    }
);

Route::Resource('/client_details', ClientDetailsController::class);



//Administrator
Route::Resource("/admin", AdminController::class);

Route::get("/admin/search/{name}", [App\Http\Controllers\AdminController::class, "search"]);


//invoce address
Route::Resource("/invoiceaddress", InvoiceAddressController::class);

Route::get("/invoiceaddress/search/{name}", [App\Http\Controllers\InvoiceAddressController::class, "search"]);

//invoice
Route::Resource("/invoice", InvoiceController::class);

Route::get("/invoice/search/{name}", [InvoiceController::class, "search"]);

//service state
Route::Resource("/servicestate", ServiceStateController::class);

Route::get("/servicestate/search/{client_id}", [ServiceStateController::class, "search"]);


//service state type
Route::Resource("/servicetype", ServiceTypeController::class);

Route::get("/servicetype/search/{name}", [ServiceTypeController::class, "search"]);
