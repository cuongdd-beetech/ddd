<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\MessageIo;
use Illuminate\Http\Request;
use LRedis;
// use Request;


class RedisController extends Controller
{
    public function index(Type $var = null)
    {
        $messages = MessageIo::all();
        return view('indexChat', compact('messages'));
    }

    public function postSendMessage(Request $request)
    {
        // dd($request->all());
        // $messages = MessageIo::create([
        //                                 'content'=> $request->input('content'), 
        //                                 'created_at'=> $request->created_at, 
        //                                 'update_at'=> $request->updated_at
        //                             ]);
        return redirect()->back();
    }
}
