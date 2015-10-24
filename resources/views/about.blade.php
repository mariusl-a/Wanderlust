@extends('layouts.master')

@section('title', 'About')

@section('sidebar')
    @parent

    <!--</a><p>This is appended to the master sidebar.</p>-->
@stop

@section('content')
        <div class="row">
            <div class="col-md-9" style="font-size: 16px;">
            <h2>About Wanderlust</h2>
            <p>Wanderlust (noun): A strong desire for or impulse to wander or travel and explore the world.<br />
                From the German word Wandern - to hike and Lust - desire. <br /><br />
                
                Wanderlust is a photo sharing site for the adventureres, exploreres, travelers and dreamers. <br /><br />
                
                Share your best pictures from your latest trip, or plan a trip by adding pictures of your "must sees" for your next adventure. <br /><br />
                
                Wanderlust aim to be a inspirational site where the users can save, share and watch pictures from the whole world. Keeping the dream alive, and urging people to take a trip around the world, even if it's just from the comfort of your own livingroom.</p>
            </div>
            <div class="col-md-3">
                <img height="350" src="https://scontent-ams2-1.xx.fbcdn.net/hphotos-xpa1/v/t34.0-12/12178148_10154615412312619_557441779_n.jpg?oh=3aa585c056c2fd5efa508c4a63da1769&oe=562C068E" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h2>Partners</h2>
                <img width="150" src="http://1.bp.blogspot.com/-V0AvMgxuMYo/U3XF4Lsp2xI/AAAAAAAAACM/5Z9PMDzmxMU/s1600/mini-instagram.png" />
            </div>
        </div>    
    
    
@stop

@section('footer')
    @parent
@stop