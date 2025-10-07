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
        Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
        $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
        $table->date('check_in_date');       
        $table->date('check_out_date');   
        $table->decimal('total_amount', 10, 2)->nullable(); 
        $table->decimal('deposit_amount', 10, 2)->default(0);
        $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Checked In', 'Completed'])->default('Pending');
        $table->timestamps();
     
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
