<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('medical_record_id');
$table->string('medicine_name');
$table->string('dosage');
$table->integer('quantity');
$table->string('usage_instructions');
$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};