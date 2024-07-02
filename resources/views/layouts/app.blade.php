<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <title>Mebel SIP Mandala</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https:/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link href="/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    @stack('style')
</head>

<body>
    @include('components.navbar')

    @yield('hero')
    @yield('content')

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/tiny-slider.js"></script>
    <script src="/assets/js/custom.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        @if(session()->has('swal_e'))
            Swal.fire({
                icon: 'error',
                text: '{{ session('swal_e') }}'
                timer: 1500,
                showCancelButton: false,
            });
        @endif
    </script>

    @stack('script')
</body>
</html>
