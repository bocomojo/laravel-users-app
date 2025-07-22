<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sack_assignment', function (Blueprint $table) {
            $table->id();
            $table->string('liq_number', 50)->collation('utf8mb4_unicode_ci');
            $table->string('sack_number');
            $table->timestamps();

            $table->index('liq_number');
            $table->foreign('liq_number')
                ->references('liq_number')
                ->on('liquidation') // ✅ use correct table name here
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sack_assignment');
    }
};
