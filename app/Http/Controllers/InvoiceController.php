<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //index function

    public function index()
    {
        // return Invoice::all();
        $invoice = Invoice::join("invoice_addresses", "invoice_addresses.id", "invoices.invoice_address_id")->join("service_states", "service_states.id", "invoices.service_state_id")->join("service_types", "service_types.id", "service_states.service_type_id")->join("client_details", "client_details.id", "service_states.client_id")->select(
            "invoices.*",
            "invoice_addresses.id as invoice_address_id",
            "invoice_addresses.invoice_company_name as invoice_company_name",
            "invoice_addresses.invoice_address as invoice_address",
            "invoice_addresses.invoice_pobox as invoice_pobox",
            "invoice_addresses.invoice_phonenumber as invoice_phonenumber",
            "invoice_addresses.invoice_email as invoice_email",
            "invoice_addresses.invoice_note as invoice_note",
            "client_details.id as client_id",
            "client_details.client_name as client_name",
            "client_details.client_address as client_address",
            "client_details.client_pobox as client_pobox",
            "client_details.client_phonenumber as client_phonenumber",
            "client_details.client_email as client_email",
            "service_states.id as service_states_id",
            "service_states.start_date as service_states_start_date",
            "service_states.end_date as service_states_end_date",
            "service_states.tax as service_states_tax",
            "service_states.quantity as service_states_quantity",
            "service_states.price as service_states_price",
            "service_states.currency as service_states_currency",
            "service_states.description as service_states_description",
            "service_types.id as service_types_id",
            "service_types.service_name as service_types_name"
        )->get();

        return response()->json($invoice);
    }

    //store method
    public function store(Request $request)
    {
        $request->validate([
            "invoice_id" => "required",
            "invoice_tin" => "required",
            "invoice_address_id" => "required",
            "service_state_id" => "required"
        ]);
        return Invoice::create($request->all());
    }

    //show a single record
    public function show($id)
    {
        $invoice = Invoice::join("invoice_addresses", "invoice_addresses.id", "invoices.invoice_address_id")->join("service_states", "service_states.id", "invoices.service_state_id")->join("service_types", "service_types.id", "service_states.service_type_id")->join("client_details", "client_details.id", "service_states.client_id")->select(
            "invoices.*",
            "invoice_addresses.id as invoice_address_id",
            "invoice_addresses.invoice_company_name as invoice_company_name",
            "invoice_addresses.invoice_address as invoice_address",
            "invoice_addresses.invoice_pobox as invoice_pobox",
            "invoice_addresses.invoice_phonenumber as invoice_phonenumber",
            "invoice_addresses.invoice_email as invoice_email",
            "invoice_addresses.invoice_note as invoice_note",
            "client_details.id as client_id",
            "client_details.client_name as client_name",
            "client_details.client_address as client_address",
            "client_details.client_pobox as client_pobox",
            "client_details.client_phonenumber as client_phonenumber",
            "client_details.client_email as client_email",
            "service_states.id as service_states_id",
            "service_states.start_date as service_states_start_date",
            "service_states.end_date as service_states_end_date",
            "service_states.tax as service_states_tax",
            "service_states.quantity as service_states_quantity",
            "service_states.price as service_states_price",
            "service_states.currency as service_states_currency",
            "service_states.description as service_states_description",
            "service_types.id as service_types_id",
            "service_types.service_name as service_types_name"
        )->where('client_details.id', $id)->get();
        return response()->json($invoice);
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
