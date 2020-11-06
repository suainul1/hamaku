<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Perawatan Padi'
        ]);
        Kategori::create([
            'nama' => 'Penyakit Padi'
        ]);
    }
}
