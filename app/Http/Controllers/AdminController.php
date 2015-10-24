<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check that the user is authed and is an admin
        if($request->user() && $request->user()->admin) {
            
            $data = array();
            
            $images = DB::table('images')
                ->where('confirmed', '=', 0)
                ->join('users', 'users.id', '=', 'images.uid')
                ->select('users.name', 'users.email', 'images.path', 'images.id', 'images.confirmed')
                ->get();
                
            foreach($images as $image)
            {
                    $data[] = array('id' => $image->id, 'path' => $image->path, 'user_name' => $image->name, 'email' => $image->email);
            }
            
                //$data = array('access_token' => $instaData->access_token, 'instagram_username' => $instaData->username);
            return Response::json($data);
            
        }
        $data = array('error' => 'no access');
        return Response::json($data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        DB::table('images')
            ->where('id', $id)
            ->update(['confirmed' => 1, 'updated_at' => Carbon::now()->toDateTimeString()]);
        return Response::json(array('approved' => true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('images')->where('id', $id)->delete();
        return Response::json(array('deleted' => true));
    }
}
