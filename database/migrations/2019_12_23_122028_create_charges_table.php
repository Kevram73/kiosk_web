<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('libelle');
            $table->string('montant');
            $table->dateTime('date')->default(now());
            $table->integer('journal_divers_id')->unsigned()->nullable()->index();
            // $table->foreign('journal_divers_id')
            //     ->references('id')
            //     ->on('journal_divers')
            //     ->onUpdate('cascade');
            $table->integer('boutique_id')->unsigned()->nullable()->index();
            // $table->foreign('boutique_id')
            //     ->references('id')
            //     ->on('boutiques')
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
        Schema::dropIfExists('charges');
    }
}
