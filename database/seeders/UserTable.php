<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'a@a.com',
            'password' => bcrypt('a'),
            'role' => 'admin',
            'jenis_kelamin' => 'pria',
            'alamat' => 'pasuruan',
        ]);
        $u = User::create([
            'name' => 'Ahli Tani',
            'email' => 't@t.com',
            'password' => bcrypt('t'),
            'jenis_kelamin' => 'pria',
            'role' => 'ahli_tani',
            'alamat' => 'jember',
        ]);
        User::create([
            'name' => 'Petani',
            'email' => 'p@p.com',
            'password' => bcrypt('p'),
            'jenis_kelamin' => 'wanita',
            'role' => 'petani',
            'alamat' => 'bondowoso',
        ]);
        $u->ahliTani()->create([
            'profesi' => 'penyakit akar padi',
        ]);
    }
}
