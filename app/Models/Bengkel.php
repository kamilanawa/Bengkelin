<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'alamat',
        'pemilik_id',
        'link_alamat'
    ];

    public function layanans()
    {
        return $this->hasMany(Layanan::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pemilik_bengkels()
    {
        return $this->belongsTo(PemilikBengkel::class);
    }
}
