@extends('layouts.master')

@section('title', 'My Profile')

@section('sidebar')
    @parent
@stop

@section('content')
    <script type="text/javascript" src="js/profile.js"></script>
    @if(isset($upload_success))
    <div class="row col-md-12"><p class="bg-success"><strong>Your photo has successfully been uploaded and is waiting for approval!</strong></p></div>
    @elseif(isset($upload_error))
    <div class="row col-md-12"><p class="bg-danger"><strong>{{$upload_error}}</strong></p></div>
    @endif
    <input type="hidden" id="data-token" value="{{ csrf_token() }}" />
    <div class="row">
        <div class="col-md-4">
            <h2>My Profile</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo Auth::user()->name; ?>" readonly />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="Email" id="Email" value="<?php echo Auth::user()->email; ?>" readonly />
                <p class="help-block">Last seen <?php echo Auth::user()->updated_at; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Instagram @if(isset($instagram_username)) <small style="color: green;">connected</small>@endif</h2>
            <div class="form-group">
                <label for="instagram_username">Username</label>
                <input class="form-control" type="text" name="instagram_username" id="instagram_username" readonly />
            </div>
            <div class="form-group">
                <label for="instagram_access_token">Access Token</label>
                <input class="form-control" type="text" name="instagram_access_token" id="instagram_access_token" readonly />
            </div>
            @if (isset($instagram_username))
            <a id="btn-instagram-disconnect" class="btn btn-danger" role="button" href="#">Disconnect Wanderlust from Instagram</a>
            @else
            <a class="btn btn-primary" role="button" href="https://api.instagram.com/oauth/authorize/?client_id=39660a54ed2846d6bdc2f5946cbbc19e&redirect_uri=http://larsen-asp.no/Wanderlust/Wanderlust/public/instagram&response_type=code">Connect Wanderlust to Instagram</a>
            @endif
        </div>
        <div class="col-md-4">
            <h2>Statistics</h2>
                <table class="table table-striped">
                    <tr>
                        <th>Number of Images</th>
                        <td>53</td>
                    </tr>
                    <tr>
                        <th>Number of Views</th>
                        <td>6485</td>
                    </tr>
                    <tr>
                        <th>Number of Votes</th>
                        <td>462</td>
                    </tr>
                </table>
        </div>
    </div>  
    <div class="row">
        <div class="col-md-8">
            <h2>Upload Image</h2>
            
            <form action="upload" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
                <div class="form-group">
                    <label for="photo">Select Image</label>
                    <input type="file" name="photo" id="photo" />
                    <p class="help-block">Allowed image types: PNG, JPEG and GIF.</p>
                </div>
                <input type="submit" class="btn btn-primary" value="Upload Now" />
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Upload Image From Instagram</h2>
            <small>Click on a image and it will be uploaded and sent to admins for further approval.</small>
            <div id="divInstaPhotos"></div>
        </div>
    </div>
@stop

@section('footer')
    @parent
@stop