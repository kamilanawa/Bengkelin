@extends('admin.app')

@section('title', 'Detail Owner')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Owner</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @foreach ($pemilik_bengkels as $owner)
                <div class="data-owner mb-5">
                    <h1 class="fw-bold">Data Owner</h1>
                    <p>Nama : {{ $owner->name }}</p>
                    <p>Email : {{ $owner->email }}</p>
                    <p>Phone Number : {{ $owner->phone_number }}</p>
                </div>
                <div class="data-bengkel mb-5">
                    <h1 class="fw-bold">Data Bengkel Owner</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Pemilik</th>
                                <th scope="col">Nama Bengkel</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Description</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bengkels as $bengkel)
                                <tr>
                                    @if ($owner->id == $bengkel->pemilik_id)
                                        <td>{{ $owner->name }}</td>
                                        <td>{{ $bengkel->name }}</td>
                                        <td><img src="{{ asset('images/' . $bengkel->image) }}" alt=""
                                                class="img-fluid"></td>
                                        <td>{{ $bengkel->description }}</td>
                                        <td>{{ $bengkel->alamat }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        <!-- /.card-body -->

    </div>
@endsection
