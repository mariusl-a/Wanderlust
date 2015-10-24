@extends('layouts.master')

@section('title', 'Home')

@section('sidebar')
    @parent
@stop

@section('content')
    <script type="text/javascript" src="js/home.js"></script>
    <div class="row">
        <div class="divImages col-md-12 col-xs-12"> 
            <h2>Explore</h2>
            <div id="divHomePhotos">
            </div>
        </div>
    </div>        
@stop

@section('footer')
    @parent
@stop