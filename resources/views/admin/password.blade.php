<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Admin Area</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}" />
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
</head>
<body>
    <div class="loginmain">
	<div class="incorrectbox" style="display:none">
	    <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
</span>Incorrect Username!!
	</div>
       
         <form name="adminform" method="POST" action="{{ action("Auth\AdminPasswordController@getEmail") }}">
                   {!! csrf_field() !!}
	<div class="whiteloginbox">
	    <div class="loginlogo"><img src="{{asset('images/logo-login.jpg')}}"/></div>
	    <div class="adminname2">Reset password</div>
	    <div><div class="left-inner-addon">
		   <i class="fa fa-user" aria-hidden="true"></i>
		    <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="from-box-join-now2"/>
		</div></div>
	    
	   
	    <div style="text-align: center; margin-top: 10px; padding-top: 20px;">
		    <div class="bluebtn">
                        <a href="#"  onclick="document.adminform.submit();" style="padding-left: 30px; padding-right: 30px;" >Send Password Reset Link</a>
                    </div>
                 <!--<a href="{{ action("Auth\AdminPasswordController@getEmail") }}">Forgot Password</a>-->
	    </div>
	</div>
         </form>
    </div>
</body>
</html>