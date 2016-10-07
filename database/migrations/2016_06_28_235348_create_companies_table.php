<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->char('company_token', 21)
                ->unique();

            $table->string('name', 60);
            $table->string('address_1');
            $table->string('address_2')
                ->nullable();

            $table->string('city', 40);
            $table->char('state', 2);
            $table->string('zip', 10);
            $table->string('phone')
                ->nullable();
                
            $table->timestamps();

            $table->index('company_token');
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

        Schema::drop('companies');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
