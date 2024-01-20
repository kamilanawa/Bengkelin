@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')

    <div class="container" style="margin-bottom: 200px;">
        <div class="row">
            <div class="col">
                <div class="text-center my-5">
                    <h3 class="title">Edit Kendaraan</h3>
                </div>
            </div>
        </div>
        <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center data-user">
            <div class="col-lg-10">
                <!-- Create Post Form -->
                <form action="/profilekendaraan/{{ $kendaraans->id }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3 form">
                        <label for="exampleInputEmail1" class="form-label">Merk Kendaraan</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="merk"
                            value="{{ $kendaraans->merk }}">
                        <div id="emailHelp" class="form-text">Merk tidak boleh lebih dari 255 karakter</div>
                        @error('merk')
                            <div class="invalid-feedback">
                                Merk tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form">
                        <label for="exampleInputPassword1" class="form-label">Model</label>
                        <input type="text" class="form-control @error('model') is-invalid @enderror"
                            id="exampleInputPassword1" name="model" value="{{ $kendaraans->model }}">
                        @error('model')
                            <div class="invalid-feedback">
                                Model tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form">
                        <label for="exampleInputPassword1" class="form-label">Plat</label>
                        <input type="text" class="form-control @error('plat') is-invalid @enderror"
                            id="exampleInputPassword1" name="plat" value="{{ $kendaraans->plat }}">
                        @error('plat')
                            <div class="invalid-feedback">
                                Plat tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form">
                        <label for="exampleInputPassword1" class="form-label">Category Kendaraan</label>
                        <select class="form-select @error('category_kendaraan_id') is-invalid @enderror"
                            aria-label="Default select example" name="category_kendaraan_id">
                            <option selected>Pilih Category</option>
                            {{-- @foreach ($category_kendaraan as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach --}}
                            @foreach ($category_kendaraan as $item)
                                @if ($kendaraans->category_kendaraan_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
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
