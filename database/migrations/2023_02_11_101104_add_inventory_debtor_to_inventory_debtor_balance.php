<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInventoryDebtorToInventoryDebtorBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_debtor_balances', function (Blueprint $table) {
            $table->integer('inventory_debtor_id')
                ->unsigned()
                ->nullable()
                ->index();
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
