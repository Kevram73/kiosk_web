<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeleFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modele_fournisseurs', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('fournisseur_id')->unsigned()->nullable()->index();
            // $table->foreign('fournisseur_id')
            //     ->references('id')
            //     ->on('fournisseurs')
            //     ->onUpdate('cascade');
            $table->integer('modele_id')->unsigned()->nullable()->index();
            // $table->foreign('modele_id')
            //     ->references('id')
            //     ->on('modeles')
            //     ->onUpdate('cascade');
            $table->double('prix');
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
        Schema::dropIfExists('produit_modele_fournisseurs');
    }
}
