<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{
    use HasFactory;
    protected $fillable = ["client_name", "client_address", "client_pobox", "client_phonenumber", "client_email", "registras_id"];
}
