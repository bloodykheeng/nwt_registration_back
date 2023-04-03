<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;

class SendInvoiceController extends Controller
{

    public function contact()
    {
        $data = [
            "subject" => "test subject",
            "body" => "message from customer",
            "path" => "/public/N.W.T SR 2.pdf"
        ];
        Mail::to("hello@example.com")->send(new SendInvoiceMail($data));
    }

    public function sendInvoice($id)
    {

        // $request->validate([
        //     "invoice_database_id" => "required",
        // ]);

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
        )->where('invoices.id', $id)->get()->toArray();

        // dd($invoice);
        Mail::to("hello@example.com")->send(new SendInvoiceMail($invoice));
        return response("invoice sent");
    }
}
