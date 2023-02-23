<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *  Create,validate form admin register and send the message
     *
     * @param $request
     *
     * @return home or return login with message
     */
    function create(Request $request){
        $request -> validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if($save) {
            return redirect()->back()->with('seccess','You are now registered successfully');
        }else {
            return redirect()->back()->with('fail', 'something went wrong, failed to register');
        }
    }

    /**
     *  Check form admin login and send the message
     *
     * @param $request
     *
     * @return user.home or return user.login with message
     */
    function check(Request $request ) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ],[
            'email.exists'=>'this email is not exist on users table'
        ]);
        $creds = $request->only('email', 'password');
        if(Auth::guard('web')->attempt($creds)){
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect credentials');
        }
    }

    /**
     *  logout from the homepages
     *
     * @return user.login
     */
    function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }
}
