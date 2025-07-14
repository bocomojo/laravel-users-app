<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('liquidation', function (Blueprint $table) {
            $table->string('status')->default('For Checking')->after('pre_auditor'); // adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('liquidation', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
