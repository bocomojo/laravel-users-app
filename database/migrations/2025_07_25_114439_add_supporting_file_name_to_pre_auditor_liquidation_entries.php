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
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
    $table->string('supporting_file_name')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
            //
        });
    }
};
