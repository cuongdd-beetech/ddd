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
                <h4>Reset Password</h4><hr/>
                <form action="{{ route('admin.postGetPass',['admin'=> $admin->id, 'token'=> $admin->token]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password"value="{{ old('password') }}">
                    </div>
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    <div class="form-group">
                        <label for="password">Confirm password</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter confirm password"value="{{ old('cpassword') }}">
                    </div>
                    <span class="text-danger">@error('confirm_password'){{ $message }}@enderror</span>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>                
                </form>
            </div> 
        </div>
    </div>
</body>
</html>