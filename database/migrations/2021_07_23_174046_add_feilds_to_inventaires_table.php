<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->integer('user_valide_id')->unsigned()->nullable()->after('user_id');
            $table->timestamp('date_inventaire_prevu')->nullable()->after('date_inventaire');
            $table->timestamp('date_inventaire_valider')->nullable()->after('date_inventaire_prevu');
            $table->integer('categorie_id')->unsigned()->default(0)->after('etat');
            $table->string('pdf_pending')->nullable()->after('categorie_id');
            $table->string('pdf_valider')->nullable()->after('pdf_pending');
            $table->string('observation')->nullable()->after('pdf_valider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->dropColumn('user_valide_id');
            $table->dropColumn('date_inventaire_prevu');
            $table->dropColumn('date_inventaire_valider');
            $table->dropColumn('categorie_id');
            $table->dropColumn('pdf_pending');
            $table->dropColumn('pdf_valider');
            $table->dropColumn('observation');
        });
    }
}
