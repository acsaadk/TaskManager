<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->longText('description')->default('');
            $table->dateTime('due_date');
            $table->integer('priority_id')->unsigned();
            $table->integer('creator_id')->unsigned();
            $table->integer('assignedTo_id')->unsigned();
            $table->foreign('priority_id')
                  ->references('id')
                  ->on('priorities');
            $table->foreign('creator_id')
                  ->references('id')
                  ->on('users');
            $table->foreign('assignedTo_id')
                  ->references('id')
                  ->on('users');
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
        Schema::dropIfExists('tasks');
    }
}
