<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if user is authed
        if($request->user()) {
            // Check if we have received a instagram code to perform 'third step'
            if ($request->has('code')) {
    
                $apiData = array(
                  'client_id'       => '39660a54ed2846d6bdc2f5946cbbc19e',
                  'client_secret'   => '4c061043413b45548d4ce2c99ff34815',
                  'grant_type'      => 'authorization_code',
                  'redirect_uri'    => 'http://larsen-asp.no/Wanderlust/Wanderlust/public/instagram',
                  'code'            => $request->input('code')
                );
                
                $apiHost = 'https://api.instagram.com/oauth/access_token';
                           
                // Open connection
                $ch = curl_init();
            
                curl_setopt($ch, CURLOPT_URL, $apiHost);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
                //execute post
                $result = curl_exec($ch);
            
                //close connection
                curl_close($ch);
                
                $data = json_decode($result, true);
                DB::table('users_instagram')->where('uid', $request->user()->id)->delete();
                //DB::insert('insert into users_instagram (uid, access_token, username, bio, profile_picture, full_name, insta_id) values (?, ?, ?, ?, ?, ?, ?)', 
                
                
                DB::table('users_instagram')->insert(
                array(
                    'uid' => $request->user()->id, 
                    'access_token' => $data['access_token'],
                    'username' => $data['user']['username'],
                    'bio' => $data['user']['bio'],
                    'profile_picture' => $data['user']['profile_picture'],
                    'full_name' => $data['user']['full_name'],
                    'insta_id' => $data['user']['id'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()           
                ));
                
                return view('user.profile'); 
                 
            }  
            return "Error.";
        }
        return "Please login.";
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
        if($request->user()) {
            // Open the file to get existing content
            $data = file_get_contents($request->photoUrl);
            $size = getimagesize($request->photoUrl);
            $extension = image_type_to_extension($size[2]);
            // Set destination folder (public/images/uploads)
            $destinationPath = public_path('images/uploads/');
            // Create a filename thats not already in use
            $fileName = rand(11111111111,99999999999).$request->user()->id.'.'.$extension;
    
            // Write the contents back to a new file
            file_put_contents($destinationPath.$fileName, $data);
            
            // Add to our images table so admin can approve it before it'll show on the front page
            DB::table('images')->insert(
            array(
                'uid' => $request->user()->id, 
                'name' => $request->photoUrl,
                'path' => "images/uploads/".$fileName,
                'confirmed' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()                     
            ));        
            
            return Response::json(array('result' => true, 'message' => "Instagram photo has been uploaded successfully - Waiting for admin approval."));
        }
        return Response::json(array('result' => false, 'message' => "You need to login!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    { 
        // Check that the user is authed
        if($request->user()) {
            $instaData = DB::table('users_instagram')->where('uid', $request->user()->id)->first();
            if($instaData)
            {
                return Response::json(array('access_token' => $instaData->access_token, 'instagram_username' => $instaData->username));
            }
        }
        return Response::json(array('result' => false, 'message' => "You need to login!"));
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
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // Check that the user auth
        if($request->user()) {
            // Remove instagram connection by deleting the row for that user 
            DB::table('users_instagram')->where('uid', $request->user()->id)->delete();
            return Response::json(array('result' => true, 'message' => "Instagram is no longer connected with Wanderlust!"));
        }
        return Response::json(array('result' => false, 'message' => "You need to login!"));
    }
}
