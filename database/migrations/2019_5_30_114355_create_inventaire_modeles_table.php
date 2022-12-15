<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventaireModelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaire_modeles', function (Blueprint $table) {
            $table->Increments('id');
            $table->double('quantite_reelle');
            $table->double('quantite');
            $table->integer('modele_id')->unsigned()->nullable()->index();
            // $table->foreign('modele_id')
            //     ->references('id')
            //     ->on('modeles')
            //     ->onUpdate('cascade');
            $table->integer('inventaire_id')->unsigned()->nullable()->index();
            // $table->foreign('inventaire_id')
            //     ->references('id')
            //     ->on('inventaires')
            //     ->onUpdate('cascade');
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
        Schema::dropIfExists('inventaire_modeles');
    }
}
