<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('quantite');
            $table->double('prix');
            $table->double('prixtotal');
            $table->integer('service_id')->unsigned()->nullable()->index();
            $table->integer('vente_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('service_ventes');
    }
}
