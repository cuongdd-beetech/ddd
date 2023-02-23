<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCartegory;
use App\Http\Requests\Admin\CategoryRequest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

class UserCategoryController extends Controller
{
    
    protected $CategoryService;
     /**
     *  call CategoryService class
     * 
     * @param CategoryService $CategoryService
     * 
     * @return Category view
     */
    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }
    
    /**
     *  show record of categories table
     * 
     * @return record category and view index get new data form
     */
    public function index() {
        $data = ProductCartegory::orderBy('id', 'ASC')->paginate(15);
        return view('dashboard.admin.category.index', compact('data'));
    }

    /**
     *  show category view
     * 
     * @return category view
     */
    public function create() {
        $data = ProductCartegory::where('parent_id', '=', 0)
                                ->orWhere('parent_id', '=', null)
                                ->get();
        return view('dashboard.admin.category.create', compact('data'));
    }

    /**
     *  store the value of form
     * 
     * @param CategoryRequest $request
     * 
     * @return category index view
     */
    public function store(CategoryRequest $request ) {
        ProductCartegory::create($request->all());
        return redirect()->route('admin.category.index')->with('mesage', 'successful add category from table');
    }

    /**
     *  show form need to change with a record
     * 
     * @param int $id
     * 
     * @return edit form
     */
    public function edit($id){
        $category = ProductCartegory::find($id);               
        if($category){
            $data = ProductCartegory::select('product_cartegories.*')
                                ->where('parent_id', '=', 0)
                                ->orWhere('parent_id', '=', null)
                                ->get();  
            return view('dashboard.admin.category.edit', compact('category', 'data'));
        } else {
            return redirect()->route('admin.category.index');
        }
    }

    /**
     *  update the value of form
     * 
     * @param CategoryRequest 
     * 
     * @param int $id
     * 
     * @return index category view
     */
    public function update(CategoryRequest $request, $id){
        DB::beginTransaction();
        try {
            $category = ProductCartegory::find($id);
            if($category){
                $category->name = $request->input('name');
                $category->parent_id = $request->input('parent_id');
                $category->update();
                DB::commit();
                return redirect()->route('admin.category.index')->with('status','Data update successfuly');
            } else {
                return redirect()->route('admin.category.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.category.index');
        }
    }

     /**
     *  Delete the data by Id
     * 
     * @param $id
     * 
     * 
     * @return product view
     */
    public function destroy($id){
        DB::beginTransaction();
        try {
            $data = $this->CategoryService->delete($id);
            DB::commit();
            if($data == true){
                    return redirect()->route('admin.category.index');
            } else {
                    return redirect()->route('admin.category.index')->with('ermessage', 'success when delete product from table');
            };
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.category.index');
        }
    }
}
