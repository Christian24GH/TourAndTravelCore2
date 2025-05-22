<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Core Transaction 2</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    @yield('modal')
    <div class="container-fluid">
        <div class="row">
            @include('components/sidebar')
            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @yield('dashboard')
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>