<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('liquidated_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_advance_id');
            $table->string('sdo_name');
            $table->string('check_number');
            $table->decimal('granted_amount', 15, 2);
            $table->decimal('for_liquidation_amount', 15, 2);
            $table->string('liquidation_type');
            $table->date('liq_date_received');
            $table->string('liq_number')->nullable();
            $table->date('liq_date')->nullable();
            $table->string('or_number')->nullable();
            $table->date('or_date')->nullable();
            $table->decimal('for_compliance_amount', 15, 2)->nullable();
            $table->decimal('pre_audited_amount', 15, 2)->nullable();
            $table->string('pre_auditor')->nullable();
            $table->string('jev_no')->nullable();
            $table->timestamps();

            $table->foreign('cash_advance_id')->references('id')->on('cash_advance')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('liquidated_reports');
    }
};
