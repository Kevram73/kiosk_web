<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreventesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventes', function (Blueprint $table) {
            $table->Increments('id');
            $table->double('quantite');
            $table->double('prix');
            $table->double('prixtotal');
            $table->integer('modele_fournisseur_id')->unsigned()->nullable()->index();
            // $table->foreign('modele_fournisseur_id')
            //     ->references('id')
            //     ->on('modele_fournisseurs')
            //     ->onUpdate('cascade');
            $table->integer('vente_id')->unsigned()->nullable()->index();
            // $table->foreign('vente_id')
            //     ->references('id')
            //     ->on('ventes')
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
        Schema::dropIfExists('preventes');
    }
}
