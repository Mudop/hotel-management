<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relación con Hotel a través de la tabla pivote.
     */
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_types')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
