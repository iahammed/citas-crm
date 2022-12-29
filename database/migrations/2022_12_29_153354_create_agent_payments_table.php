<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateAgentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained('accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('agent_id')
                ->constrained('agents')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('course_student_id')
                ->constrained('course_student')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('amount', $precision = 8, $scale = 2);
            $table->double('balance', $precision = 8, $scale = 2);
            $table->double('paid', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('agent_payments');
    }
}
