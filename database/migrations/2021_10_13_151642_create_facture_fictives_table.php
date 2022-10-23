<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureFictivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_fictives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->nullable();
            $table->boolean('with_tva')->nullable()->default(false);
            $table->integer('tva')->nullable()->default(18);
            $table->double('montant_tva')->nullable();
            $table->double('montant_ht')->nullable();
            $table->double('montant_ttc')->nullable();
            $table->bigInteger('vente_id')->unsigned()->nullable();
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
        Schema::dropIfExists('facture_fictives');
    }
}
