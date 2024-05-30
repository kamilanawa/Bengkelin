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
                <form action="{{ route('updatetransaksi', ['id' => $bookings->id]) }}" method="post">
                    @method('put')
                    @csrf
                    @if ($bookings->gambar)
                        <div class="mb-3 form">
                            <label for="gambar" class="form-label">Gambar Booking</label>
                            <br>
                            <img src="{{ asset('images/' . $bookings->gambar) }}" alt="" width="400px">
                        </div>
                    @endif

            </div>
            <div class="mb-3 form">
                <label for="status" class="form-label">Status Booking</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    @foreach (App\Enums\BookingStatus::cases() as $status)
                        <option value="{{ $status->value }}" @if ($bookings->status->name == $status->value) selected @endif>
                            {{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        Status tidak boleh kosong
                    </div>
                @enderror
            </div>
            {{-- menambahkan form baru untuk keterangan, dan hanya tampil ketika memilih status ditolak --}}
            <div class="mb-3 form" id="box-keterangan" @if ($bookings->status->name != 'Ditolak') style="display: none" @endif>
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                    rows="3">{{ $bookings->keterangan }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">
                        Keterangan tidak boleh kosong
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
    @include('sweetalert::alert')
    {{-- menambahkan jaascript untuk secara kondisional menyembunyikan input keterangan --}}
    <script>
        const status = document.getElementById('status');
        const keterangan = document.getElementById('box-keterangan');

        status.addEventListener('change', function() {
            if (status.value == 'Ditolak') {
                keterangan.style.display = 'block';
            } else {
                keterangan.style.display = 'none';
            }
        });
    </script>

@endsection
