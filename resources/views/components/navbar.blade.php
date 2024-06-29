<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="/">Mebel Siapa Dia<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item ">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="active"><a class="nav-link" href="shop.html">Shop</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                @guest
                <li>
                    <a class="nav-link" href="{{ route('login') }}"><img src="/assets/images/user.svg"></a>
                </li>
                @endguest

                @role('user')
                <li>
                    <a class="nav-link" href="#"><img src="/assets/images/user.svg"></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('cart.index') }}"><img src="/assets/images/cart.svg"></a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('logout') }}"><i class="ti ti-logout text-white ms-3" style="font-size: 1.9rem;"></i></a>
                </li>
                @endrole
            </ul>
        </div>
    </div>

</nav>
