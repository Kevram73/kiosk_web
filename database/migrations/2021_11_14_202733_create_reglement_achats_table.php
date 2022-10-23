<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglement_achats', function (Blueprint $table) {
            $table->Increments('id');
            $table->double('montant_donne');
            $table->double('montant_restant');
            $table->double('total')->nullable();
            $table->integer('fournisseur_id')->nullable();
            $table->dateTime('date_reglement')->default(now());
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('commande_id')->unsigned()->nullable();
            $table->integer('boutique_id')->unsigned()->nullable();
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
        Schema::dropIfExists('reglement_achats');
    }
}
