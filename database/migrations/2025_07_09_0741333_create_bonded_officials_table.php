<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bonded_officials', function (Blueprint $table) {
    $table->id();
    
    $table->foreignId('sdo_id')->constrained('sdo')->onDelete('cascade');

    $table->string('status')->nullable();
    $table->decimal('approved_bond_amount', 15, 2)->default(0);
    $table->decimal('max_cash_accountability', 15, 2)->default(0);
    $table->date('effectivity_date')->nullable();
    $table->date('expiration_date')->nullable();
    $table->text('remarks')->nullable();
    $table->decimal('unliquidated_amount', 15, 2)->default(0);
    $table->date('received_in_accounting')->nullable();
    $table->string('remarks_status')->nullable();
    $table->date('date_complied')->nullable();
    $table->date('compliance_returned')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('bonded_officials');
    }
};
