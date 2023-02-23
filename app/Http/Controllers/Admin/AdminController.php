<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendEmail;
use Mail;
use Illuminate\Support\Str;
use PharIo\Manifest\Email;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     *  Validate form Admin login
     *
     * @param $request
     *
     * @return home or return login with message
     */
    function check(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in admins table'
        ]);

        $creds = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }

    /**
     *  logout from the homepages
     *
     * @return home
     */
    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    /**
     *  get email view
     *
     * @return view
     */
    public function forgetPass()
    {
        return view('dashboard.admin.getPassByEmail');
    }

    /**
     *  send email to setup get password
     *
     * @param Request $request
     * 
     * @return home
     */
    public function postForgetPass(Request $request)
    {
        $request->validate([
            'email'=>'required',
        ],[
            'email.required'=> 'bắt buộc',
        ]);
        DB::beginTransaction();
        try {
            $token = strtoupper(Str::random(10));
            $admin = Admin::where('email', $request->email)->first(); 
            $bmin = $admin->token_expiredat;
            $start = Carbon::now(); 
            if($admin) { 
                $data = [$admin->token = $token, $admin->token_expiredat = $start];
                $admin->update($data);
            };  
            if((Carbon::parse($bmin)->diffInMinutes($start)) > 180) {
                $admin->save([$admin->token = 1]);
            };  
            DB::commit();
            Mail::send('emails.checkEmailForget', compact('admin'), function($email) use($admin){
                $email->subject('MyShopping - Get Password');
                $email->to($admin->email,$admin->user_name);
            });
            return redirect()->route('admin.forgetPass')->with('yes','Success to send your email, pleas check email !');      
        } catch(\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.login');
        }
    }

    /**
     *  get view reset password
     * 
     * @param Admin $admin, $token
     *
     * @return getpass view
     */
    public function getPass(Admin $admin, $token)
    {
        if($admin->token === $token) {
            return view('dashboard.admin.getPass',compact('admin'));
        }
        return abort(404);
    }


    /**
     *  reset password && token
     *
     * @param Admin $admin, $token,Request $request
     * 
     * @return login view
     */
    public function postGetPass(Admin $admin, $token,Request $request)
    {
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);
        $password_h = bcrypt($request->password);
        $reset_pass = $admin->update([$admin->password = $password_h, $admin->token = null, $admin->token_expiredat = null]);
        if($reset_pass) {
            return redirect()->route('admin.login')->with('yes', 'Successful reset password, you can login now !');
        } else {
            return redirect()->route('admin.login')->with('no', 'fail reset password !');
        }
    }
}
