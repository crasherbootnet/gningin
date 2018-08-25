<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_activites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activite_id');
            $table->integer('activite_historisation_id')->nullable();
            $table->foreign('activite_id')
                   ->references('id')->on('activites')
                   ->onDelete('cascade');
            $table->string('libelle');
            $table->string('short_code', 100);
            $table->text('content');
            $table->float('budget');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
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
        Schema::dropIfExists('sous_activites');
    }
}
