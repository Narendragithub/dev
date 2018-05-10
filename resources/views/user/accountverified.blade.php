@extends('layouts/main')

@section('content')
<section id="main" data-layout="layout-1">
<div class="loginmain">
    <div class="alert alert-success text-center">
        @if(isset($resend))
        <p> Activation link has been sent to your email address. </p>
        @else
         <p>Your account has been successfully verified. <br>
        Click <a href="{{url('user/login')}}">here</a> to login to your account.
         </p>
        @endif

        
</div>
</div>
</section>
@stop