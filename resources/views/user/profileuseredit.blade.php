@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="profileuser">
        <div class="container">
            <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center nama-user">
                <div class="col-lg-3">
                    <img src="{{ asset('css/bengkels.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-4 my-3">
                    <h5>Welcome,</h5>
                    <h1>{{ $users->name }}</h1>
                </div>
            </div>
        </div>
        <div class="row px-5 gx-lg-5 d-flex justify-content-center align-items-center data-user">
            <div class="col-lg-8 ">
                <form action="/profileuser/{{ $users->id }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="form">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $users->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $users->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="name" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="name" name="phone_number"
                            value="{{ $users->phone_number }}">
                        @error('phone_number')
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="{{ $users->alamat }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                        @enderror
                    </div>
                    <div class="form">
                        <label for="link" class="form-label">Alaamat link</label>
                        <input type="text" class="form-control" id="link" name="link"
                            value="{{ $users->link }}">
                        @error('link')
                            <div class="invalid-feedback">
                                Link tidak boleh kosong
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
