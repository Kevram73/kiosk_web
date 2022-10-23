<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeModelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_modeles', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('modele_fournisseur_id')->unsigned()->nullable()->index();
            // $table->foreign('modele_fournisseur_id')
            //     ->references('id')
            //     ->on('modele_fournisseurs')
            //     ->onUpdate('cascade');
            $table->integer('commande_id')->unsigned()->nullable()->index();
            // $table->foreign('commande_id')
            //     ->references('id')
            //     ->on('commandes')
            //     ->onUpdate('cascade');
            $table->double('quantite');
            $table->double('prix');
            $table->double('total');
            $table->integer('modele')->nullable();
            $table->boolean('etat')->default(false)->nullable();
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
        Schema::dropIfExists('commande_modeles');
    }
}
