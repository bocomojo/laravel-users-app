<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cash_advance', function (Blueprint $table) {
            $table->timestamp('demand_letter_sent_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('cash_advance', function (Blueprint $table) {
            $table->dropColumn('demand_letter_sent_at');
        });
    }
};
