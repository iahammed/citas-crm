<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                    ->constrained('courses')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('student_id')
                    ->constrained('students')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('account_id')
                    ->constrained('accounts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->decimal('fees', $precision = 8, $scale = 2);
            $table->decimal('net_fees', $precision = 8, $scale = 2);
            $table->decimal('fees_received', $precision = 8, $scale = 2);
            $table->decimal('fees_escrow', $precision = 8, $scale = 2);
            $table->decimal('fees_disbursed', $precision = 8, $scale = 2);
            $table->date('start_date');
            $table->date('finish_date');
            $table->integer('duration');
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
        Schema::dropIfExists('course_students');
    }
}
