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
            $table->integer('statut_project_id')->nullable();
            $table->integer('is_modification')->default(0);
            $table->string('libelle')->unique();
            $table->text('content_closed_project')->nullable();
            $table->dateTime('dateclosed')->nullable();
            $table->text('content_finance_project')->nullable();
            $table->dateTime('datefinance')->nullable();
            $table->string('short_code')->unique();
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
