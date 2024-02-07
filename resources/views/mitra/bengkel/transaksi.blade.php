@extends('mitra.layouts.app')

@section('title', 'Bengkel | Transaksi')

@section('content')
    <div class="card p-3">
        <div class="row m-4">
            <div class="col">
                <h2 class="m-3">Daftar Transaksi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($bookings->isEmpty())
                    <p class="text-center fw-bold">Bengkel belum memliki transaksi</p>
                @else
                    <table class="table" id="table-bengkel">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelanggan</th>
                                <th>Waktu</th>
                                <th>Tipe Booking</th>
                                <th>Status</th>
                                <th>Kendaraan</th>
                                <th>Nama Bengkel</th>
                                <th>Alamat pelanggan</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->waktu_booking }}</td>
                                    <td>{{ $item->tipe_booking }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->kendaraan->model }}</td>
                                    <td>{{ $item->bengkel->name }}</td>
                                    <td>{{ $item->user->alamat }}</td>
                                    <td>
                                        <a href="transaksi/{{ $item->id }}/edit" class="btn btn-sm btn-info">Edit</a>
                                        <a href="transaksi/{{ $item->id }}" class="btn btn-sm btn-warning">Detail
                                            Transaksi</a>
                                        <a href="{{$item->user->link}}" class="btn btn-sm btn-danger">Lihat lokasi</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        {{-- <div class="mt-5">
            {{ $bookings->links() }}

        </div> --}}
    </div>
    @include('sweetalert::alert')
@endsection
