<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->String('nom');
            $table->String('prenom')->nullable();
            $table->enum('sexe',['M','F']);
            $table->String('email')->nullable();
            $table->String('contact')->nullable();
            $table->integer('boutique_id')->unsigned()->nullable()->index();
            // $table->foreign('boutique_id')
            //     ->references('id')
            //     ->on('boutiques');
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
        Schema::dropIfExists('clients');
    }
}
