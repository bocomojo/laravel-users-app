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
        Schema::create('payout_date_histories', function (Blueprint $table) {
    $table->id();

    // Use unsignedBigInteger for compatibility with cash_advances.id
    $table->unsignedBigInteger('cash_advance_id');

    $table->date('old_start')->nullable();
    $table->date('old_end')->nullable();
    $table->date('new_start');
    $table->date('new_end');
    $table->timestamp('changed_at')->useCurrent();

    // Foreign key constraint (with correct type match)
    $table->foreign('cash_advance_id')->references('id')->on('cash_advance')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_date_histories');
    }
};
