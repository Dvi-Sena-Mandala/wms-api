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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->string('image_front_truck', 100)->nullable(false);
            $table->string('image_fear_truck', 100)->nullable(false);
            $table->unsignedBigInteger("checkin_id")->nullable(false);
            $table->datetimes();


            $table->foreign('checkin_id')->references('id')->on('checkin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};
