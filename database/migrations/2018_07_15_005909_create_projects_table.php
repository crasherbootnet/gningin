<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('bayeur_id');
            $table->integer('ong_id');
            $table->integer('type_project_id');
            $table->integer('etat_project_id')->default(1);
            $table->integer('is_modification')->default(0);
            $table->string('libelle');
            $table->string('short_code');
            $table->integer('active')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
