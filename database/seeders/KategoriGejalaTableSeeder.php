<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\KategoriGejala;
use Illuminate\Database\Seeder;

class KategoriGejalaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k0 = ['GA1','GA2','GA3','GA4'];
        $g0 = ['Pertumbuhan bibit terhambat','Bibit layu dan mudah dicabut dan rebah','Pertumbuhan tanaman terganggu','Banyak padi yang roboh'];
        $k1 = ['GB1','GB2','GB3','GB4','GB5','GB6','GB7'];
        $g1 = ['Kadang terlihat potongan tangkai malai','Terbentul bisul berbentuk pipa','Tanaman kelihatan terbakar (hopper burn)','Kerdil dan daun berwarna kuning kecoklatan','Pada buah padi terdapat bintik-bintik hitam','Batang terdapat bekas tusukan','Tangkai padi rusak, patah, sisa biji padi berjatuhan'];
        $k2 = ['GD1','GD2','GD3','GD4','GD5','GD6','GD7'];
        $g2 = ['Terlihat bercak-bercak berwarna putih, berupa garis atau titik-titik terdapat tabung atau gulungan daun','Daun tergulung dan berubah warna menjadi kuning sampai kemerah-merahan','Hanya tersisa tulang-tulang daun','Bibit berubah warna menjadi kekuningan','Mula-mula daun mengalami perubahan warna','Daun ditumbuhi cendawan jelaga dan kering','Daun terdapat bercak-bercak bekas isapan oleh nimfa walang sangit'];
        $k3 = ['GU1','GU2','GU3','GU4','GU5','GU6','GU7','GU8','GU9'];
        $g3 = ['Beberapa gabah tidak berisi','Tunas gelembungnya tidak dapat berbunga','Tanaman padi menjadi layu, bahkan ada yang roboh','Kerdil rumput','Tunas sedikit, waktu berbunga tertunda','Pada buah padi Nampak noda bekas isapan kepik','Tunas sedikit, waktu berbunga tertunda','Tampak botak-botak bekas serangan tikus','Burung berkeliaran disekitar tanaman padi'];
        
        $kode = ['KG1','KG2','KG3','KG4'];
        $k = ['pada akar padi','pada batang padi','pada daun padi','padi umum'];
         for ($i=0; $i < count($kode); $i++) { 
             $u = KategoriGejala::create([
                'kode' => $kode[$i],
                'nama_kategori' => $k[$i],
             ]);
             if($i== 0){
                 for ($j=0; $j < count($k0); $j++) { 
                     Gejala::create([
                         'kategori_gejala_id' => $u->id,
                         'kode' => $k0[$j],
                         'nama_gejala' => $g0[$j],
                     ]);
                 }
             }elseif($i==1){
                for ($j=0; $j < count($k1); $j++) { 
                    Gejala::create([
                        'kategori_gejala_id' => $u->id,
                        'kode' => $k1[$j],
                        'nama_gejala' => $g1[$j],
                    ]);
                }
             }elseif($i==2){
                for ($j=0; $j < count($k2); $j++) { 
                    Gejala::create([
                        'kategori_gejala_id' => $u->id,
                        'kode' => $k2[$j],
                        'nama_gejala' => $g2[$j],
                    ]);
                }
             }elseif($i==3){
                for ($j=0; $j < count($k3); $j++) { 
                    Gejala::create([
                        'kategori_gejala_id' => $u->id,
                        'kode' => $k3[$j],
                        'nama_gejala' => $g3[$j],
                    ]);
                }
             }
         }
    }
}