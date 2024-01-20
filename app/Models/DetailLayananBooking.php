<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLayananBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'layanan_id',
        'booking_id',
        'catatan',
        'harga_tambahan',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
