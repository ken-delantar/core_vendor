<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor Registration</title>

    @foreach (glob(public_path('css/*.css')) as $cssFile)
        <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
    @endforeach

    <style>
        #step-1, #step-2, #step-3 {
            display: none;
        }

        #step-1 {
            display: block;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div>
            <h1>Welcome to the Vendor Registration</h1>
            <p>Complete vendor application to get started</p>
        </div>
    
        <div>
            <form action="{{ route('acc_registration') }}" method="POST" class="row justify-content-center mt-5">
                @csrf
                @method('POST')
                
                <div class="col-12 col-md-8 col-lg-5 bg-white p-5 rounded-lg shadow-lg" id="step-1-2">
                    <div id="step-1">
                        <h3>Personal Information</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Ex: Juan Dela Cruz">  
                            @if ($errors->has('full_name'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Ex: Brgy. 176, Caloocan City">
                            @if ($errors->has('address'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="Ex: 09123456789">
                            @if ($errors->has('phone'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            @if (session()->has('error'))
                                <div class="text-danger mt-1">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>                        

                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-primary px-4" type="button" onclick="display('step-1', 'step-2')">Next</button>
                        </div>
                    </div>
    
                    <div id="step-2">
                        <h3>Login Information</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Ex: vendor@email.com">
                            @if ($errors->has('email'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password">
                            @if ($errors->has('password'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary px-4 m-1" onclick="display('step-2', 'step-1')">Back</button>
                            <button type="submit" class="btn btn-primary px-4 m-1">Finish</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @foreach (glob(public_path('js/*.js')) as $jsFile)
        <script src="{{ asset('js/' . basename($jsFile)) }}"></script>
    @endforeach

    <script>
        function display(current, next) {
            if (current === 'step-3') {
                document.getElementById('step-1-2').style.display = 'block';
            }
            document.getElementById(current).style.display = 'none';
            document.getElementById(next).style.display = 'block';
        }
    </script>
</body>
</html>
