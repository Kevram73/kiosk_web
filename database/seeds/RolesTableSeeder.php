<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'ADMINISTRATEUR',
                'guard_name' => 'Web',
            ],
            [
                'id' => 2,
                'name' => 'CAISSIER',
                'guard_name' => 'Web',
            ],
            [
                'id' => 3,
                'name' => 'MAGASINIER',
                'guard_name' => 'Web',
            ],
            [
                'id' => 4,
                'name' => 'VENDEUR',
                'guard_name' => 'Web',
            ],
            [
                'id' => 5,
                'name' => 'SUPER ADMINISTRATEUR',
                'guard_name' => 'Web',
            ]
        ]);
    }
}
