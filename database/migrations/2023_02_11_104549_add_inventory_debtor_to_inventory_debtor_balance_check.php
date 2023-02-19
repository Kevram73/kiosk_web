<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInventoryDebtorToInventoryDebtorBalanceCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_debtor_balances', function (Blueprint $table) {
            $table->double('montant_rembourser')
                ->nullable() ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_debtor_balances', function (Blueprint $table) {
            //
        });
    }
}
