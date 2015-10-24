@extends('layouts.master')

@section('title', 'Log In')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="row">
        <div id="divLogin" class="col-md-4 col-xs-12">
            <h2>Log In</h2>
            <form method="POST" action="auth/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" />
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div id="divRegister" class="col-md-8 col-xs-12">
            <h2>Sign Up</h2>
                <form method="POST" action="auth/register">
                    {!! csrf_field() !!}
                
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password"/>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"  />
                    </div>
                    <button type="submit" class="btn btn-default">Sign Up</button>
                </form>
        </div>
        
    </div>
    
@stop

@section('footer')
    @parent
@stop