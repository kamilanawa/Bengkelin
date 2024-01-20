<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bengkel_id'
    ];

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function detail_layanan_bookings()
    {
        return $this->hasMany(DetailLayananBookings::class);
    }
}
