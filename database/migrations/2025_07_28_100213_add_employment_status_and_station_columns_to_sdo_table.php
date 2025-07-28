<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmploymentStatusAndStationColumnsToSdoTable extends Migration

{
    public function up()
    {
        Schema::table('sdo', function (Blueprint $table) {
            $table->string('employment_status')->nullable()->after('name');
            $table->string('official_station')->nullable()->after('employment_status');
        });
    }

    public function down()
    {
        Schema::table('sdo', function (Blueprint $table) {
            $table->dropColumn(['employment_status', 'official_station']);
        });
    }
}
