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
        Schema::create('sponsorships_apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sponsorship_id')->unsigned();
            $table->unsignedBigInteger('apartment_id')->unsigned();

            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorships_apartments');
    }
};
