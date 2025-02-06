<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    
    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach
</head>
<body class="bg-light">
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg bg-white shadow-lg rounded w-100 p-3">
            <a class="navbar-brand" href="#">E-Commerce Vendor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product_index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order_index') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reporting_transaction') }}">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Account Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content mt-4">
            @yield('content')
        </div>

    </div>

    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach
</body>
</html>
