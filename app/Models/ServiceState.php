<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceState extends Model
{
    use HasFactory;
    protected $fillable = ["start_date", "end_date", "tax", "quantity", "price	", "currency", "description", "client_id", "registras_id"];
}
