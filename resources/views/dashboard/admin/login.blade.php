<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-info">
    <div class="container">
        <div class="row">
           <div class="col-md-4 offset-md-4" style="margin-top:45px;">
                <h4>Admin Login</h4><hr/>
                <form action="{{ route('admin.check') }}" method=" ">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @if(Session::get('yes'))
                        <div class="alert alert-success">
                            {{ Session::get('yes') }}
                        </div>
                    @endif
                    @if(Session::get('no'))
                    <div class="alert alert-danger">
                        {{ Session::get('no') }}
                    </div>
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name='email' placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="password" class="form-control" name='password' placeholder="Enter your password" value="{{ old('password') }}">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                       <p>You forgot password? <a href="{{ route('admin.forgetPass') }}" style="color: red"> Get your password</a></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>                
                </form>
            </div> 
        </div>
    </div>
</body>
</html>