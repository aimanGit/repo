<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nl = DB::select('select * from nl where deleted_at is null or deleted_at > current_time order by created_at desc');

        return view('home',['data'=>$nl]);
    }

    public function second()
    {
        $nl = DB::select('select * from nl where deleted_at is null or deleted_at > current_time order by created_at desc');

        return view('home2',['data'=>$nl]);
    }
}
