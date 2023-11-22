<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeRecetteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_recettes')->insert([
            [
                'label' => 'Commission sur Vente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Commission sur Transport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
