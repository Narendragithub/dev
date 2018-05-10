@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">@if (isset($category)) Update Attribute @else Add Attribute @endif</div>
      
     <div class="maintablewhite">
	<div class="whiteboxsearch">
            @if(isset($attribute))
                <form name="attributeform" method="post" action="{{adminurl('attributes/update/'.$attribute->id)}}">
                
            @else
                <form name="attributeform" method="post" action="{{adminurl('attributes/store')}}">
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
	    <div class="staus">Name</div>
	    <div class="stausrightfrom">
		<input type="text" placeholder="Attribute Name" value="@if(isset($attribute)){{ $attribute->name}}@endif" name="attribute" class="formbox" id="last_name">
	    </div>
	</div>
	   <div class="serchmainin">
               
	
	  
          <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                    <div class="bluebtn">
                        <a  href="#" onclick="document.attributeform.submit();">@if(isset($attribute))Update @else Create @endif</a>
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
