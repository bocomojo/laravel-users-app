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
        Schema::table('cash_advance', function (Blueprint $table) {
            $table->date('check_date')->nullable();
            $table->string('dv_number')->nullable();
            $table->date('dv_date')->nullable();
            $table->string('ors_number')->nullable();
            $table->date('ors_date')->nullable();
            $table->text('particulars')->nullable();
            $table->string('pap')->nullable();
            $table->date('liq_date_received')->nullable();
            $table->string('liq_number')->nullable();
            $table->date('liq_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cash_advance', function (Blueprint $table) {
            $table->dropColumn([
                'check_date',
                'dv_number',
                'dv_date',
                'ors_number',
                'ors_date',
                'particulars',
                'pap',
                'liq_date_received',
                'liq_number',
                'liq_date',
            ]);
        });
    }
};
