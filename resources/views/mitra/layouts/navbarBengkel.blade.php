<nav class="navbar navbar-expand-lg navbar-light bg-white z-index-3 py-3 position-fixed w-100 navbar-bengkel">
    <div class="container">
        <a class="navbar-brand" href="" rel="tooltip" data-placement="bottom">
            <img src="{{ asset('images/logo.png') }}" alt="" style="width: 100px">
        </a>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
            <ul class="navbar-nav d-lg-block d-none btn-navbar">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ 'bengkel' }}">Bengkel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ 'layanan' }}">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ 'jadwal' }}">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('bengkeltransaksi') }}">Transaksi</a>
                        </li>
                        <li class="nav-item dropdown" style="margin: 0px 0px 0px 200px;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @auth
                                    {{ Auth::user()->name }}
                                @endauth
                            </a>
                            <ul class="dropdown-menu">
                                {{-- <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Dashboard Bengkel</a></li> --}}
                                <li><a class="dropdown-item" href="{{ '/logout' }}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ '/bengkel' }}">Bengkel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ '/bengkel/layanan' }}">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ '/bengkel/jadwal' }}">Jadwal</a>
                        </li>
                        <li class="nav-item dropdown" style="margin: 0px 0px 0px 200px;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Resgist as User</a></li>
                                <li><a class="dropdown-item" href="#">Resgist as Owner</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
        </div>
</nav>
