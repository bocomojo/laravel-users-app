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
    Schema::create('bonded_officials', function (Blueprint $table) {
        $table->id();

        $table->foreignId('sdo_id')->constrained('sdo')->onDelete('cascade');


        $table->string('bond_status');
        $table->decimal('approved_bond_amount', 15, 2)->nullable();
        $table->decimal('max_cash', 15, 2)->nullable();
        $table->date('effective_date')->nullable();
        $table->date('expiration_date')->nullable();
        $table->integer('aging')->nullable();
        $table->decimal('unliquidated_amount', 15, 2)->nullable();

        $table->date('date_received_accounting')->nullable();
        $table->date('date_complied')->nullable();
        $table->date('compliance_date_returned')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonded_officials');
    }
};
