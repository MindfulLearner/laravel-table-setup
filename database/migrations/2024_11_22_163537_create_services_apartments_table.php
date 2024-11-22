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
        Schema::create('services_apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_id')->unsigned();
            $table->unsignedBigInteger('apartment_id')->unsigned();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_apartments');
    }
};
