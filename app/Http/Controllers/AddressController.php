<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Models\District;
use App\Models\Commune;

class AddressController extends Controller
{
    /**
     *  response user data 
     * 
     * @param  Request $request
     * 
     * 
     * @return response
     */
    public function district(Request $request)
    {
        $districts = District::select('id', 'name')->where('province_id','=',$request->province_id)->get();
        return response([
            'data' => $districts,
            'code' => Response::HTTP_OK,
        ]);
    }

    /**
     *  respone the data 
     * 
     * @param  Request $request
     * 
     * 
     * @return response
     */
    public function commune(Request $request)
    {
        $communes = Commune::select('id', 'name')->where('district_id','=',$request->district_id)->get();
        return response([
            'data' => $communes,
            'code' => Response::HTTP_OK,
        ]);
    }

}
