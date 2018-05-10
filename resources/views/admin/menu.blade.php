<style>
    .modal-body p {
        overflow: hidden;
        width: 100%;
    }
.badge-notify{
   background:red;
   position:relative;
  
  }
  .tablegridrow.read {
    background-color: #E3F5D7;
}
  
.tablegrid .tablegridrow.read:nth-child(2n) {
    background-color: #E3F5D7;
}


</style>

<div class="headerbg">
    <div class="header" style="background:#000;">
        <div class="logo"><img src="{{ asset('images/logo.jpg')}}"/></div>
        <div class="navbar-header navbar-default">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="mobilehider">
            <div class="topright" style="padding-top:5px;">
                <div class="staboxmamin">
                    <div class="orangebox">
                        <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-desktop" aria-hidden="true"></i></div>
                    </div>
                    <div class="orangright">
                        <b>Last Login IP </b><br/>
                        {{Auth::user('admin')->last_login_ip}}
                    </div>
                </div>
                <div class="staboxmamin">
                    <div class="orangebox" style="background: #ffce55;">
                        <div class="orangeicon"><i  style="font-size: 40px; color: #ffffff;" class="fa fa-clock-o" aria-hidden="true"></i></div>
                    </div>
                    <div class="orangright">
                        <b>Last Login Time </b><br/>
                        {{ date('F j, Y H:i:s',strtotime(Auth::user('admin')->last_login))}}

                    </div>
                </div>
                <div class="staboxmamin">
                    <div class="orangebox" style="background: #2dc3e8;">
                        <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-server" aria-hidden="true"></i></div>
                    </div>
                    <div class="orangright">
                        <b>Current Server Time</b><br/>
                        {{ date('F j, Y H:i:s',time())}}
                    </div>
                </div>
                <div class="staboxmamin">
                    <div class="adminrightname">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border: none;">
                                <img src="{{ asset('images/welcomeadmin.jpg')}}"/> Welcome, {{ \Auth::user('admin')->name}}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a style="color: #e45b62;cursor:pointer" data-toggle="modal" data-target="#changePassword">
                                        <i class="fa fa-lock" aria-hidden="true"></i> Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="{{action('Auth\AdminController@getLogout')}}" style="color: #e45b62;">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearboth"></div>
    </div>
</div>
<div class="menubg">
    <div id="menu">

        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php if (\Auth::user('admin')->is_main == 1) { ?>  
                            <li @if($active == 'overview') class="active" @endif><a href="{{adminurl('home')}}">Dashboard</a></li>
                            <li @if($active == 'categories') class="active" @endif><a href="{{adminurl('categories')}}">Categories</a></li>
                            <li @if($active == 'awscategories') class="active" @endif><a href="{{adminurl('awscategories')}}">Aws Categories</a></li>
                            <li @if($active == 'departments') class="active" @endif><a href="{{adminurl('departments')}}">Departments</a></li>
                            <li @if($active == 'ticket_category') class="active" @endif><a href="{{adminurl('ticket_category')}}">Ticket Category</a></li>
                            <li @if($active == 'layouts') class="active" @endif><a href="{{adminurl('layouts')}}">Layouts</a></li>
                            <li @if($active == 'attributes') class="active" @endif><a href="{{adminurl('attributes')}}">Attributes </a></li>
                            <li @if($active == 'themes') class="active" @endif><a href="{{adminurl('themes')}}">Themes </a></li>	<?php } ?>
                            <li @if($active == 'projects') class="active" @endif><a href="{{adminurl('projects')}}">Projects <span class="badge badge-notify">{{newproject()}}</span> </a></li>
                            <li @if($active == 'support') class="active" @endif><a href="{{adminurl('support')}}">Support <span class="badge badge-notify">{{newtickets()}}</span></a></li>
                            <?php if (\Auth::user('admin')->is_main == 1) { ?>  
                                <!-- <li @if($active == 'projects') class="active" @endif><a href="{{adminurl('projects')}}">Projects </a></li>
                                <li @if($active == 'products') class="active" @endif><a href="{{adminurl('products')}}">Product </a></li>-->
                                <!--<li @if($active == 'affiliates') class="active" @endif><a href="{{adminurl('affiliate')}}">Affiliate</a></li>-->
                                <!--<li @if($active == 'orders') class="active" @endif><a href="{{adminurl('orders')}}">Order</a></li>
                                <li @if($active == 'invoices') class="active" @endif><a href="{{adminurl('invoices')}}">Invoice</a></li>-->
                                <li @if($active == 'members') class="active" @endif><a href="{{adminurl('members')}}">Customers</a></li>
                                <li @if($active == 'advert') class="active" @endif><a href="{{adminurl('advert')}}">Advert</a></li>                       				       
                                <li @if($active == 'settings') class="active" @endif><a href="{{adminurl('settings')}}">Settings</a></li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Menu Code Over -->
    </div>




    <div class="clearboth"></div>

</div>


<div class="mobilehider2">
    <div class="topright">
        <div class="staboxmamin">
            <div class="orangebox">
                <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-desktop" aria-hidden="true"></i></div>
            </div>
            <div class="orangright">
                <b>Last Login IP </b><br/>
                123.237.230.201
            </div>
        </div>
        <div class="staboxmamin">
            <div class="orangebox" style="background: #ffce55;">
                <div class="orangeicon"><i  style="font-size: 40px; color: #ffffff;" class="fa fa-clock-o" aria-hidden="true"></i></div>
            </div>
            <div class="orangright">
                <b>Last Login Time </b><br/>
                May 21, 2015 15:49:45
            </div>
        </div>
        <div class="staboxmamin">
            <div class="orangebox" style="background: #2dc3e8;">
                <div class="orangeicon"><i style="font-size: 40px; color: #ffffff;" class="fa fa-server" aria-hidden="true"></i></div>
            </div>
            <div class="orangright">
                <b>Current Server Time</b><br/>
                May 21, 2015 17:42:52
            </div>
        </div>
    </div>
</div>
<div id="changePassword" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change password</h4>
                <div id="err_msg"></div>
                <div id="success_msg"></div>
            </div>
            <form name="changepassword" id="changepassword" method="post">
                <input type="hidden" name="adminid" value="{{\Auth::user('admin')->id}}">
                <div class="modal-body" style="padding-right:10px;">
                    <p><input type="password" placeholder="Current password" name="currentpassword" id="currentpassword" class="changepasswordbtn form-control" style="width:90%"><br></p>
                    <p><input type="password" placeholder="New password" name="newpassword" id="newpassword" class="changepasswordbtn form-control" style="width:90%"><br></p>
                    <p><input type="password" placeholder="Confirm new password" name="confirmnewpassword" id="confirmnewpassword" class="changepasswordbtn form-control" style="width:90%"><br></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Change</button> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
