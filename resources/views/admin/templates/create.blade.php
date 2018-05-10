@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">@if($template) Edit Template - {{$template->title}} @else Add Template @endif</div>
    
        <div class="whiteboxsearch">
            @if($template)
                <form name="emailtemplate" id="emailtemplate" method="post" action="{{adminurl('settings/updatetemplate')}}">
                    <input type='hidden' name='template_id' value='{{$template->id}}'/>
                    
            @else
                <form name="emailtemplate" id="emailtemplate" method="post" action="{{adminurl('settings/addtemplate')}}">
            @endif
           
                <input type='hidden' name='active_tabid' value='templates'/>
                {{ csrf_field() }}
                <div class="serchlefts">
                    
                    <div class="serchmainin">
                        <div class="staus">Title</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Template Title" value="@if($template){{$template->title}}@endif" name="title" class="formbox" id="title">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Subject</div>
                        <div class="stausrightfrom">
                            <input type="text" placeholder="Template Subject" value="@if($template){{$template->subject}}@endif" name="subject" class="formbox" id="subject">
                        </div>

                    </div>
                    <div class="serchmainin">
                        <div class="staus">Content</div>
                        <div class="stausrightfrom">
                            <textarea  value="" name="content" class="formbox">@if($template){{$template->content}}@endif</textarea>
                        </div>

                    </div>
                    
                    
                   
                    <div class="serchmainin">


                        <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" href="{{adminurl('settings#templates')}}" class="btn btn-default">Cancel</a>
                            
                        </div>

                    </div>

                </div>
            </form>
        </div>

</div>
@stop
