<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('project_historisation_id')->nullable();
            $table->string('libelle');
            $table->string('short_code', 100);
            $table->text('content');
            $table->text('rapport_moral')->nullable();
            $table->text('rapport_financier')->nullable();
            $table->integer('liste_presence')->nullable();
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
        Schema::dropIfExists('activites');
    }
}
