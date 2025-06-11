<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('liquidations', function (Blueprint $table) {
            $table->date('liq_date_received')->nullable()->after('liquidated_amount');
            $table->string('liq_number')->nullable()->after('liq_date_received');
            $table->date('liq_date')->nullable()->after('liq_number');
        });
    }

    public function down(): void
    {
        Schema::table('liquidations', function (Blueprint $table) {
            $table->dropColumn(['liq_date_received', 'liq_number', 'liq_date']);
        });
    }
};
