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
    Schema::table('sdo', function (Blueprint $table) {
        $table->string('corporate_email')->nullable()->after('email');
    });
}

public function down()
{
    Schema::table('sdo', function (Blueprint $table) {
        $table->dropColumn('corporate_email');
    });
}

};
