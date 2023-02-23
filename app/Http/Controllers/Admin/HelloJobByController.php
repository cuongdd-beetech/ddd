<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\HelloJob;

class HelloJobByController extends Controller
{
    /**
     *  use queue to return a log message
     * 
     */
    public function helJob()
    {
        HelloJob::dispatch();
    }
}
