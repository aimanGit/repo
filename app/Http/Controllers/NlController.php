<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class NlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $nl = DB::table('nl')
            -> where('user_id', '=', Auth::user()->id)
            -> orderBy('created_at','desc')
            -> get();

        return view('nl',['nl'=>$nl]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function second(){

        $nl = DB::table('nl')
            -> where('user_id', '=', Auth::user()->id)
            -> orderBy('created_at','desc')
            -> get();

        return view('nl2',['nl'=>$nl]);
    }

    public function republish($id){

        DB::table('nl')
            ->where('id',$id)
            ->update([
                        'deleted_at' => now()->addMinutes(2),
                    ]);

        return redirect('list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('nl')->insert([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'article' => $request['article'],
            'deleted_at' => now()->addMinutes(2),
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nl = DB::select('select * from nl where id= :id',['id'=>$id]);

        return view('edit',['data'=>$nl]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('nl')
            ->where('id',$id)
            ->update([
                        'title' => $request['title'],
                        'article' => $request['article'],
                        'updated_at' => now(),
                    ]);

        return redirect('list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('nl')
            ->where('id', $request->iddlt)
            ->update([
                'deleted_at' => now()
            ]);

        return redirect()->back();
    }
}
