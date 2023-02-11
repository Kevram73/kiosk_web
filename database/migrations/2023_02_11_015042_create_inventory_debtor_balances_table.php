<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryDebtorBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_debtor_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('inventory_id')
                ->unsigned()
                ->nullable()
                ->index();
            $table->string('motif')->nullable();
            $table->double('montant')->nullable();
            $table->integer('solded')->default(0)->nullable();
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
        Schema::dropIfExists('inventory_debtor_balances');
    }
}
