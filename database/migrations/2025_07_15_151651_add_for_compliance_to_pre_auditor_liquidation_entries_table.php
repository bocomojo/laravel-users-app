<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
            $table->string('for_compliance')->nullable()->after('amount');
        });
    }

    public function down(): void
    {
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
            $table->dropColumn('for_compliance');
        });
    }
};
