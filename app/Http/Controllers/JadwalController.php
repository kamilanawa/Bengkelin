<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Models\Bengkel;
use App\Models\PemilikBengkel;

class JadwalController extends Controller
{
    public function index()
    {
        $item['bengkels'] = Bengkel::where('pemilik_id', Auth::id())->get();
        $bengkel_ids = $item['bengkels']->map(function ($bengkel) {
            return $bengkel->id;
        });
        $data['jadwals'] = Jadwal::with('bengkel')->whereIn('bengkel_id', $bengkel_ids)->orderBy('created_at', 'DESC')->get();
        return view('mitra.jadwal.index', $data, $item);
    }

    public function create()
    {
        $data['bengkels'] = Bengkel::orderBy('name', 'ASC')->get();
        return view('mitra.jadwal.create', $data);
    }

    public function store(Request $request)
    {
        $jadwals = new Jadwal();
        $jadwals->senin = $request->jadwal_senin;
        $jadwals->selasa = $request->jadwal_selasa;
        $jadwals->rabu = $request->jadwal_rabu;
        $jadwals->kamis = $request->jadwal_kamis;
        $jadwals->jumat = $request->jadwal_jumat;
        $jadwals->sabtu = $request->jadwal_sabtu;
        $jadwals->minggu = $request->jadwal_minggu;
        $jadwals->bengkel_id = $request->bengkel_id;
        $jadwals->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['jadwals'] = Jadwal::findOrFail($id);
        $item['bengkels'] = Bengkel::orderBy('name', 'ASC')->get();
        return view('jadwal.edit', $data, $item);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->senin = $request->jadwal_senin;
        $jadwal->selasa = $request->jadwal_selasa;
        $jadwal->rabu = $request->jadwal_rabu;
        $jadwal->kamis = $request->jadwal_kamis;
        $jadwal->jumat = $request->jadwal_jumat;
        $jadwal->sabtu = $request->jadwal_sabtu;
        $jadwal->minggu = $request->jadwal_minggu;
        $jadwal->bengkel_id = $request->bengkel_id;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = Jadwal::findOrFail($id);

        $data->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
