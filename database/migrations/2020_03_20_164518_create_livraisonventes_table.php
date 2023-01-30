<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonventesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('livraison_ventes')){
            Schema::create('livraison_ventes', function (Blueprint $table) {
                $table->Increments('id');
                $table->double('quantite_livre');
                $table->double('quantite_restante');
                $table->integer('prevente_id')->unsigned()->index()->nullable();
                // $table->foreign('prevente_id')
                //     ->references('id')
                //     ->on('preventes');
                $table->integer('livraison_v_id')->unsigned()->index()->nullable();
                // $table->foreign('livraison_v_id')
                //     ->references('id')
                //     ->on('livraison_v_s');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livraisonventes');
    }
}
