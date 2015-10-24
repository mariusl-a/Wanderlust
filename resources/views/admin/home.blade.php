@extends('layouts.master')

@section('title', 'Admin')

@section('sidebar')
    @parent

    <!--</a><p>This is appended to the master sidebar.</p>-->
@stop

@section('content')
    <script type="text/javascript" src="js/admin.js"></script>
    <input type="hidden" id="data-token" value="{{ csrf_token() }}" />
    <div class="row">
        <div class="col-md-12">            
            <h2>Admin</h2>
            <div id="divAdminPhotos" class="col-md-offset-4">
            
            </div>
        </div>
    </div>  

    
@stop

@section('footer')
    @parent
@stop