<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('liquidation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cash_advance_id')->constrained('cash_advance')->onDelete('cascade');

            $table->string('sdo_name');
            $table->string('check_number');
            $table->decimal('granted_amount', 15, 2);
            $table->decimal('for_liquidation_amount', 15, 2);

            $table->string('liquidation_type');
            $table->date('liq_date_received');
            $table->string('liq_number');
            $table->date('liq_date');

            $table->string('or_number')->nullable();
            $table->date('or_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('liquidation');
    }
};
