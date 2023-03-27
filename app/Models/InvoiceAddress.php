<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceAddress extends Model
{
    use HasFactory;
    protected $fillable = ["invoice_company_name", "invoice_address", "invoice_pobox", "invoice_phonenumber", "invoice_email", "invoice_note"];
}
