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
    Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
        $table->boolean('for_compliance')->nullable()->change();
    });
}

public function down()
{
    Schema::table('pre_auditor_liquidation_entries', function (Blueprint $table) {
        $table->string('for_compliance', 255)->nullable()->change();
    });
}

};
