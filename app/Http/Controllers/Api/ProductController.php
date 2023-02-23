<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
class ProductController extends Controller
{
    /**
     *  get all product
     *
     * @return response
     */
    public function getProduct()
    {
        $product = Product::select(['id','sku','name', 'stock','avatar','expired_at', 'category_id'])
                            ->orderBy('id','ASC')->paginate(15);
        return response()->json(['product'=> $product], Response::HTTP_OK);
    }


    /**
     *  get single product
     *
     * @param Request $request
     * 
     * @return response
     */
    public function getSingleProduct(Request $request)
    {
        $product = Product::select(['id','sku','name', 'stock','avatar','expired_at', 'category_id'])
                           ->where('id', $request->id)->first();
        if($product) {
            return response()->json(['product'=>$product], Response::HTTP_OK);
        }else {
            return response()->json(['not found product'], Response::HTTP_NOT_FOUND);
        }
    }
}
