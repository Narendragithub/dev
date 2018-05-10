@extends('layouts/temp')

@section('content')
<div class="loginmain">
    @if(Session::has('message'))
	<div class="incorrectbox" >
	    <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            </span>{{Session::get('message')}}
	</div>
       @endif
         <form name="emailotp" id="emailotp" method="POST"  action="{{ adminurl("twofa/check") }}">
                   {!! csrf_field() !!}
	<div class="whiteloginbox">
	    <div class="loginlogo"><img src="{{asset('images/logo-login.jpg')}}"/></div>
	    <div class="adminname2">Enter OTP </div>
           
	    <div class="col-lg-12">
                <div class="left-inner-addon">
		   <i class="fa fa-user" aria-hidden="true"></i>
		    <input type="text" name="otp" value="" placeholder="Enter OTP " class="from-box-join-now2"/>
		</div>
            </div>
	    
	   
	    <div class="col-lg-12" style="text-align: center; margin-top: 10px; padding-top: 20px;">
                
		     <button class="btn btn-primary" type="submit">Validate</button>
                     <a class="btn btn-primary" type="button" href="{{adminurl('logout')}}">Logout</a>
                </br>
                 
	    </div>
             
	</div>
         </form>
    </div>


@stop
