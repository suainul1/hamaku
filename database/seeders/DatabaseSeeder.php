<?php

namespace Database\Seeders;

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
        $this->call(KategoriGejalaTableSeeder::class);
        $this->call(UserTable::class);
        // $this->call(KategoriTableSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
