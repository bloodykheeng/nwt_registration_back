<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_id");
            $table->string("invoice_tin");
            $table->unsignedBigInteger("invoice_address_id")->index();
            $table->unsignedBigInteger("service_state_id")->index();
            $table->foreign("service_state_id")->references("id")->on("service_states")->onDelete("cascade");
            $table->foreign("invoice_address_id")->references("id")->on("invoice_addresses")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
