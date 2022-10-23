<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToInventaireModelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaire_modeles', function (Blueprint $table) {
            $table->string('justify')->nullable()->after('inventaire_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaire_modeles', function (Blueprint $table)
        {
            $table->dropColumn('justify');
        });
    }
}
