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
        Schema::create('service_states', function (Blueprint $table) {
            $table->id();
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->integer("tax");
            $table->integer("quantity");
            $table->integer("price");
            $table->string("currency");
            $table->text("description");
            $table->unsignedBigInteger("service_type_id")->index();
            $table->unsignedBigInteger("client_id")->index();
            $table->foreign("service_type_id")->references("id")->on("service_types")->onDelete("cascade");
            $table->foreign("client_id")->references("id")->on("client_details")->onDelete("cascade");
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
        Schema::dropIfExists('service_states');
    }
};
