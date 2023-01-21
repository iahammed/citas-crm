<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('student_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('course_student_id')
                    ->constrained('course_student')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('account_id')
                    ->constrained('accounts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('payment_method_id')
                    ->constrained('method_payments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('payment_date');
            $table->decimal('amount', $precision = 8, $scale = 2);
            $table->json('note')->default(new Expression('(JSON_ARRAY())'))->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_students');
    }
}
