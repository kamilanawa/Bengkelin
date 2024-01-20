<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Bengkel;
use App\Models\Booking;
use App\Models\PemilikBengkel;

class BengkelController extends Controller
{
    public function index()
    {
        $data['bengkels'] = Bengkel::where('pemilik_id', Auth::id())->get();
        $item['owner'] = PemilikBengkel::all();
        return view('mitra.bengkel.index', $data, $item);
    }

    public function create()
    {
        $data['owners'] = PemilikBengkel::orderBy('name', 'ASC')->get();
        return view('mitra.bengkel.create', $data);
    }

    public function store(Request $request)
    {

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $owner = Auth::user();
        $owner_id = $owner->id;
        $bengkels = new Bengkel();
        $bengkels->name = $request->bengkel_name;
        $bengkels->description = $request->bengkel_description;
        $bengkels->alamat = $request->bengkel_address;
        $bengkels->link_alamat = $request->link_bengkel_address;
        $bengkels->image = $imageName;
        $bengkels->pemilik_id = $owner_id;

        $bengkels->save();

        return redirect()->route('bengkel.index')->with('success', 'Bengkel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['bengkels'] = Bengkel::findOrFail($id);
        $item['owner'] = PemilikBengkel::orderBy('name', 'ASC')->get();
        return view('owner.bengkel.edit', $data, $item);
    }

    public function update(Request $request, $id)
    {
        $bengkel = Bengkel::findOrFail($id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            $bengkel->image = $imageName;
        }

        $owner = Auth::user();
        $owner_id = $owner->id;
        $bengkel->name = $request->bengkel_name;
        $bengkel->description = $request->bengkel_description;
        $bengkel->alamat = $request->bengkel_address;
        $bengkel->link_alamat = $request->link_bengkel_address;
        $bengkel->pemilik_id = $owner_id;
        $bengkel->save();

        return redirect()->route('bengkel.index')->with('success', 'Bengkel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = Bengkel::findOrFail($id);

        if ($data->image) {
            // hapus gambar jika ada
            File::delete(public_path('images/' . $data->image));
        }

        $data->delete();

        return redirect()->route('bengkel.index')->with('success', 'Bengkel berhasil dihapus');
    }
}
