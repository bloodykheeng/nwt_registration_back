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
        Schema::create('client_details', function (Blueprint $table) {
            $table->id();
            $table->string("client_name");
            $table->string("client_address")->nullable();
            $table->string("client_pobox")->nullable();
            $table->string("client_phonenumber");
            $table->string("client_email");
            $table->unsignedBigInteger("registras_id")->index();
            $table->foreign("registras_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_details');
    }
};
