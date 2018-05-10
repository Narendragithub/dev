@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">@if($user) Edit User @else Add New User @endif</div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">
            @if(Session::has('error'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-danger text-center">
            {{Session::get('error')}}
        </div>
    </div>
    @endif 
             @if($user)
             <form action="{{adminurl('edituser')}}" method="post" name="edituserform" id="edituserform">
                  <input type='hidden' name='userid' value='{{$user->id}}'/>
             @else
             <form action="{{adminurl('adduser')}}" method="post" name="addadminuser" id="addadminuser">
             @endif
            
                
                {{ csrf_field() }}
                <div class="serchlefts">
                    <div class="serchmainin">
                        <div class="staus">Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Name" value="@if($user){{$user->name}}@endif" name="name" class="formbox">
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Email</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Email" value="@if($user){{$user->email}}@endif" name="email" class="formbox">
                        </div>
                    </div>
                    @if(!$user)
                    <div class="serchmainin">
                        <div class="staus">Password</div>
                        <div class="stausrightfrom">
                            <input type="password" placeholder="Password" value="" name="password" id="password" class="formbox">
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Confirm Password</div>
                        <div class="stausrightfrom">
                            <input type="password" placeholder="Confirm Password" value="" id="confirm_password" name="confirm_password" class="formbox">
                        </div>
                    </div>
                    @endif
                    <div class="serchmainin">
                            <div class="staus">Department</div>
                            <div class="stausrightfrom">
                                <div class="select-main">
                                    <label>
                                        <select name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                            <option <?php
                                            if (isset($user)) {
                                                if ($user->department_id == $department->id) {
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            ?> value="{{$department->id}}">{{$department->department_name}}</option>

                                            @endforeach   
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="serchmainin" style="display: none;">
                        <div class="staus" style="vertical-align: middle">Select Modules</div>
                        <div class="stausrightfrom">
                           @foreach($modules as $module)
                            <div class="col-md-6 checkbox">
                                <input type="checkbox" checked @if($user && $usermodules && in_array($module->id,$usermodules)) checked @endif value="{{$module->id}}" name="modules[]" class="" style="display:block">{{$module->name}}
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            @if($user)
                            <button type="submit" class="btn btn-primary">Update</button>
                            
                            @else
                            <button type="submit" class="btn btn-primary">Add</button>
                           
                            @endif
                            <a type="button" href="{{adminurl('settings#adminuser')}}" class="btn btn-default">Cancel</a>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
@stop
