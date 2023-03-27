<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //index function

    public function index()
    {
        return Invoice::all();
    }

    //store method
    public function store(Request $request)
    {
        $request->validate([
            "invoice_id" => "required",
            "invoice_tin" => "required",
            "invoice_address_id" => "required"
        ]);
        return Invoice::create($request->all());
    }

    //show a single record
    public function show($id)
    {
        return Invoice::find($id);
    }

    //update records
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->update($request->all());
        return $invoice;
    }

    //deleting
    public function destroy($id)
    {
        return Invoice::destroy($id);
    }

    //searching
    public function search($name)
    {
        return Invoice::where("invoice_id", "like", "%" . $name . "%")->get();
    }
}
