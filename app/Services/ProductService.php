<?php
namespace App\Services;
use App\Models\Product;
use App\Http\Requests\Admin\ProductRequest;


class ProductService {
    /**
     *  upload Image form database
     * 
     * @param $request
     * 
     * 
     */
    public function uploadImg($request)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'_'.'product.'.$ext;
            $file->move(public_path('uploads/product'), $file_name);
            $request->merge(['avatar' => $file_name]);
        }
    }

    /**
     *  delete record form id
     * 
     * @param $id
     * 
     */
    public function delete($id)
    {
        DB::transaction(function () use($id) {
            $pro = Product::find($id);
            if($pro){
                $pro->delete();
            }
        });
    }
}