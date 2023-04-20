<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_tasks', function (Blueprint $table) {
        $table->id();
        $table->integer('user_id');
         $table->integer('task_id');
         $table->timestamp('due_date');
         $table->timestamp('start_time');
         $table->timestamp('end_date');
         $table->string('remarks');
         $table->integer('status_id');
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
        Schema::dropIfExists('users_tasks');
    }
}
