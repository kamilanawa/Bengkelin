@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')

    <div class="container" style="margin-bottom: 200px;">
        <div class="row">
            <div class="col">
                <div class="text-center my-5">
                    <h3 class="title">Tambah Kendaraan</h3>
                </div>
            </div>
        </div>
        <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center data-user">
            <div class="col-lg-10">
                <!-- Create Post Form -->
                <form action="{{ url('/profilekendaraan') }}" method="POST">
                    @csrf
                    <div class="mb-3 form">
                        <label for="merk" class="form-label">Merk Kendaraan</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk"
                            name="merk">
                        <div id="emailHelp" class="form-text">Merk tidak boleh lebih dari 255 karakter</div>
                        @error('merk')
                            <div class="invalid-feedback">
                                Merk tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control @error('model') is-invalid @enderror" id="model"
                            name="model">
                        @error('model')
                            <div class="invalid-feedback">
                                Model tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form">
                        <label for="plat" class="form-label">Plat</label>
                        <input type="text" class="form-control @error('plat') is-invalid @enderror" id="plat"
                            name="plat">
                        @error('plat')
                            <div class="invalid-feedback">
                                Plat tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="form mb-3">
                        <label for="kategori" class="form-label">Kategori Kendaraan</label>
                        <select class="form-select @error('category_kendaraan_id') is-invalid @enderror"
                            aria-label="Default select example" name="category_kendaraan_id" id="category_kendaraan_id">
                            <option selected>Pilih Category</option>
                            @foreach ($category_kendaraan as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_kendaraan_id')
                            <div class="invalid-feedback">
                                Kategori tidak boleh kosong
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
