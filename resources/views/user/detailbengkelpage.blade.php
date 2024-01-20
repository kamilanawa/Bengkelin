@extends('layouts.app')

@section('title', 'Detail Bengkel')

@section('content')

    <div class="detail-bengkel p-5">
        <div class="container my-4">
            <div class="row gx-lg-5 d-flex align-items-center">
                <div class="col-lg-6 mb-5">
                    <img src="{{ asset('images/' . $bengkel->image) }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h1>{{ $bengkel->name }}</h1>
                    <div class="desc-bengkel-lokasi d-flex align-items-center">
                        <img src="{{ asset('css/icon-location.png') }}" alt="">
                        <h5>{{ $bengkel->alamat }}</h5>
                    </div>
                    <p>{{ $bengkel->description }}</p>
                </div>
            </div>
            <div class="row my-5 informasi-tambahan">
                <div class="detail-bengkel-informasi-tambahan d-flex align-items-center">
                    <img src="{{ asset('css/icon-informasi.png') }}" alt="">
                    <h5>Informasi Tambahan</h5>
                </div>
                <div class="col-lg-3 my-3">
                    <h6>Daftar Service</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama Service</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bengkel->layanans as $layanan)
                                <tr>
                                    <td>{{ $layanan->name }}</td>
                                    <td>{{ $layanan->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-9 my-3">
                    <h6>Jadwal Operasional</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Hari</th>
                                <th scope="col">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bengkel->jadwals as $jadwal)
                                <tr>
                                    <td>Senin</td>
                                    <td>{{ $jadwal->senin }}</td>
                                </tr>
                                <tr>
                                    <td>Selasa</td>
                                    <td>{{ $jadwal->selasa }}</td>
                                </tr>
                                <tr>
                                    <td>Rabu</td>
                                    <td>{{ $jadwal->rabu }}</td>
                                </tr>
                                <tr>
                                    <td>Kamis</td>
                                    <td>{{ $jadwal->kamis }}</td>
                                </tr>
                                <tr>
                                    <td>Jumat</td>
                                    <td>{{ $jadwal->jumat }}</td>
                                </tr>
                                <tr>
                                    <td>Sabtu</td>
                                    <td>{{ $jadwal->sabtu }}</td>
                                </tr>
                                <tr>
                                    <td>Minggu</td>
                                    <td>{{ $jadwal->minggu }}</td>
                                </tr>
                                <tr>
                                    <td>Libur Nasional</td>
                                    <td>Tutup</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row option p-3">
                <div class="col d-flex justify-content-between align-items-center">
                    <div class="nama-bengkel">
                        <h5>{{ $bengkel->name }}</h5>
                        <a href="{{ $bengkel->link_alamat }}">Lihat di Peta >>></a>
                    </div>
                    <div class="hubungi">
                        <a href="/booking/add/{{ $bengkel->id }}" class="btn btn-lg btn-primary pesan-bengkel">Pesan
                            Bengkel</a>
                    </div>

                </div>
                <div class="">
                    {{-- menambahkan testimonial atau review dari setiap user yang pernah memberikan review. --}}
                    @foreach ($testimonials as $item)
                        <div class="card mt-2">
                            <div class="card-body py-4 mt-2">
                                <h5 class="font-weight-bold">{{ $item->user->name }}</h5>
                                <ul class="list-unstyled d-flex ">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $item->rating)
                                            <i class="fas fa-star" style="color: #FFD600"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </ul>
                                <p class="mb-2">
                                    <i class="fas fa-quote-left pe-2"></i>{!! $item->review ?? '<i>Tidak ada review</i>' !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $testimonials->links() }} {{-- menampilkan pagination --}}
            </div>
        </div>
    </div>

@endsection
