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
        Schema::create('pre_auditor_liquidation', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('liquidation_id');
    $table->unsignedBigInteger('pre_auditor_id');

    $table->foreign('liquidation_id')->references('id')->on('liquidation')->onDelete('cascade');
    $table->foreign('pre_auditor_id')->references('id')->on('pre_auditors')->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_auditor_liquidation');
    }
};
