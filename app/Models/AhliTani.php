<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliTani extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
