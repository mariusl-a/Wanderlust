<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Validator;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        
        // Get all images that has been confirmed by an administrator
        $images = DB::table('images')
            ->where('confirmed', '=', '1')
            ->orderby('updated_at', 'desc')
            ->get();
        
        // Loop and create array with the data we need
        foreach ($images as $image) 
        {
            $data[] = array('url' => $image->path);
        }  
        
        // Return
        return Response::json($data);
    }
    
    public function upload(Request $request) 
    {
        // Check if we got a file input called photo
        if ($request->hasFile('photo'))
        {
            // Check if its valid (saved in temp folder)
            if ($request->file('photo')->isValid())
            {
                if($request->file('photo')->getClientSize() < 2500000)
                {
                    // Set destination folder (public/images/uploads)
                    $destinationPath = public_path('images/uploads');
                    // Get the file extension (jpg? png? gif?)
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    // Create a random name and hope it's not already in use..
                    $fileName = rand(11111111111,99999999999).$request->user()->id.'.'.$extension;
                    // Move img to destination folder..
                    $request->file('photo')->move($destinationPath, $fileName);
                    // Insert data to database so we can let the admins handle it and hopefully show the image on the front page!
                    DB::table('images')->insert(
                    array(
                        'uid' => $request->user()->id, 
                        'name' => $request->file('photo')->getClientOriginalName(),
                        'path' => "images/uploads/".$fileName,
                        'confirmed' => 0,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()                     
                    ));
                    
                    //Update: DB::table('users')->where('id', $request->user()->id)->increment('num_images', 1);
                    
                    return view('user.profile', array('upload_success' => true));
                }
                // File upload is over 2.5Mb
                return view('user.profile', array('upload_error' => "Error: Photo is too large"));
            }
            // File upload was not saved in our temp folder (isValid() returned false)
            return view('user.profile', array('upload_error' => "We're sorry! Something went wrong when processing your photo, please try again soon!"));
        } 
        return view('user.profile', array('upload_error' => "We're sorry! Something went wrong, please try again soon!"));
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
        //$name = $request->input('name');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Not used
        $image = DB::table('images')->where('id', $id)->first();
        return response()->json(['id' => $image->id, 'name' => $image->name, 'path' => $image->path, 'views' => $image->views, 'votes' => $image->votes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * GET /image/{id}/edit
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
