<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_depots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->double('montant')->nullable();
            $table->text('motif')->nullable();
            $table->boolean('justifier')->default(false);
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->date('date_dep')->default(now());
            $table->integer('sold_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->integer('boutique_id')->unsigned()->nullable()->index();
            $table->integer('journal_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('sold_depots');
    }
}
