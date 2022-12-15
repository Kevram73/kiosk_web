<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmobilisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobilisations', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('libelle');
            $table->string('montant');
            $table->dateTime('date')->default(now());
            $table->integer('user_id')->unsigned()->nullable()->index();
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('cascade');
            $table->integer('amortissement_id')->unsigned()->nullable()->index();
            // $table->foreign('amortissement_id')
            //     ->references('id')
            //     ->on('amortissements')
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
        Schema::dropIfExists('immobilisations');
    }
}
