<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(BoutiquesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TypeRecetteTableSeeder::class);
        $this->call(SoldTableSeeder::class);
    }
}
