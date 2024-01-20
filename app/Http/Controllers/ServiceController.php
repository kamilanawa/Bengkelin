<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $bengkel = Bengkel::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')->with('booking')->paginate(10); // menambahkan keyword with booking untuk menampilkan rating dari booking


        // menambahkan rating untuk tiap bengkel
        $bengkel->map(function ($bengkel) {
            $bengkel->rating = number_format($bengkel->booking->avg('rating'), 2);  // fungsi avg untuk menghitung rata-rata rating dan fungsi number_format untuk membulatkan angka menjadi 2 angka dibelakang koma
            return $bengkel;
        });
        return view('user/servicepage', ['bengkels' => $bengkel]);
    }

    public function detailBengkel($id)
    {
        $bengkel = Bengkel::with(['layanans', 'jadwals', 'booking'])
            ->findOrFail($id);

        $testimonials = $bengkel->booking()->select('rating', 'review', 'user_id')->paginate(5);
        return view('user/detailbengkelpage', compact('bengkel', 'testimonials'));
    }

    public function bookingPage($id)
    {
        $bengkel['bengkels'] = Bengkel::with(['layanans'])
            ->findOrFail($id);

        $user = Auth::user();
        $idUser = $user->id;
        $kendaraan = Kendaraan::where('user_id', $idUser)->get();

        return view('user/pemesananpage', ['bengkels' => $bengkel, 'user' => $user, 'id_bengkel' => $id, 'kendaraans' => $kendaraan]);
    }
}
