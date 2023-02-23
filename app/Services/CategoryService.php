<?php
namespace App\Services;
use App\Models\ProductCartegory;

class CategoryService {

    /**
     *  delete record form id
     * 
     * @param $id
     * 
     */
    public function delete($id)
    {
        $pro = ProductCartegory::find($id);
        if($pro){
            $pro->delete();
        }
    }
}
