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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users','id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Pending','Waiting For Payment','Waiting For Approval','Waiting For Retrieval','Borrowed','Returned','Overdue','Cancelled','Denied'])->default('Pending');
            $table->string('buktiSerah')->nullable(true);
            $table->string('buktiKembali')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
