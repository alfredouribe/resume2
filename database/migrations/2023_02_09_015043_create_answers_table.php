<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');

            $table->unsignedBigInteger('idIntent');
            $table->foreign('idIntent', 'fk_intent')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser', 'fk_user2')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('answers');
    }
}
