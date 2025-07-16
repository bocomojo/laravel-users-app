<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreAuditorLiquidationEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('pre_auditor_liquidation_entries', function (Blueprint $table) {
    $table->id();

    $table->foreignId('pre_auditor_id')
        ->constrained('pre_auditors')
        ->onDelete('cascade');

    $table->foreignId('liquidation_id')
        ->constrained('liquidation')  // <-- FIX HERE
        ->onDelete('cascade');

    $table->decimal('amount', 15, 2);

    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('pre_auditor_liquidation_entries');
    }
}

