<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\EditUser;
use App\Jobs\SendEmailTest as Send;
use Illuminate\Support\File;
use App\Jobs\SendEmailTest;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
     /**
     *  get index view with data get from db
     *
     * @return view
     */
   public function index() {
    $key = request()->key;
    $data = User::select(['id','user_name','birthday','first_name','last_name','status','created_at']);
    if($key){
        $data->where(function($query) use ($key){
            $query->where('user_name','like','%'.$key.'%')
            ->orwhere('first_name','like','%'.$key.'%')
            ->orwhere('last_name','like','%'.$key.'%')
            ->orwhere('email','like','%'.$key.'%');
        });
    }
    $data = $data->orderBy('id','ASC')->paginate(15);
    return view('dashboard.admin.user.index', compact('data'));
    }

    /**
     *  get index view form add user
     *
     * @return view
     */
    public function create() {
        $provinces = Province::select('id','name')->orderBy('id', 'ASC')->get();
        return view('dashboard.admin.user.create', compact('provinces'));
    }

    /**
     *  Create new User and validate form add user
     * 
     * @param  UserRequest $request
     * 
     * @return new User and view index get new data form
     */
    public function store(UserRequest $request) {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'_'.'user.'.$ext;
            $file->move(public_path('uploads/user'), $file_name);
        }
        $request->merge(['avatar' => $file_name]);
        User::create([
            'email'=> $request->email,
            'user_name'=> $request->user_name,
            'birthday'=> $request->birthday,
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'province_id'=> $request->province_id,
            'district_id'=>$request->district_id,
            'commune_id'=> $request->commune_id,
            'avatar'=> $request->avatar
        ]);
        $mailUser['email'] = $request->email;
        dispatch(new Send($mailUser));
        return redirect()->route('admin.user.index')->withSuccessMessage('Create product successful');      
    }

    /**
     *  delete users form index view
     * 
     * @param  int $id
     * 
     * @return index view
     */
    public function destroy(Request $request){  
        DB::beginTransaction();     
        try {
            $user = User::find($request->id);
            if($user){
                $user->delete();
                DB::commit();
                return redirect()->route('admin.user.index');
            } else {
                return redirect()->route('admin.user.index')->with('ermessage', 'fail when add user from table');
            } 
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.user.index');
        }
    }

    /**
     *  show a form to update user
     * 
     * @param int $id
     * 
     * @return index view
     */
    public function edit(Request $request){
        $provinces = Province::select('id','name')->get();
        $user = User::find($request->id); 
        if($user){
            $districts = District::select('id', 'name')->where('province_id', '=', $user->province_id)->get();
            $communes = Commune::select('id', 'name')->where('district_id', '=', $user->district_id)->get();
            return view('dashboard.admin.user.edit', compact('user', 'provinces', 'districts', 'communes'));
        } else {
            return redirect()->route('admin.user.index');
        }
    }

    /**
     *  update user data 
     * 
     * @param  Request $request
     * 
     * @param int $id
     * 
     * @return index view
     */
    public function update(EditUser $request){
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if($user){
                $data = [
                    $user->user_name = $request->input('user_name'),
                    $user->email = $request->input('email'),
                    $user->birthday = $request->input('birthday'),
                    $user->first_name = $request->input('first_name'),
                    $user->last_name = $request->input('last_name'),
                    $user->province_id = $request->input('province_id'),
                    $user->district_id = $request->input('district_id'),
                    $user->commune_id = $request->input('commune_id'),
                ];
                if($request->has('file_upload')){
                    $file = $request->file_upload;
                    $ext = $request->file_upload->extension();
                    $file_name = time().'_'.'user.'.$ext;
                    $file->move(public_path('uploads/user'), $file_name);
                    $request->merge(['avatar' => $file_name]);
                }
                if($request->avatar) {
                    $data['avatar'] = $request->avatar;
                }
                $user->update($data);
                DB::commit();
                $mailUser['email'] = User::select('email')->find($request->id);
                dispatch(new Send($mailUser));
                return redirect()->route('admin.user.index')->with('status','Data update successfuly');
            } else {
                return redirect()->route('admin.user.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.user.index');

        }
    }
}
