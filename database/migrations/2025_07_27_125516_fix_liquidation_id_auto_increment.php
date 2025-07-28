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
    // ✅ Just set AUTO_INCREMENT — do NOT redefine the primary key
    DB::statement("ALTER TABLE liquidation MODIFY COLUMN id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
