<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Account</title>

    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="col-12 col-md-6 col-lg-4 bg-white p-5 rounded-lg shadow-lg">
            <form action="{{ route('sign_in_acc') }}" method="POST">
                @csrf

                <h3>Sign in</h3>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ex: juandelacruz@email.com">  
                    @error('email')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    @error('password')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>     

                @if (session()->has('error'))
                    <div class="text-danger mt-1">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary px-4 m-1">Back</button>
                    <button type="submit" class="btn btn-primary px-4 m-1">Continue</button>
                </div>
            </form>
        </div>
    </div>
    
    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach
</body>
</html>
