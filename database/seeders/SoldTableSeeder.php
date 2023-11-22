<?php

use Illuminate\Database\Seeder;

class SoldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('solds')->insert([
            [
                'id' => 1,
                'montant' => 0,
                'seuil' => 0,
                'is_active' => true,
            ]
        ]);

    }
}
