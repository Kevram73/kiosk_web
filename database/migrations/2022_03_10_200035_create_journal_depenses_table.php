<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_depenses', function (Blueprint $table) {
            $table->Increments('id');
            $table->dateTime('date_creation')->default(now());
            $table->dateTime('date_fermeture')->nullable();
            $table->integer('mois')->nullable();
            $table->integer('annee')->nullable();
            $table->integer('user_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('journal_depenses');
    }
}
