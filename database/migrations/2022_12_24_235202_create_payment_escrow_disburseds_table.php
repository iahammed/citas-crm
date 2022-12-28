<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentEscrowDisbursedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_escrow_disburseds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('student_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('course_students')
                    ->constrained('course_students')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->date('payment_date');
            $table->decimal('amount', $precision = 8, $scale = 2);
            $table->decimal('fees_escrow', $precision = 8, $scale = 2);
            $table->decimal('fees_disbursed', $precision = 8, $scale = 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_escrow_disburseds');
    }
}
