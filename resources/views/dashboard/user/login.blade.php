<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 off">
                <h1> User Login</h1>
                  <div class="form-control">
                      <form action="{{ route('check') }}" method="POST">
                        @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                        </div><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <br>
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Create an account</a>
                    
                      </form>
                  </div>
            </div>
        </div>
    </div>
</body>
</html>