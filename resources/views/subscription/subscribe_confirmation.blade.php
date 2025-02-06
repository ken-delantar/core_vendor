<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <h1>Confirmation</h1>
            <p>Select price and billing period</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-4 ng-white p-5 shadow rounded">
                <h3>Plan Information</h3>
                <hr>
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    @method('POST')

                    <h4>{{ !empty($plan->name) ? $plan->name: 'No data' }}</h4>
                    <p>{{ !empty($plan->description) ? $plan->description : 'No data' }}</p>

                    @foreach ($prices as $price)
                        <div class="input-group mb-4">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" value="{{ $price->id }}" name="price_id" required>
                            </div>
                            <input type="text" class="form-control" value="₱{{ number_format($price->unit_amount / 100, 2) }}/{{ $price->recurring['interval'] }}" disabled>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded bg-lg">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach
</body>
</html>