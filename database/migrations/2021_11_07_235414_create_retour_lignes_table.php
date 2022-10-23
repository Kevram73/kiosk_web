<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetourLignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retour_lignes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('quantite_retourner')->nullable();
            $table->double('quantite_restante')->nullable();
            $table->double('montant')->nullable();
            $table->boolean('payer')->default(true)->nullable();
            $table->boolean('rayon')->default(true)->nullable();
            $table->integer('prevente_id')->unsigned()->index()->nullable();
            $table->integer('vente_id')->unsigned()->index()->nullable();
            $table->integer('retour_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('retour_lignes');
    }
}
