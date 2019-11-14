<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesrepondantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponsesrepondants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reponse');
            $table->integer('question_id')->unsigned()->index();
            $table->integer('repondant_id')->unsigned()->index();
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
        Schema::dropIfExists('reponsesrepondants');
    }
}
