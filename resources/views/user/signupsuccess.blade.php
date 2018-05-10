@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
<div class="loginmain">
    <div class="alert alert-success text-center">
        Thanks for joining {{url()}}
        Your account has been successfully created. <br>
        You are just one step away to get complete access of your account.
        <br>

        <p>A verification link has been sent to your email</p>
</div>
</div>
</section>
@stop