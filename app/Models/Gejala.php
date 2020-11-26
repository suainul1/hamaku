<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function kategoriGejala()
    {
        return $this->belongsTo(KategoriGejala::class);
    }
    public function hama()
    {
        return $this->belongsTo(Hama::class);
    }
}
