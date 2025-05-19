<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashAdvanceTable extends Migration
{
    public function up()
    {
        Schema::create('cash_advance', function (Blueprint $table) {
            $table->id();

            // Make sure sdo_id matches the type of the primary key in sdo table
            $table->unsignedBigInteger('sdo_id');

            $table->string('check_number');
            $table->string('transaction_type');
            $table->decimal('granted_amount', 10, 2);
            $table->timestamps();

            // Define the foreign key separately
            $table->foreign('sdo_id')
                  ->references('id')
                  ->on('sdo')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_advance');
    }
}
