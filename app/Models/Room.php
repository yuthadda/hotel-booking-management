<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id', 'room_number', 'guest_id', 'days'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function stays()
{
    return $this->hasMany(Stay::class, 'room_id');
}

}
