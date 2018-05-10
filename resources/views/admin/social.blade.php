@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">@if($social)Edit   {{ucfirst($social->provider)}} Settings @else Add Social Provider @endif</div>
    
        <div class="whiteboxsearch">
            @if($social)
                <form name="addsocialform" id="addsocialform" method="post" action="{{adminurl('settings/updatesocial')}}">
                    <input type='hidden' name='social_id' value='{{$social->id}}'/>
            @else
                 <form name="addsocialform" id="addsocialform" method="post" action="{{adminurl('settings/addsocial')}}">
            @endif
            
                <input type='hidden' name='active_tabid' value='social'/>
                {{ csrf_field() }}
                <div class="serchlefts">
                    
                    <div class="serchmainin">
                        <div class="staus">Name</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Provider name" value="@if($social){{$social->provider}}@endif" name="provider" class="formbox" id="provider">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Client ID</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Client ID" value="@if($social){{$social->client_id}}@endif" name="client_id" class="formbox" id="client_id">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Client Secret</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Client Secret" value="@if($social){{$social->client_secret}}@endif" name="client_secret" class="formbox" id="client_secret">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Redirect URL</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Redirect " value="@if($social){{$social->redirect}}@endif" name="redirect" class="formbox" id="redirect">
                        </div>

                    </div>
                    
                    
                    
                   
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            @if($social)
                             <button type="submit" class="btn btn-primary">Update</button>
                            @else
                             <button type="submit" class="btn btn-primary">Add</button>
                            @endif
                           
                            <a type="button" href="{{adminurl('settings#social')}}" class="btn btn-default">Cancel</a>
                            
                        </div>

                    </div>

                </div>
            </form>
        </div>

</div>
@stop
