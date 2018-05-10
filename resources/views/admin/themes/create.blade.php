@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">@if (isset($theme)) Update Category @else Add Theme @endif</div>

    <div class="maintablewhite">
        <div class="whiteboxsearch">
            @if(isset($theme))
            <form name="themeform" method="post" action="{{adminurl('themes/update/'.$theme->id)}}" enctype="multipart/form-data">

                @else
                <form name="themeform" method="post" action="{{adminurl('themes/store')}}" enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}
                    <div class="serchlefts">
                        
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <div class="serchmainin">
                            <div class="staus">Attribute</div>
                            <div class="stausrightfrom">
                                <div class="select-main">
                                    <label>
                                        <select name="attribute_id">
                                            <option value="">Select Attribute</option>
                                            @foreach($attributes as $attribute)
                                            <option <?php
                                            if (isset($theme)) {
                                                if ($theme->attribute_id == $attribute->id) {
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            ?> value="{{$attribute->id}}">{{$attribute->name}}</option>

                                            @endforeach   
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                         <div class="serchmainin">
                            <div class="staus">Name</div>
                            <div class="stausrightfrom">
                                <input type="text" placeholder="Theme Name" value="@if(isset($theme)){{ $theme->name}}@endif" name="theme" class="formbox" id="last_name">
                            </div>
                        </div>
                        <div class="serchmainin">
                            <div class="staus">Images</div>
                            <div class="stausrightfrom">
                                <input type="file" name="image" class="formbox" >
                            </div>
                        </div>
                        <div class="serchmainin">

                            
                            <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                                <div class="bluebtn">
                                    <a  href="#" onclick="document.themeform.submit();">@if(isset($theme))Update @else Create @endif</a>
                                </div>
                                <div class="bluebtn">
                                    <a  href="#" onclick="history.go(-1);">Cancel</a>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
        </div>

    </div>
</div>
@stop
