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
                    <div class="min-height">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1> <span style="color:#009688;">Create</span> An Account</h1>
                                </div>

                                <div class="card-body card-padding">
                                    <p>
                                       By clicking Create Account, you agree to our Terms and confirm that you have read our Data Policy, including our Cookie Use Policy. You may receive SMS message notifications from Facebook and can opt out at any time.

                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="card">
                                <div class="card-header">
                                    <h2>Please Fill Detail Below </h2>
                                </div>
                                <div class="card-body card-padding reg-form">
								<form name="usersignup" id="usersignup" method="POST"  action="{{ action("Auth\AuthController@postRegister") }}">
									{!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                <div class="fg-line">
                                                    <select class="form-control" name="title">
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Ms">Ms.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="firstname" id="firstname" placeholder="First Name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="lastname" id="lastname"  placeholder="Last Name" type="text">
                                                </div>
                                            </div>
                                        </div>
										<br>
										<div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi zmdi-email"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="email" id="email"  placeholder="E-mail" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="mobile" id="mobile" placeholder="Contact Number" type="text">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city zmdi-hc-fw"></i></span>
                                                <div class="fg-line">
                                                    <select class="form-control" onchange="getStates(this.value)" name="country">
														@foreach($countries as $country)
                                                                                                                <option <?php if($country->id==101){?> selected=""<?php } ?> value="{{$country->id}}">{{$country->name}}</option>
														@endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city zmdi-hc-fw"></i></span>
                                                <div class="fg-line" id="statehtml">
                                                        <select class="form-control" id="state" onchange="getcities(this.value)" name="state">
									 <option selected="" value="">Select State</option>
														@foreach($states as $state)
                                                                                                                <option value="{{$state->id}}">{{$state->name}}</option>
														@endforeach
												   </select>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city zmdi-hc-fw"></i></span>
                                                <div class="fg-line" id="cityhtml">
                                                    <select class="form-control" id="city" name="city">
														<option selected="" value="">Select City</option>
					           </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-key zmdi-hc-fw"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="password" id="password"   placeholder="Password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-key zmdi-hc-fw"></i></span>
                                                <div class="fg-line">
                                                    <input class="form-control" name="password_confirmation" id="password_confirmation"   placeholder="Confirm Password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="col-md-6">
                                            <div class="input-group" style="padding-left: 25px;">
                                                
                                                <div class="fg-line">
                                                    <input type="radio" checked> Terms And Condition
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="text-center" style="margin-top:50px;">
                                                
                                                <br>
                                                <button class="btn btn-primary waves-effect">Sign Up</button>
                                                <div class="col-md-12 text-center">
                                                    <br />
                                                    <br />
                                                    <p>
                                                        <span><a href="{{url('user/login')}}"> Already have an account ? click here to Login!</a></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
									</form>
                                     <div class="col-md-12 text-center">
                                    <div class="new-user">
                                       
                                        <div> @if(\Session::get('showgplus')==true) <a href="/google">G+</a> @endif @if(\Session::get('showfb')==true)| <a href="/facebook">Facebook</a>@endif</div>
                                    </div>

                                </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                
            </div>
        </section>
    </section>
@stop