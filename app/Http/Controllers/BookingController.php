<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\DetailLayananBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{

    public function booking(Request $request)
    {
        $request->validate([
            'bengkel_id' => 'required',
            'user_id' => 'required',
            'layanan_id' => 'required|array|min:1',
            'kendaraan_id' => 'required',
            'tipe_booking' => 'required',
            'waktu_booking' => 'required',
            'catatan_tambahan' => 'max:250',

        ]);

        // dd($request->layanan_id);

        $user_id = Auth::id();

        $status = BookingStatus::Pending;

        $booking = Booking::create([
            'bengkel_id' => $request->bengkel_id,
            'user_id' => $user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tipe_booking' => $request->tipe_booking,
            'waktu_booking' => $request->waktu_booking,
            'catatan_tambahan' => $request->catatan_tambahan,
            'status' => $status
        ]);

        foreach ($request->layanan_id as $layanan_id) {
            DetailLayananBooking::create([
                'layanan_id' => $layanan_id,
                'booking_id' => $booking->id
            ]);
        }
        return redirect('/profileuser')->with('success', 'Booking Berhasil Dibuat!');
    }

    public function rating($id, Request $request)
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            'rating' => 'required',
        ]);
        $booking->update([
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        Alert::success('Berhasil', 'Rating Berhasil Diberikan');
        return redirect()->back();
    }
}
