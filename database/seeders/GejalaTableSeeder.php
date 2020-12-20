<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kA = ['GA1','GA2','GA3','GA4'];
        $gA = ['Pertumbuhan bibit terhambat','Bibit layu dan mudah dicabut dan rebah','Pertumbuhan tanaman terganggu','Banyak padi yang roboh'];
        $kB = ['GB1','GB2','GB3','GB4','GB5','GB6','GB7'];
        $gB = ['Kadang terlihat potongan tangkai malai','Terbentul bisul berbentuk pipa','Tanaman kelihatan terbakar (hopper burn)','Kerdil dan daun berwarna kuning kecoklatan','Pada buah padi terdapat bintik-bintik hitam','Batang terdapat bekas tusukan','Tangkai padi rusak, patah, sisa biji padi berjatuhan'];
        $kD = ['GD1','GD2','GD3','GD4','GD5','GD6','GD7'];
        $gD = ['Terlihat bercak-bercak berwarna putih, berupa garis atau titik-titik terdapat tabung atau gulungan daun','Daun tergulung dan berubah warna menjadi kuning sampai kemerah-merahan','Hanya tersisa tulang-tulang daun','Bibit berubah warna menjadi kekuningan','Mula-mula daun mengalami perubahan warna','Daun ditumbuhi cendawan jelaga dan kering','Daun terdapat bercak-bercak bekas isapan oleh nimfa walang sangit'];
        $kU = ['GU1','GU2','GU3','GU4','GU5','GU6','GU7','GU8','GU9'];
        $gU = ['Beberapa gabah tidak berisi','Tunas gelembungnya tidak dapat berbunga','Tanaman padi menjadi layu, bahkan ada yang roboh','Kerdil rumput','Tunas sedikit, waktu berbunga tertunda','Pada buah padi Nampak noda bekas isapan kepik','Tunas sedikit, waktu berbunga tertunda','Tampak botak-botak bekas serangan tikus','Burung berkeliaran disekitar tanaman padi'];
        for ($i=0; $i < ; $i++) { 
            if($i == 0){
                Gejala::create([
                    'kode' => $kA[$i],
                    'nama_gejala' => $gA[$i]
                ]);
            }
        }
    }
}
    