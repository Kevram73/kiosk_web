<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('quantite');
            $table->double('prix');
            $table->double('prixtotal');
            $table->integer('modele_id')->unsigned()->nullable()->index();
            $table->integer('projet_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('projet_models');
    }
}
