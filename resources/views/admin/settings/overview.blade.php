@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Settings</div>
    @if(Session::has('message'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-success text-center">
            {{Session::get('message')}}
        </div>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-danger text-center">
            {{Session::get('error')}}
        </div>
    </div>
    @endif 
    
    <div class="tabsbg">
        <div id="tab2">
            <div role="tabpanel">
                <ul role="tablist" class="nav nav-tabs" id="settingtabs">
                  
                    <li class="active" role="presentation"  @if(\Session::has('active_tabid') && \Session::get('active_tabid')=='adminuser') class='active' @endif>
                        <a data-toggle="tab" role="tab" aria-controls="adminuser" href="#adminuser">
                            Admin Users
                        </a>
                    </li>
                     <li role="presentation" @if(\Session::has('active_tabid') && \Session::get('active_tabid')=='email') class='active' @endif>
                        <a data-toggle="tab" role="tab" aria-controls="settings" href="#settings">
                            Settings
                        </a>
                    </li>
                
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="adminuser" class="active tab-pane @if(\Session::has('active_tabid') && \Session::get('active_tabid')=='adminuser') active @endif" role="tabpanel">
            <div class="totaltickets">Admin users</div>
            <div class="creright"><a href="{{adminurl('user')}}">[ Create New User ]</a></div>
            <div class="clearboth"></div>
            <div class="tablegrid">
                <div class="tablegridrow">
                    <div style="text-align: left; padding-left: 8px;">Name</div>
                    <div>Email</div>
                    <div>Department</div>
                    <div>Is Verified</div>
                    <div>Created at</div>
                    <div>Action</div>
                </div>
                @foreach($adminusers as $user)
                <div class="tablegridrow">
                    <div style="text-align: left; padding-left: 8px;">{{$user->name}}</div>
                    <div>{{$user->email}}</div>
                    <div>@if($user->department) {{ $user->department->department_name }} @else &nbsp; @endif</div> 
                    <div>@if($user->verified==0) No @else Yes @endif</div>
                    <div>{{$user->created_at}}</div>
                    <div>
                        <a class="btn btn-primary" href="{{adminurl('edit/'.$user->id)}}">Edit</a> 
                        @if($user->id !=\Auth::user('admin')->id)<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');" href="{{adminurl('deleteuser/'.$user->id)}}">Delete</a> @endif</div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="settings" class="tab-pane @if(\Session::has('active_tabid') && \Session::get('active_tabid')=='email') active @endif" role="tabpanel">
            <form name="email_settings" id="email_settings"  method="post" action="{{adminurl('settings/updateemail')}}" enctype="multipart/form-data">
                <input type='hidden' name='active_tabid' value='email'/>
                {{ csrf_field() }}
                <div class="acnametext">General Settings</div>
                <div class="prosubrightins">
                </div>
                <div class="clearboth"></div>
                <div class="whiteboxsearch">
                    <div class="serchlefts">
                        <div class="serchmainin">
                            <div class="staus">Website Title :</div>
                            <div class="stausrightfrom"  style="text-align: left;">
                                <input id="site_title" class="formbox" type="text" name="site_title" value="{{$settings->site_title}}" placeholder="Site Title"/>
                            </div>
                        </div>
                        <div class="serchmainin">
                            <div class="staus">Admin Email : </div>
                            <div class="stausrightfrom">
                                <input id="admin_email" class="formbox" type="text" name="admin_email" value="{{$settings->admin_email}}" placeholder="Admin Email"/>
                            </div>
                        </div>
                        <div class="serchmainin">
                            <div class="staus ">Message<br> From Name : </div>
                            <div class="stausrightfrom">
                                <input id="from_name" class="formbox" type="text" name="from_name" value="{{$settings->from_name}}" placeholder="Message From Name"/>
                            </div>
                        </div>
                        <div class="serchmainin">
                            <div class="staus">Message<br> From Email : </div>
                            <div class="stausrightfrom">
                                <input id="from_email" class="formbox" type="text" name="from_email" value="{{$settings->from_email}}" placeholder="Message From Email"/>
                            </div>
                        </div>
                        
                         
                       <div class="serchmainin">
                            <div class="staus">Enable Email OTP : </div>
                            <div class="stausrightfrom"  style="text-align: left;">
                                <input type="radio" name="emailotp" value="1" @if($settings->emailotp==1) checked @endif/>Yes
                                <input type="radio" name="emailotp" value="0" @if($settings->emailotp==0) checked @endif/>No
                            </div>
                        </div>
                      
                    </div>
                    <div class="serchlefts">
                        <div class="serchmainin">
                            <div class="fileinput fileinput-new">
                        <div class="fileinput-preview thumbnail">
                            <img height="200" width="200" src="{{url('images/'.$settings->logo)}}">
                        </div>
                                                                                                                      
                    </div>
                            <div class="staus">Site Logo : </div>
                            <div class="stausrightfrom">
                                <input id="logo" class="formbox" type="file" name="logo" />
                            </div>
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
       
        
    </div>
</div>
@stop
