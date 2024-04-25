<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CategoryKendaraan;
use App\Models\DetailLayananBooking;
use App\Models\Kendaraan;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProfileUserController extends Controller
{
    public function showuser(Request $request)
    {
        $datauser = User::get();
        return view('user/profileuser', ['users' => $datauser]);
    }

    public function showdetailuser($id)
    {
        $datauser = User::findOrFail($id);
        return view('user/profileuserdetail', ['users' => $datauser]);
    }

    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);

        return view(
            'user/profileuseredit',
            $data
        );
    }

    public function updatedetailuser(Request $request, $id)
    {
        // mendapatkan data user
        $dataUser['users'] = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
            'email' => 'string',
            'phone_number' => 'string',
            'alamat' => 'string',
            'link' => 'string'
            // 'image' => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);


        // update data pada database berdasarkan id
        User::where('id', $id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'alamat' => $validated['alamat'],
            'link' => $validated['link'] 
            // 'image' => $newImage['image']
        ]);

        return redirect('/profileuser')->with('success', 'Profile Berhasil Diubah!');
    }

    public function showkendaraan()
    {
        $user = Auth::user();
        $idUser = $user->id;
        //menampilkan data product
        $datakendaraan = Kendaraan::with(['category_kendaraan', 'user'])
            ->where('user_id', $idUser)
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view('user/profilekendaraan', ['kendaraans' => $datakendaraan]);
    }

    public function createkendaraan(Request $request)
    {
        // ambil data category
        $data['category_kendaraan'] = CategoryKendaraan::all();

        //create data (add)
        return view(
            'user/addkendaraan',
            $data
        );
    }

    public function storekendaraan(Request $request)
    {
        // validasi form
        $validated = $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'category_kendaraan_id' => 'required',
            'plat' => 'required',
        ]);

        //menambahkan data ke database
        Kendaraan::create([
            'merk' => $validated['merk'],
            'model' => $validated['model'],
            'category_kendaraan_id' => $validated['category_kendaraan_id'],
            'plat' => $validated['plat'],
            'user_id' => Auth::user()->id
        ]);

        return redirect('/profilekendaraan')->with('success', 'Kendaraan Berhasil Ditambahkan!');
    }

    public function editkendaraan($id)
    {
        $data['category_kendaraan'] = CategoryKendaraan::all();
        $data['kendaraans'] = Kendaraan::find($id);

        //create data (add)
        return view(
            'user/editkendaraan',
            $data
        );
    }

    public function updatekendaraan(Request $request, $id)
    {
        // mendapatkan data product
        $dataKendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'category_kendaraan_id' => 'required',
            'plat' => 'required'
        ]);

        // update data pada database berdasarkan id
        Kendaraan::where('id', $id)->update([
            'merk' => $validated['merk'],
            'model' => $validated['model'],
            'category_kendaraan_id' => $validated['category_kendaraan_id'],
            'plat' => $validated['plat'],
        ]);

        return redirect('/profilekendaraan')->with('success', 'Kendaraan Berhasil Diedit!');
    }

    public function destroykendaraan($id)
    {
        Kendaraan::destroy($id);

        return redirect('/profilekendaraan')->with('success', 'Kendaraan Berhasil Dihapus!');
    }

    public function showtransaksi()
    {
        $user = Auth::user();
        $idUser = $user->id;

        $booking = Booking::with(['kendaraan', 'user', 'bengkel'])
            ->where('user_id', $idUser)->orderBy('id', 'desc')->paginate(4);

        $detail_booking = DetailLayananBooking::with(['booking', 'layanan'])->get();
        // dd($detail_booking);

        // dd($booking);
        return view('user/profiletransaksi', ['user' => $user, 'transaksi' => $booking, 'detail_booking' => $detail_booking]);
    }
}
