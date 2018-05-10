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
                             @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ Session::get('message') }}
                            </div>
                            @endif
                        <div class="col-md-6">
                            <div class="card">
                               <form name="userlogin" id="userlogin" class="form-horizontal" method="POST"  action="{{ action("Auth\AuthController@getLogin") }}">
									{!! csrf_field() !!}
                                    <div class="card-header">
                                        <h1><span style="color:#009688;">Login</span> Here </h1>
                                    </div><br>
									 @foreach ($errors->all() as $error)
										<span class="text-danger">{{ $error }}</span><br/>
									@endforeach
									<br>
                                    <div class="card-body card-padding">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputEmail3" name="email" value="{{ old('email') }}" placeholder="Email Id" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-10">

                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputPassword3" name="password" placeholder="Password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect">Login</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-12 text-center">
                                    <div class="new-user">
                                        <div>
                                            <a href="{{url('user/register')}}">Create account</a> or <a href="{{url('password/email')}}">Reset password</a>
                                        </div>
                                        <div> @if(\Session::get('showgplus')==true) <!-- |<a href="/google">G+</a> --> @endif @if(\Session::get('showfb')==true)| <a href="/facebook">Facebook</a>@endif</div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card">

                                <div class="card-header">
                                    <h2>Login To your Account</h2>
                                </div>

                                <div class="card-body card-padding">

                                    <ul class="login-list">
                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc feugiat sagittis eros, sed sollicitudin tortor rutrum at.</li>
                                        <li>Fusce iaculis arcu vel semper blandit. Etiam vitae nisl malesuada, volutpat magna et, efficitur turpis. Donec lacus ante, vehicula non dignissim at, venenatis a risus.</li>
                                        <li>Aliquam diam ex, mollis ac venenatis eget, elementum ut ipsum. Integer ac augue a mauris iaculis convallis non eu odio.</li>
                                        <li> Nullam pretium ipsum urna, at ullamcorper orci scelerisque in. Vestibulum eget tortor cursus enim dignissim pretium nec eu metus.</li>
                                        <li>Aenean euismod, lorem vitae ultricies finibus, dolor metus condimentum magna, sit amet fermentum odio dolor id justo. Donec a placerat velit.</li>

                                    </ul>

                                </div>
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