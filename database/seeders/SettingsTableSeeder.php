<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name' => 'VENTE SIMPLE',
                'tag' => 'vente_simple',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VENTE A CREDIT',
                'tag' => 'vente_credit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VENTE NON LIVREE',
                'tag' => 'vente_livree',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VENTE FICTIVE',
                'tag' => 'vente_fictive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LIVRAISON VENTE',
                'tag' => 'livraison_vente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'TVA',
                'tag' => 'tva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'REGLEMENT',
                'tag' => 'reglement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'REGLEMENT ACHAT',
                'tag' => 'reglement_achat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'RECETTE',
                'tag' => 'recette',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'COMMANDE DIRECT',
                'tag' => 'commande_direct',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'COMMANDE INDIRECT',
                'tag' => 'commande_indirect',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'COMMANDE A CREDIT',
                'tag' => 'commande_a_credit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LIVRAISON COMMANDE',
                'tag' => 'livraison_commande',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'INVENTAIRE',
                'tag' => 'inventaire',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CHARGE',
                'tag' => 'charge',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IMMOBILISATION',
                'tag' => 'immobilisation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
