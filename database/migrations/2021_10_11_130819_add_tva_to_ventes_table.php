<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTvaToVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->boolean('with_tva')->nullable()->default(false)->after('boutique_id');
            $table->integer('tva')->nullable()->default(18)->after('with_tva');
            $table->double('montant_tva')->nullable()->after('tva');
            $table->double('montant_ht')->nullable()->after('montant_tva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropColumn('with_tva');
            $table->dropColumn('tva');
            $table->dropColumn('montant_tva');
            $table->dropColumn('montant_ht');
        });
    }
}
