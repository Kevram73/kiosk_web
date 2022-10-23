<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoutiqueSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boutique_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->nullable()->default(true);
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->integer('boutique_id')->unsigned()->nullable();
            $table->integer('setting_id')->unsigned()->nullable();
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
        Schema::dropIfExists('boutique_settings');
    }
}
