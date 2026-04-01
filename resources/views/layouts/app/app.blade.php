<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cherish&family=Mali:ital,wght@0,300..700;1,300..700&family=Sriracha&display=swap" rel="stylesheet">
    @vite(["resources/css/app.css"])
    <title>Depo</title>
</head>
<body>
    <div class="wrapper d-flex">
        @include('layouts.app.menu')

        <div class="main flex-grow-1 d-flex flex-column min-vh-100" style="background-color:#FEF9F2">
            @include('layouts.app.navbar')
            
            <main class="contentp-4"> <div class="container-fluid p-0">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main> 

            @include('layouts.app.footer')
        </div>
    </div>

    @vite(["resources/js/app.js"])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>