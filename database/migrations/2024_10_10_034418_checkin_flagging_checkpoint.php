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
        Schema::table('checkin', function (Blueprint $table) {
            $table->enum('checkpoint', array('CHECKIN', 'QC', 'UNLOADING', 'CHECKOUT'))->default('CHECKIN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkin', function (Blueprint $table) {
            //
        });
    }
};
