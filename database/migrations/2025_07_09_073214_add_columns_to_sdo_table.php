<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sdo', function (Blueprint $table) {
            $table->string('ppower_name')->nullable();
            $table->string('position')->nullable();
            $table->string('official_station')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('corporate_email')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('sdo', function (Blueprint $table) {
            $table->dropColumn([
                'ppower_name',
                'position',
                'official_station',
                'employment_status',
                'corporate_email',
            ]);
        });
    }
};

