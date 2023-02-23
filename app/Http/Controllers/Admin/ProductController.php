<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    protected $ProductService;
    /**
     *  call ProductService class
     * 
     * @param ProductService $ProductService
     * 
     * @return Product view
     */
    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }

    /**
     *  show record of product table
     * 
     * @return record product and view index get new data form
     */
    public function index() {
        // if(session(key: 'success_message')) {
        //     Alert::success('Success',session(key: 'success_message'));
        // }
        $key = request()->key;
        $stock = request()->stock;
        $pro = Product::select('products.name')->where('products.name', 'like','%'.$key.'%')->exists();
        $data = Product::select(['products.id','products.sku','products.name','products.stock','products.expired_at']);
        if($key && !$pro){
            $data = $data->leftjoin('product_cartegories', 'product_cartegories.id', '=', 'products.category_id')
                        ->where(function ($query) use ($key) {
                            $query->orwhere('product_cartegories.name','like','%'.$key.'%')
                                ->orwhere('products.name','like','%'.$key.'%');
                        });
        } 
        elseif($key && $pro){
            $data = $data->where('products.name','like','%'.$key.'%');
        }
        
        if($stock) {
            if($stock == 'less10') {
                $data = $data->where('stock','<',10);
            }
            elseif($stock == 'form10to100') {
                $data = $data->whereBetween('stock', [10, 100]);
            }
            elseif($stock == 'form100to200') {
                $data = $data->whereBetween('stock', [100, 200]);
            }
            elseif($stock == 'more200') {
                $data = Product::select(['id','name','sku','stock','expired_at']);
            }
        }
        $data =  $data->orderBy('id', 'ASC')->paginate(15);
        return view('dashboard.admin.product.index', compact('data'));
    }

    /**
     *  show product view
     * 
     * @return product view
     */
    public function create() {
        return view('dashboard.admin.product.create');
    }

     /**
     *  store the value of form
     * 
     * @param ProductRequest $request
     * 
     * @return product index view
     */
    public function store(ProductRequest $request ) {
        DB::beginTransaction();
        try {         
            $this->ProductService->uploadImg($request);;
        Product::create([
            'name'=>$request->name, 
            'stock'=>$request->stock, 
            'expired_at'=>$request->expired_at,
            'sku'=>$request->sku,
            'category_id'=> $request->category_id,
            'avatar'=> $request->avatar
        ]);
            DB::commit();
            return redirect()->route('admin.product.index')->withSuccessMessage('Create product successful');
        } catch (\Exception $th) {
            DB::rollBack();
            abort(404);
            return redirect()->route('admin.product.index')->withErrorsMessage('Fail to create product');        
        }  
    }
    
    /**
     *  show form need to change with a record
     * 
     * @param int $id
     * 
     * @return edit form
     */
    public function edit($id){
        $product = Product::find($id);
        if($product){
            return view('dashboard.admin.product.edit', compact('product'));
        } else {
            return redirect()->route('admin.product.index');
        }
    }

    /**
     *  Update the data by Id
     * 
     * @param ProductRequest $request
     * 
     * @param int $id
     * 
     * @return product view
     */
    public function update(ProductRequest $request, $id){
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            if($product){
                $this->ProductService->uploadImg($request);
                $data = [                    
                    "name" => $request->input('name'),
                    "stock" => $request->input('stock'),
                    "expired_at" => $request->input('expired_at'),
                    "sku" => $request->input('sku'),
                    "category_id" => $request->input('category_id'),                
                ];
                if($request->avatar) {
                    $data['avatar'] = $request->avatar;
                }
                $product->update($data);
                DB::commit();
                return redirect()->route('admin.product.index')->withSuccessMessage('Update product successful');
            }       
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('admin.product.index');
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
    public function delete($id){
        DB::beginTransaction();
        try {
            $this->ProductService->delete($id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.product.index');
        }      
    }

    /**
     *  Export the data to Excel file
     * 
     * @param Request $request
     * 
     * 
     * @return response to excel file
     */
    public function exportCsv(Request $request)
    {
       $fileName = 'product.csv';
       $tasks = Product::all();
    
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];
    
            $columns = ['Id',',', 'Sku',',', 'Name',',', 'Stock',',', 'Expired_at'];
    
            $callback = function() use($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
    
                foreach ($tasks as $task) {
                    fputcsv($file, [$task->id,'', $task->sku,'', $task->name,'', $task->stock,'', $task->expired_at->format('Y-m-d')]);
                }    
                fclose($file);
            };
    
            return response()->stream($callback, 200, $headers);
    }

    /**
     *  Export the data to Pdf file
     * 
     * @param Request $request
     * 
     * 
     * @return response
     */
    public function exportPdf(Request $request){
        $data = Product::select(['id','name','sku','stock','expired_at'])->orderBy('id', 'ASC')->get();
        $pdf = PDF::loadView('dashboard.admin.product.indexpdf', compact('data'))->setOptions(['defaultFont' => 'sans-serif']);;
        return $pdf->download('product.pdf');
    }

}
