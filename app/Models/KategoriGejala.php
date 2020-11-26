<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGejala extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function gejala()
    {
        return $this->hasMany(Gejala::class);
    }
}
