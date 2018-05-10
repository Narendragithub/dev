@extends('layouts/main')

@section('content')
<section id="main" data-layout="layout-1">
<div class="loginmain">
    <div class="alert alert-danger text-center">
        <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>Your account is not verified.<br>

        <p>Please activate your account using the activation link sent to your email address.</p>
        <p>To get the activation link again click <a href="{{url('resend/activation')}}"> Resend Activation Link</a> </p>
   </div>
    
    
</div>
</section>

@stop

