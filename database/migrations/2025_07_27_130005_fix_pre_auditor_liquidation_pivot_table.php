<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pre_auditor_liquidation', function (Blueprint $table) {
        $table->dropColumn('id'); // drop the id
        $table->primary(['liquidation_id', 'pre_auditor_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
