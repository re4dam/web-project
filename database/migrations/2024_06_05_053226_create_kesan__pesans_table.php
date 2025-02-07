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
        Schema::create('kesan_pesan', function (Blueprint $table) {
            $table->id('id_testimoni')->autoIncrement();
            $table->foreignId('id_user')->constrained('users','id')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('kesan');
            $table->text('pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesan_pesan');
    }
};
