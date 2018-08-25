<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectVerouille extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verouilles_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            /*$table->foreign('project_id')
                   ->references('id')->on('projects');*/
            $table->dateTime('dateverouille')->nullable();
            $table->text('motifverouille')->nullable();
            $table->dateTime('datedeverouille')->nullable();
            $table->text('motifdeverouille')->nullable();
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
        Schema::dropIfExists('verouilles_projects');
    }
}
