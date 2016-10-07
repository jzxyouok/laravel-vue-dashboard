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
            $table->integer('team_id')->index();
            $table->integer('user_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->datetime('started_at');
            $table->datetime('completed_at');

            $table->timestamps();

            $table->index(['name', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::drop('tasks');
    
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
