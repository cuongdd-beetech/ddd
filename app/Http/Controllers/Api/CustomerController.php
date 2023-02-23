<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     *  show infor customer after login by token
     *
     *
     * @return response
     */
    public function getCustomer() {
        $customer = Auth::user();
        return response()->json(['customer' => $customer],Response::HTTP_OK);
    }

    /**
     *  Loggout Customer
     *
     * @return response
     */
    public function logout() {
        $customer = Auth::user()->token();
        $customer->revoke();
        return response()->json('Successfully logged out');
    }

    
    /**
     *  update Customer
     * 
     *  @param Request $request
     * 
     * @return response
     */
    public function update(Request $request)
    {
       $customer = Customer::find($request->customer['id']);
        if($customer) {
            $customer->email = $request->customer['email'];
            $customer->phone = $request->customer['phone'];
            $customer->birthday = $request->customer['birthday'];
            $customer->full_name = $request->customer['full_name'];
            $customer->address = $request->customer['address'];
            $customer->province_id = $request->customer['province_id'];
            $customer->district_id = $request->customer['district_id'];
            $customer->commune_id = $request->customer['commune_id'];
            $customer->status = $request->customer['status'];
            $customer->update($request->all());
            return response()->json(['msg'=>'success update infomation'], Response::HTTP_OK);
        } else { 
            return response()->json(['msg'=>'fail update infomation'],  Response::HTTP_NOT_FOUND);
        } 
    }
}
