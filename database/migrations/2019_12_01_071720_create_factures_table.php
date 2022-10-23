<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->Increments('id');
            $table->String('numero')->nullable();
            $table->double('prixapayer');
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
        Schema::dropIfExists('factures');
    }
}
