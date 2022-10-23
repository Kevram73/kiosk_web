<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('totaux')->nullable();
            $table->double('payer')->nullable();
            $table->integer('vente_id')->unsigned()->nullable()->index();
            $table->integer('boutique_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('retours');
    }
}
