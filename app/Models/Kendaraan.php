<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'merk',
        'model',
        'plat',
        'category_kendaraan_id',
        'user_id'
    ];

    public function category_kendaraan()
    {
        return $this->belongsTo(CategoryKendaraan::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
