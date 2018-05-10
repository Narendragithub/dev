@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
      

        <section id="">
            <div class="container">

                <div class="">
                    <div class="min-height">

                        <div class="col-md-6 col-md-offset-3">
                            <div class="card" style="min-height:300px">
                               <div class="incorrectbox" style="display:none">
        <span style="vertical-align: middle; padding-right: 6px; font-size: 15px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>Incorrect Username!!
    </div>
    
    <form name="resendactivation" id="resendactivation" method="POST" class="form-horizontal" action="{{ url("/resend/activation") }}">
        {!! csrf_field() !!}
        
            
             <div class="card-header">
                                       <h1><span style="color:#009688;">Resend</span> Activation Link </h1>
                                    </div>
			
            @if(\Session::has('error'))
            <div class="text-danger text-center">{{ \Session::get('error') }}</div><br/>
            @endif
			 <div class="card-body card-padding">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputEmail3" name="email" value="{{ old('email') }}" placeholder="Email Id" type="text">
                                                </div>
                                            </div>
                                        </div>
										
										
           
            
            <div class="col-lg-12 text-center customformfields">

               
                    <button class="btn btn-primary" type="submit">Resend Activation Link</button>
                
                </br>

            </div></div><br><br><br>
            <div class="col-lg-12 text-center customformfields">
                <a href="{{ action("Auth\PasswordController@getEmail") }}">Forgot Password</a> | 
                <a href="{{ action("Auth\AuthController@getRegister") }}">Register</a> | 
                <a href="{{ action("Auth\AuthController@getLogin") }}">Login</a>
                @if(\Session::get('showgplus')==true)| <a href="/google">G+</a> @endif @if(\Session::get('showfb')==true)| <a href="/facebook">Facebook</a>@endif
            </div>
        </div>
    </form>
                            </div>

                        </div>

                       
                    </div>

                </div>

                <div class="card">
                    <!-- <div class="card-header">

                    </div>

                    </div>-->
            </section>
        </section>
@stop