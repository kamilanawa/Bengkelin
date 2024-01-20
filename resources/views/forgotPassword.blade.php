<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/icon-bengkel.png') }}" rel="Shorcut Icon" type="image/png">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Bengkelin | Forgot Password</title>

    <style>
        .login-box {
            /* border: solid 1px gray; */
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
            width: 500px;
            background-color: white;
            border-radius: 32px
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 70%;
        }
    </style>
</head>

<body>
    <div class="vh-100 p-5 d-flex justify-content-center align-items-center">
        <div class="login-box p-5">
            <div class="title mb-3">
                <img src="{{ asset('images/logo.png') }}">
                <p class="text-secondary text-center">Please enter your email for forgot your password</p>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" action="{{ route('forgotPassSend') }}">
                @csrf
                <div class="mb-3 form">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 mt-5 ">
                    <button class="btn btn-primary w-100" type="sub
                    "
                        style="border-radius: 20px;">Send</button>
                </div>
                <div class="mb-3 mt-4 ">
                    <p class="mt-3 text-center">Back to login?</p>
                    <a href="{{ route('login') }}" class="btn btn-md btn-primary w-100 mb-2 mt-2"
                        style="border-radius: 20px;">Login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
