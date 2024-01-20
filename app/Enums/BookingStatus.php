<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'Pending';
    case Diterima = 'Diterima';
    case Selesai = 'Selesai';
    case Dikerjakan = 'Dikerjakan';
    case Ditolak = 'Ditolak';
}
