<div style="width:600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Hi {{ $admin->user_name }}!</h2>
        <p>This email will help you get your Password</p>
        <p>To continues use your service, please enter under link to get your account</p>
        <p>Attention! Verification code is only valid for 3 hours</p>
        <p><a href="{{ route('admin.getPass',['admin'=> $admin->id, 'token'=> $admin->token]) }}"
            style="display:inline-block; background: green; color: #fff; padding: 7px 25px; font-weight:bold">Reset password</a></p>
    </div>
</div>