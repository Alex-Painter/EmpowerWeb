<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('issues', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->binary('picture');
        $table->string('location');
        $table->string('state');
        $table->rememberToken();
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
        //
    }
}