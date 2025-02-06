<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Subscription Details</h1>

     
            <table class="table">
                <thead>
                    <tr>
                        <th>Subscription ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Plan</th>
                        <th>Start Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions->data as $subscription)
                    @if ($subscription->status == 'active')
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->customer }}</td>
                            <td>{{ $subscription->status }}</td>
                            <td>{{ number_format($subscription->plan->amount / 100, 2) }} {{ strtoupper($subscription->plan->currency) }}</td>
                            <td>{{ $subscription->plan->nickname }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($subscription->start_date)->toFormattedDateString() }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
 
    </div>
</body>
</html>