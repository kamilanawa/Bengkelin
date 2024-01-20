@extends('mitra.layouts.app')

@section('title', 'Bengkel | Transaksi')

@section('content')
    <div class="card" style="margin-bottom: 200px;">
        <div class="row m-4">
            <div class="col">
                <h2>Edit Transaksi</h2>
            </div>
        </div>
        <div class="row m-4">
            <div class="col">
                <form action="{{ route('simpantambahgambar', ['id' => $bookings->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form">
                        <label for="gambar" class="form-label">Tambah Gambar Booking</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                            name="gambar">
                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="action-user d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
