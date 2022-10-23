<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nom' => 'Super',
                'prenom' => 'Admin',
                'sexe' => 'M',
                'email' => 'super@admin.com',
                'contact' => '00000000',
                'password' => Hash::make('super12345'),
                'flag_etat' => 0,
                'boutique_id' => 1,
            ],
            [
                'id' => 2,
                'nom' => 'Boutique',
                'prenom' => 'Admin',
                'sexe' => 'M',
                'email' => 'admin@admin.com',
                'contact' => '00000000',
                'password' => Hash::make('admin12345'),
                'flag_etat' => 0,
                'boutique_id' => 1,
            ]
        ]);
    }
}
