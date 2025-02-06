<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Plan</title>

    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach

    <style>
        .card{
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div>
            <h1>Complete your Registration</h1>
            <p>Complete vendor application to get started</p>
        </div>

        <div>
            <h3>Choose your plan</h3>
            <hr>

            <div class="row justify-content-center mt-2">
                @foreach ($plans as $plan)
                    <div class="col-md-3 mb-3">
                        <div class="card shadow border-light bg-light rounded-lg py-4 px-3">
                            <div class="card-body text-center">
                                <h3 class="card-title font-weight-bold text-dark">{{ $plan->name }}</h3>
                                <p class="card-text text-muted">{{ $plan->description }}</p>

                                <div class="price mb-4">

                                    @foreach (\Stripe\Price::all(['product' => $plan->id]) as $price)
                                        <p class="display-5 m-0">₱{{ number_format($price->unit_amount / 100, 2) }}<span class="h5"></span></p>
                                        <h5 class="m-0 mb-2">/{{ $price->recurring['interval'] }}</h5>
                                    @endforeach

                                </div>
                                
                                <a href="{{ route('subscription_confirmation', $plan->id) }}" class="btn btn-primary w-100">Subscribe</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (!$plans)
                <h3>No data.</h3>
            @endif
        </div>
    </div>

    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach
</body>
</html>