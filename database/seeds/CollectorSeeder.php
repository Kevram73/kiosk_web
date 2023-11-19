<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectorSeeder extends Seeder
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
                'name' => "COLLECTOR",
                'guard_name' => "Web"
            ]
        ]);
    }
}
