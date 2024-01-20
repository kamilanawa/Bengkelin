@extends('layouts.app')

@section('title', 'Kendaraan')

@section('content')

    <div class="container" style="margin-bottom: 200px;">
        <div class="row">
            <div class="col">
                <div class="text-center my-5">
                    <h3 class="title">List Kendaraan</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ '/profilekendaraan/add' }}" class="btn btn-primary my-4" type="butoon">+ Tambah Kendaraan</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($kendaraans->isEmpty())
                    <p><i class="text-warning">Kendaraan Anda masih kosong, klik tombol di atas untuk menambahkan
                            kendaraan</i></p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Merk</th>
                                <th scope="col">Model</th>
                                <th scope="col">Plat</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kendaraans as $kendaraan)
                                <tr>
                                    @if (Auth::user()->id == $kendaraan->user->id)
                                        <td>{{ $kendaraan->merk }}</td>
                                        <td>{{ $kendaraan->model }}</td>
                                        <td>{{ $kendaraan->plat }}</td>
                                        <td>{{ $kendaraan->category_kendaraan->name }}</td>
                                        <td>
                                            <a href="/profilekendaraan/{{ $kendaraan->id }}/edit"
                                                class="card-link text-warning">Edit</a>
                                            <a href="/profilekendaraan/{{ $kendaraan->id }}/delete"
                                                class="card-link text-danger">Hapus</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
