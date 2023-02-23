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
                <h4>Get your password</h4><hr/>
                <form action="{{ route('admin.postForgetPass') }}" method="post">
                    @if(Session::get('yes'))
                        <div class="alert alert-success">
                            {{ Session::get('yes') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="email">Type an email you was used to get password.</label>
                        <label for="">Email*</label>
                        <input type="text" class="form-control" name='email' placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send confirm email</button>
                    </div>                
                </form>
            </div> 
        </div>
    </div>
</body>
</html>