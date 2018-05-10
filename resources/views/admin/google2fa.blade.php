<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin Area</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}" />
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
</head>
<body>
    <div class="loginmain">
    @if(Session::has('message'))
	<div class="incorrectbox" >
	    <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            </span>{{Session::get('message')}}
	</div>
       @endif
         <form name="userlogin" method="POST"  action="{{ adminurl("twofa/check") }}">
                   {!! csrf_field() !!}
	<div class="whiteloginbox">
	    <div class="loginlogo"><img src="{{asset('images/logo-login.jpg')}}"/></div>
	    <div class="adminname2">Enter Authorization Key</div>
            @if(isset($google2fa_url))
            <div style="text-align:center">{!! HTML::image($google2fa_url) !!}</div>
            @endif
            <div class="col-lg-12"><div class="left-inner-addon">
		   <i class="fa fa-key" aria-hidden="true"></i>
		    <input type="text" name="authkey" value="" placeholder="Enter Authorization Key" class="from-box-join-now2"/>
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
</body>
</html>
