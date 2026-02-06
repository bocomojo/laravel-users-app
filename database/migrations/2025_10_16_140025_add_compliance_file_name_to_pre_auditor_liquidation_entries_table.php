<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
            // Add nullable filename column right after compliance_file
            if (!Schema::hasColumn('pre_auditor_liquidation_entries', 'compliance_file_name')) {
                $table->string('compliance_file_name')->nullable()->after('compliance_file');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
            if (Schema::hasColumn('pre_auditor_liquidation_entries', 'compliance_file_name')) {
                $table->dropColumn('compliance_file_name');
            }
        });
    }
};
