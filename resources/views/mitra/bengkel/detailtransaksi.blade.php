@extends('mitra.layouts.app')

@section('title', 'Bengkel | Detail Transaksi')

@section('content')
    <div class="card p-3">
        <div class="row m-4">
            <div class="col">
                <h2 class="m-3">Detail Transaksi</h2>
            </div>
        </div>
        <div class="row mx-4">
            <div class="col px-4">
                @php
                    $total_price = 0;
                @endphp
                <div class="card p-5">
                    <div class="card-body">
                        <h2 class="card-title">{{ $bookings->bengkel->name }}</h2>
                        <div>
                            <div class="detail-booking d-flex justify-content-between align-items-center">
                                <p style="margin: 0">ID Booking</p>
                                <p style="margin: 0" class="fw-bold">{{ $bookings->id }}</p>
                            </div>
                            <div class="detail-booking d-flex justify-content-between align-items-center">
                                <p style="margin: 0">Status</p>
                                <p style="margin: 0" class="fw-bold">{{ $bookings->status }}</p>
                            </div>
                            <div class="detail-booking d-flex justify-content-between align-items-center">
                                <p style="margin: 0">Tipe Booking</p>
                                <p style="margin: 0" class="fw-bold">{{ $bookings->tipe_booking }}</p>
                            </div>
                            <div class="detail-booking d-flex justify-content-between align-items-center">
                                <p style="margin: 0">Waktu Booking</p>
                                <p style="margin: 0" class="fw-bold">{{ $bookings->waktu_booking }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5>Informasi Tambahan</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Alamat User</th>
                                        <th scope="col">Catatan Tambahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{{ $bookings->user->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $bookings->user->alamat }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $bookings->catatan_tambahan }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <h5>Detail Layanan Booking</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Layanan</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_booking as $detail)
                                        @if ($detail->booking->id == $bookings->id)
                                            <tr>
                                                <td>
                                                    <p style="margin: 0">{{ $detail->layanan->name }}</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0">
                                                        Rp{{ number_format($detail->layanan->price, 0, ',', '.') }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @php
                                                $total_price += $detail->layanan->price * $detail->qty;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-5">
                            <h5 class="fw-bold">Total: Rp{{ number_format($total_price, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
