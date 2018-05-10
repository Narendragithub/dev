@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle"></div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">

            <form action="{{adminurl('edituser')}}" method="post" name="userform" id="userform">

                {{ csrf_field() }}
                <div class="serchlefts">
                    <div class="serchmainin">
                        <div class="staus">Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Name" value="{{$user->name}}" name="name" class="formbox">
                        </div>
                    </div>
                    <div class="serchmainin">
                        <div class="staus">Email</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="email" value="{{$user->email}}" name="email" class="formbox">
                        </div>
                    </div>
                    <input type="hidden" name="userid" value="{{$user->id}}">
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <div class="bluebtn">
                                <a  href="#" onclick="document.userform.submit()">Save</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
@stop
