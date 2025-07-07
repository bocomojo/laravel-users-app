<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cash_advance', function (Blueprint $table) {
            // 🆕 add your columns (use `date` or `datetime` as you prefer)
            $table->date('payout_start')->nullable()->after('granted_amount');
            $table->date('payout_end')->nullable()->after('payout_start');
        });
    }

    public function down(): void
    {
        Schema::table('cash_advance', function (Blueprint $table) {
            $table->dropColumn(['payout_start', 'payout_end']);
        });
    }
};
