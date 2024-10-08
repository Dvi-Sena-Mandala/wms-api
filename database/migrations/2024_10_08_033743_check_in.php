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
        Schema::create('checkin', function (Blueprint $table) {
            $table->id();
            $table->string('no_document', 20)->nullable()->unique('checkin_no_document_unique');
            $table->integer('kuantum')->nullable(false);
            $table->string('driver_name', 100)->nullable(false);
            $table->string('vehicle_plat', 10)->nullable(false);
            $table->string('container_number', 20)->nullable();
            $table->enum('document_type', array('SO', 'PO', 'TM', 'IN', 'OUT'))->nullable();
            $table->string('image_identity_card', 100)->nullable(false);
            $table->string('image_front_truck', 100)->nullable(false);
            $table->foreignId("user_id")->constrained(table: 'users')->cascadeOnDelete();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin');
    }
};
