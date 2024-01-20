<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\DetailLayananBooking;
use App\Models\Kendaraan;
use App\Models\PemilikBengkel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();

        return view('admin/app', ['owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function listuser(Request $request)
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $data['users'] = User::all();
        return view('admin/listuser', $data, ['owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function listowner()
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $data['pemilik_bengkel'] = PemilikBengkel::all();
        return view('admin/listowner', $data, ['owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function listbengkel()
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $data['bengkels'] = Bengkel::all();
        return view('admin/listbengkel', $data, ['owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function detailuser($id)
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $user['users'] = User::findOrfail($id);
        $datakendaraan['kendaraans'] = Kendaraan::with(['user', 'category_kendaraan'])->get();
        return view('admin/detailuser', $datakendaraan, ['users' => $user, 'owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function detailowner($id)
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $owner['pemilik_bengkels'] = PemilikBengkel::findOrFail($id);
        $databengkel = Bengkel::with(['pemilik_bengkels'])->get();
        // dd($datatransaksi);
        return view('admin/detailowner', ['bengkels' => $databengkel, 'pemilik_bengkels' => $owner, 'owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function detailbengkel($id)
    {
        $userCount = User::count();
        $bengkelCount = Bengkel::count();
        $ownerCount = PemilikBengkel::count();
        $bengkel = Bengkel::findOrFail($id);

        $booking = Booking::with(['kendaraan', 'user', 'bengkel'])
            ->get();

        $detail_booking = DetailLayananBooking::with(['booking', 'layanan'])->get();
        // dd($datatransaksi);
        return view('admin/detailbengkel', ['transaksi' => $booking, 'detail_booking' => $detail_booking, 'bengkels' => $bengkel, 'owners_count' => $ownerCount, 'users_count' => $userCount, 'bengkels_count' => $bengkelCount]);
    }

    public function destroyowner($id)
    {
        PemilikBengkel::destroy($id);
        return redirect(route('showlistowner'))->with('success', 'Owner Berhasil Dihapus!');
    }

    public function destroyuser($id)
    {
        User::destroy($id);
        return redirect(route('showlistuser'))->with('success', 'User Berhasil Dihapus!');
    }

    public function destroybengkel($id)
    {
        Bengkel::destroy($id);
        return redirect(route('showlistbengkel'))->with('success', 'Bengkel Berhasil Dihapus!');
    }
}
