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
    Schema::table('liquidation', function (Blueprint $table) {
        $table->decimal('for_compliance_amount', 15, 2)->nullable()->after('or_date'); // replace 'some_column' with an actual column name
        $table->decimal('pre_audited_amount', 15, 2)->nullable()->after('for_compliance_amount');
        $table->string('pre_auditor')->nullable()->after('pre_audited_amount');
        $table->string('jev_no')->nullable()->after('pre_auditor');
    });
}

public function down()
{
    Schema::table('liquidation', function (Blueprint $table) {
        $table->dropColumn(['for_compliance_amount', 'pre_audited_amount', 'pre_auditor', 'jev_no']);
    });
}

};
