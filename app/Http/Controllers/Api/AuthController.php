<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CustomerRegister;
use App\Http\Requests\Api\CustomerLogin;
use App\Models\Customer;
use Illuminate\Http\Client\Request as ClientRequest;
use Mollie\Api\Resources\Customer as ResourcesCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     *  Register for customer
     *
     * @param CustomerRegister $request
     *
     * @return response
     */
    public function register(CustomerRegister $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $customer = Customer::create($validated);
        return response()->json(['customer'=> $customer, 'msg'=> 'Succesfull register'], Response::HTTP_OK);
    }


    /**
     *  Login for customer
     *
     * @param CustomerLogin $request
     *
     * @return response
     */
    public function login(CustomerLogin $request)
    {
        $data = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];
        if(Auth::guard('customers')->attempt($data)) {   
            $customer = Auth::guard('customers')->user();
            $customer->access_token = $customer->createToken("vjshop.vn")->accessToken;
            return response()->json(['customer'=> $customer, 'msg' => 'Success'], Response::HTTP_OK);
        }else {
            return response()->json(['msg' => 'fail'], 211);
        }
    }
}
