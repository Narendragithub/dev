@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
        <aside id="sidebar" class="sidebar c-overflow hidden-md hidden-sm hidden-lg">

            <ul class="main-menu">
                <li class="active ent">
                    <a href="index-2.html"><i class="zmdi zmdi-home"></i> Entertainment</a>
                </li>
                <li class="">

                    <span class="span1 green_p"> <img src="img/index.png" /></span>
                    <a href="#"> Apartments</a>
                </li>
                <li class="">

                    <span class="span1 red_p"><img src="img/index02.png" /></span>
                    <a href="#"> Duplex</a>
                </li>
               
            </ul>

            <ul class="bottom-menu main-menu">

                <li> Account</li>
                <li> Redeem</li>
                <li> Buy Gift Cart</li>
                <li> My wishlist</li>
                <li> My play activity</li>
                <li> Parent Guide</li>

            </ul>

        </aside>

        <section id="content">
            <div class="container">

                

                <div class="row">
                    <div class="">

                        <div class="col-md-6 col-md-offset-3">
                            <div class="card">
                                 @include('layouts/msgtemplate')
                                 <form method="POST" class="form-horizontal" id="forgotpassword" name="forgotpassword" action="{{ action("Auth\PasswordController@getEmail") }}">
                                    {!! csrf_field() !!}
                                    <div class="card-header text-center">
                                        <h1><span style="color:#009688;">Password</span> Recovery </h1>
                                        <small>In the field below, enter your email id </small>
                                    </div>

                                    <div class="card-body card-padding">

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Email Id</label>
                                            <div class="col-sm-7">

                                                <div class="fg-line">
                                                    <input value="{{old('email')}}" class="form-control input-sm" name="email" id="inputPassword3" placeholder="Enter Email Id" type="text">
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