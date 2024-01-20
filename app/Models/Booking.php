<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\BookingType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bengkel_id',
        'user_id',
        'kendaraan_id',
        'layanan_id',
        'waktu_booking',
        'catatan_tambahan',
        'status',
        'tipe_booking',
        'qty',
        // menambahkan field baru untuk rating dan review
        'rating',
        'review',
        // menambahkan field baru untuk gambar
        'gambar'
    ];

    protected $casts = [
        'status' => BookingStatus::class,
        'tipe_booking' => BookingType::class
    ];

    public function detail_layanan_bookings()
    {
        return $this->hasMany(DetailLayananBooking::class);
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function layanans()
    {
        return $this->belongsTo(Layanan::class);
    }
}
