@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
        

        <section id="content">
            <div class="container">

                

                <div class="row">
                    <div class="">

                        <div class="col-md-6 col-md-offset-3">
                            <div class="card">
                                @include('layouts/msgtemplate')
                                <form method="POST" class="form-horizontal" action="{{ action('Auth\PasswordController@postReset') }}">
    {!! csrf_field() !!}
     <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="card-header text-center">
                                        <h1><span style="color:#009688;">Reset</span> Password</h1>
                                        <small>In the field below, enter your email id </small>
                                    </div>

                                    <div class="card-body card-padding">

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Email Id</label>
                                            <div class="col-sm-7">

                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputPassword3" placeholder="Enter Email Id" type="text" name="email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-7">

                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputPassword3" placeholder="Enter Password" type="password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>
                                            <div class="col-sm-7">

                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputPassword3" placeholder="Confirm Password" type="password" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-5 col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect">Reset</button>
                                                <!--  <span><a href="#">Forgot Password Click Here!</a></span>-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">
                    
                </div>

            </div>
        </section>
    </section>
@stop