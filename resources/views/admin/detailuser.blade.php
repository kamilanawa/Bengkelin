@extends('admin.app')

@section('title', 'Detail')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail User</h3>

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
            @foreach ($users as $user)
                <div class="data-user mb-5">
                    <h1 class="fw-bold">Data User</h1>
                    <p>Nama : {{ $user->name }}</p>
                    <p>Email : {{ $user->email }}</p>
                    <p>Phone Number : {{ $user->phone_number }}</p>
                </div>
                <div class="data-kendaraan mb-5">
                    <h1 class="fw-bold">Data Kendaraan User</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Merk</th>
                                <th scope="col">Model</th>
                                <th scope="col">Plat</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kendaraans as $kendaraan)
                                <tr>
                                    @if ($user->id == $kendaraan->user->id)
                                        <td>{{ $kendaraan->merk }}</td>
                                        <td>{{ $kendaraan->model }}</td>
                                        <td>{{ $kendaraan->plat }}</td>
                                        <td>{{ $kendaraan->category_kendaraan->name }}</td>
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
