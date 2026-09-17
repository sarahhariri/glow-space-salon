<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet" /> 
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"  rel="stylesheet"  />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
</head>

<body>
    <x-admin.admin-navbar />
    <div class="container-fluid">
        <div class="row">
            <x-admin.admin-sidebar />

            {{ $slot }}
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
