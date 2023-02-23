<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}"> --}}

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px;">
                <h4>User Register</h4><hr/>
                <form action="{{ route('user.create') }}" method="post" autocomplete="off">
                    @if (Session::get('success'))
                         <div class="alert alert-success">
                             {{ Session::get('success') }}
                         </div>
                    @endif
                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email adress" value="{{ old('email') }}">
                    </div>
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password"value="{{ old('password') }}">
                    </div>
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Enter confirm password"value="{{ old('cpassword') }}">
                    </div>
                    <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <a href="{{ route('user.login') }}">I already have an account</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>