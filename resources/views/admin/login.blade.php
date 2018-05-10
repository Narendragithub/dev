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
	<div class="incorrectbox" style="display:none">
	    <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
</span>Incorrect Username!!
	</div>
       
         <form name="adminlogin" id="adminlogin" method="POST" action="{{ action("Auth\AdminController@postLogin") }}">
                   {!! csrf_field() !!}
	<div class="whiteloginbox">
	    <div class="loginlogo"><img src="{{asset('images/logo-login.jpg')}}"/></div>
	    <div class="adminname2">Admin Login</div>
            
            @if(\Session::has('logerror'))
            <span class="text-danger">{{ \Session::get('logerror') }}</span><br/>
            @endif
	    <div class="col-lg-12">
                <div class="left-inner-addon">
		   <i class="fa fa-user" aria-hidden="true"></i>
		    <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="from-box-join-now2"/>
		</div>
            </div>
	    <div class="col-lg-12 ">
		<div class="left-inner-addon">
		    <i class="fa fa-lock" aria-hidden="true"></i>
		    <input type="password" name="password" id="password" placeholder="Password" class="from-box-join-now2"/>
		</div>
	    </div>
	   
	    <div class="col-lg-12" style="text-align: center; margin-top: 10px; padding-top: 20px;">
                
		   <button class="btn btn-primary" type="submit">Login</button>
                 
	    </div>
            <div class="col-lg-12 text-center customformfields">
                <a href="{{ action("Auth\AdminPasswordController@getEmail") }}">Forgot Password</a> 
                
            </div>
	</div>
         </form>
    </div>
    <script src="{{ asset('js/jquery1.11.0.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>  
        <script src="{{ asset('js/jquery.validator.js')}}"></script>
</body>
</html>
<script>
$(document).ready(function () {
            $("#adminlogin").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'Enter email address',
                        email: 'Enter valid email address'
                    },
                    password: {
                        required: 'Enter password'
                    }
                }
            });
        });
</script>