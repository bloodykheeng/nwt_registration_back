<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAddress;
use Illuminate\Http\Request;

class InvoiceAddressController extends Controller
{
    public function index()
    {
        return InvoiceAddress::all();
    }

    //storing a record
    public function store(Request $request)
    {
        $request->validate([
            "invoice_company_name" => "required",
            "invoice_address" => "required",
            "invoice_pobox" => "required",
            "invoice_phonenumber" => "required",
            "invoice_email" => "required",
            "invoice_note" => "required"
        ]);
        return InvoiceAddress::create($request->all());
    }

    //showing a single record
    public function show($id)
    {
        return InvoiceAddress::find($id);
    }

    //upadating the product
    public function update(Request $request, $id)
    {
        $invoadd = InvoiceAddress::find($id);
        $invoadd->update($request->all());
        return $invoadd;
    }

    //deleting
    public function destroy($id)
    {
        return InvoiceAddress::destroy($id);
    }

    //search
    public function search($name)
    {
        return InvoiceAddress::where("invoice_company_name", "like", "%" . $name . "%")->get();
    }
}
