@extends('layouts/admin')
@section('content')

<div class="allcontent">
    <div class="maintitle">Settings</div>
    <div class="searchbtn"><a href="#">Social Settings</a></div>
    <form name="settingsform" method="post" action="{{adminurl('settings/update')}}">
        {{ csrf_field() }}
    <div class="whiteboxsearch">
        <div class="serchlefts">
            <div class="serchmainin">
                <div class="staus">Google Client ID</div>
                <div class="stausrightfrom">
                    <input id="google_client_id" class="formbox" type="text" name="google_client_id" value="{{$settings->google_client_id}}" placeholder="All Ticket"/>
                </div>
            </div>
            <div class="serchmainin">
                <div class="staus">Google Callback</div>
                <div class="stausrightfrom">
                    <input id="google_redirect" class="formbox" type="text" name="google_redirect" value="{{$settings->google_redirect}}" placeholder="All Ticket"/>
                </div>
            </div>
            <div class="serchmainin">
                <div class="staus">Facebook Client ID</div>
                <div class="stausrightfrom">
                    <input id="fb_client_id" class="formbox" type="text" name="fb_client_id" value="{{$settings->fb_client_id}}" placeholder="All Ticket"/>
                </div>
            </div>
            <div class="serchmainin">
                <div class="staus">Facbeook Callback</div>
                <div class="stausrightfrom">
                    <input id="fb_redirect" class="formbox" type="text" name="fb_redirect" value="{{$settings->fb_redirect}}" placeholder="All Ticket"/>
                </div>
            </div>
            
            
        </div>
        
            
       
        <div class="serchlefts">
            <div class="serchmainin">
                <div class="staus">Google Client Secret </div>
                <div class="stausrightfrom">
                    <input id="google_client_secret" class="formbox" type="text" name="google_client_secret" value="{{$settings->google_client_secret}}" placeholder="All Ticket"/>
                </div>
            </div>
             <div class="serchmainin" style="height:40px;">
                 &nbsp;
             </div>
            <div class="serchmainin">
                <div class="staus">Facebook Client Secret </div>
                <div class="stausrightfrom">
                    <input id="fb_client_secret" class="formbox" type="text" name="fb_client_secret" value="{{$settings->fb_client_secret}}" placeholder="All Ticket"/>
                </div>
            </div>
        </div>
        <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <div class="bluebtn">
                                <a  href="#" onclick="document.settingsform.submit();">Update</a>
                            </div>
                        </div>

                    </div>
    </div>  
        
        </form>
</div>
@stop