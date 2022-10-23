<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraison_commandes', function (Blueprint $table) {
            $table->Increments('id');
            $table->double('quantite_livre');
            $table->double('quantite_restante');
            $table->integer('commande_modele_id')->unsigned()->index()->nullable();
            // $table->foreign('commande_modele_id')
            //     ->references('id')
            //     ->on('commande_modeles');
            $table->integer('livraison_id')->unsigned()->index()->nullable();
            // $table->foreign('livraison_id')
            //     ->references('id')
            //     ->on('livraisons');
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
        Schema::dropIfExists('livraison_commandes');
    }
}
