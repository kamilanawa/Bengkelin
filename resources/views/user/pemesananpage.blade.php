@extends('layouts.app')

@section('title', 'Pesan Bengkel')

@section('content')

    <div class="mb-xl-5 pesan">
        <div class="pesan-bengkel">
            <div class="container my-3 p-5">
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('/booking') }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <h1 class="text-center font-weight-bold">Pesan Bengkel</h1>
                            <div class="mb-3">
                                <h4 class="font-weight-bold mb-3">Data Customer </h4>
                                <label for="exampleInputName" class="form-label">Name</label>
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"
                                    class="@error('user_id') is-invalid @enderror">
                                <input type="text" class="form-control" id="exampleInputName" aria-describedby="name"
                                    value="{{ $user->name }}" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail"
                                    value="{{ $user->email }}" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="typeNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="typeNumber" value="{{ $user->phone_number }}"
                                    name="phone_number">
                            </div>
                        </div>
                        <div class="mb-5">
                            <h4 class="font-weight-bold mb-3 ">Data Kendaraan</h4>
                            <div class="pesan">
                                <label for="kategori" class="form-label">Pilih Kendaraan</label>
                                <select class="form-select  @error('kendaraan_id') is-invalid @enderror"
                                    aria-label="Default select example" name="kendaraan_id" id="kendaraan_id">
                                    @foreach ($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id }}">{{ $kendaraan->model }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="font-weight-bold mb-3 ">Waktu Service</h4>
                            <div class="row g-4 pesan">
                                <div class="col mb-3">
                                    <label for="waktu_booking" class="form-label">Tanggal Service</label>
                                    <input type="datetime-local"
                                        class="form-control w-100 @error('waktu_booking') is-invalid @enderror"
                                        id="waktu_booking" name="waktu_booking">
                                    <i class="text-secondary">* Pilih waktu dan tanggal booking sesuai dengan waktu
                                        operasional Bengkel</i>
                                    @error('waktu_booking')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="font-weight-bold mb-3 ">Detail Service</h4>
                            <div class="col-auto mb-3">
                                <h5 class="mb-3">Tipe Service</h5>
                                <select class="form-select @error('tipe_booking') is-invalid @enderror" id="tipe_booking"
                                    name="tipe_booking">
                                    @foreach (App\Enums\BookingType::cases() as $tipe)
                                        <option value="{{ $tipe->value }}">{{ $tipe->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h5 class="mb-3">Pilih Service</h5>
                            <input type="hidden" value="{{ $id_bengkel }}" name="bengkel_id" id="bengkel_id"
                                class="@error('bengkel_id') is-invalid @enderror">
                            @foreach ($bengkels as $bengkel)
                                @forelse ($bengkel->layanans as $layanan)
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                value="{{ $layanan->id }}" aria-label="Checkbox for following text input"
                                                id="layanan_id" name="layanan_id[]">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox"
                                            value="{{ $layanan->name }} | {{ $layanan->price }}">
                                    </div>
                                @empty
                                    <div class="alert alert-danger" role="alert">
                                        Layanan bengkel belum tersedia
                                    </div>
                                @endforelse
                            @endforeach
                        </div>

                        <div class="mb-5">
                            <label for="catatan_tambahan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan_tambahan" name="catatan_tambahan" rows="3"
                                placeholder="Tambahkan catatan tambahan disini"></textarea>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-lg btn-primary btn-pesan">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
