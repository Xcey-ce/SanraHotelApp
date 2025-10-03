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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('roomnumber')->nullable();
            $table->string('roomname', 100)->default('');
            $table->enum('type', ['standard', 'deluxe', 'premiere deluxe', 'family', 'premiere family', 'executive', 'presidential suite']);
            $table->integer('capacity')->default(0);
            $table->decimal('price', 10,2)->default(0.00);
            $table->enum('status',['available','occupied', 'maintenance'])->default('available');
            $table->string('image_path');
            $table->text('amenities')->default('');
            $table->text('description')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
