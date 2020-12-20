<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function ahliTani()
    {
        return $this->belongsTo(AhliTani::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
