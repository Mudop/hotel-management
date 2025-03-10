<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'address', 'nit', 'total_rooms'];

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }
}
