<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteBancairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compte_bancaires',
            function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agence_id')->nullable();
            $table->boolean('closed')
                ->default(0);
            $table->enum('type',
                ['deposit','withdrawal']);
            $table->double('solder')->nullable();
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
        Schema::dropIfExists('compte_bancaires');
    }
}
