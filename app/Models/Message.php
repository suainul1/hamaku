<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function User()
    {
        return $this->belongsTo(Message::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
