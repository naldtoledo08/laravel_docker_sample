<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->enum('type', ['credit', 'debit']);
            
            $table->integer('leave_type_id')->unsigned();
            $table->foreign('leave_type_id')->references('id')->on('leave_types');

            $table->date('from');
            $table->date('to');

            $table->tinyInteger('is_approve')->default(0);

            $table->text('description');

            $table->smallInteger('num_of_days');
            // $table->date('expire_at');

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
        Schema::dropIfExists('leave_credits');
    }
}
