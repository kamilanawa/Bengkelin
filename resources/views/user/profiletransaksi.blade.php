@extends('layouts.app')

@section('title', 'Profile Transaksi')

@section('content')
    <style>
        .circle-image img {

            border: 6px solid #fff;
            border-radius: 100%;
            padding: 0px;
            top: -28px;
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 100%;
            z-index: 1;
            background: #e7d184;
            cursor: pointer;

        }


        .dot {
            height: 18px;
            width: 18px;
            background-color: blue;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            border: 3px solid #fff;
            top: -48px;
            left: 186px;
            z-index: 1000;
        }

        .name {
            margin-top: -21px;
            font-size: 18px;
        }


        .fw-500 {
            font-weight: 500 !important;
        }


        .start {

            color: green;
        }

        .stop {
            color: red;
        }


        .rate {

            border-bottom-right-radius: 12px;
            border-bottom-left-radius: 12px;

        }


        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }



        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>
    <div>
        <div class="row">
            <div class="col">
                <div class="text-center my-5">
                    <h3 class="title">List Transaksi</h3>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @if ($transaksi->isEmpty())
                <h5 class=""><i class="text-warning">Ups, Kamu belum memiliki transaksi</i></h5>
            @else
                @foreach ($transaksi as $item)
                    <div class="col">
                        @php
                            $total_price = 0;
                        @endphp
                        <div class="card my-3 p-5">
                            <div class="card-body">
                                <div class="">
                                    <h4 class="card-title">{{ $item->bengkel->name }}</h4>
                                </div>
                                <div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">ID Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->id }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Status</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->status }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Tipe Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->tipe_booking }}</p>
                                    </div>
                                    <div class="detail-booking d-flex justify-content-between align-items-center">
                                        <p style="margin: 0">Waktu Booking</p>
                                        <p style="margin: 0" class="fw-bold">{{ $item->waktu_booking }}</p>
                                    </div>
                                    @if ($item->gambar)
                                        <div class="detail-booking d-flex justify-content-between ">
                                            <p style="margin: 0">Foto</p>
                                            <img src="{{ asset('images/' . $item->gambar) }}" alt=""
                                                style="width: 100px; height: 100px">
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-5">
                                    <h5>Detail Layanan Booking</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Layanan</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail_booking as $detail)
                                                @if ($detail->booking->id == $item->id)
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
                                    <h5>Total: Rp{{ number_format($total_price, 0, ',', '.') }}</h5>
                                </div>
                                @if ($item->status->value == 'Selesai')
                                    <div class="mt-5">
                                        <h5>Rating</h5>
                                    </div>
                                    <div class="">
                                        @if ($item->rating)
                                            <div class="rated">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $item->rating)
                                                        <i class="fas fa-star" style="color: #FFD600"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <p>
                                                    @if ($item->review != null)
                                                        {{ $item->review }}
                                                    @else
                                                        <i>Tidak ada review</i>
                                                    @endif
                                                </p>
                                            </div>
                                        @else
                                            <form action="{{ route('booking.rating', ['id' => $item->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="d-flex justify-content-between flex-column">
                                                    <div class="rating">
                                                        <input type="radio" @disabled($item->rating != null) name="rating"
                                                            value="5" id="5"
                                                            @if ($item->rating == 5) checked @endif>
                                                        <label for="5">☆</label>

                                                        <input type="radio" @disabled($item->rating != null) name="rating"
                                                            value="4" id="4"
                                                            @if ($item->rating == 4) checked @endif>
                                                        <label for="4">☆</label>

                                                        <input type="radio" @disabled($item->rating != null) name="rating"
                                                            value="3" id="3">
                                                        <label for="3">☆</label>
                                                        <input type="radio" @disabled($item->rating != null) name="rating"
                                                            value="2" id="2">
                                                        <label for="2">☆</label>
                                                        <input type="radio" @disabled($item->rating != null) name="rating"
                                                            value="1" id="1">
                                                        <label for="1">☆</label>
                                                    </div>
                                                    <textarea name="review" id="review" cols="30" rows="3" class="form-control mb-2"
                                                        @disabled($item->rating != null)>
                                                        @if ($item->review != null)
                                                        {{ $item->review }}
                                                        @endif
                                                    </textarea>
                                                    <button type="submit"
                                                        class="btn btn-primary @if ($item->rating != null) d-none @endif"
                                                        @disabled($item->rating != null)>Submit</button>
                                            </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                @endif
        </div>
    </div>
    @endforeach
    @endif
    </div>
    </div>
    <div class="my-5">
        <div class="mb-1">
            {{ $transaksi->links() }}
        </div>
    </div>
    </div>

    @include('sweetalert::alert')
@endsection