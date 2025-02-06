<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor Index</title>

    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach

    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 400px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-body{
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .price {
            font-weight: 700;
            font-size: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <span>
                <h1>Welcome to the Vendor Portal</h1>
                <p>Sign up now to get started</p>
            </span>
            <span>
                <a href="{{ route('register') }}" class="text-black-50 m-2" style="text-decoration: none;">Apply</a>
                <a href="{{ route('sign_in') }}" class="text-black-50 m-2" style="text-decoration: none;">Sign in</a>
            </span>
        </div>
    </div>

    @if(session()->has('success'))
        <script>
            alert("{{ session('success') }}");
            @php session()->forget('success'); @endphp
        </script>
    @endif

    @if(session()->has('error'))
        <script>
            alert("{{ session('error') }}");
            @php session()->forget('error'); @endphp
        </script>
    @endif

    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach
</body>
</html>