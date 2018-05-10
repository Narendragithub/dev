@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">@if (isset($category)) Update Aws Category @else Add Aws Category @endif</div>
      
     <div class="maintablewhite">
	<div class="whiteboxsearch">
            
            @if(isset($category))
            <form name="categoryform" id="categoryform" method="post" action="{{adminurl('awscategories/update/'.$category->id)}}">
                
            @else
            <form name="categoryform" id="categoryform" method="post" action="{{adminurl('awscategories/store')}}">
            @endif
           <input type='hidden' name='path' value='{{$prefix}}'/>
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
            <div class="staus">Path</div>
	  <div class="stausrightfrom">
	       <div>
		  <label>
		  {{$prefix}}
		
		  </label>
	       </div>
	  </div>
	    <div class="staus">Name</div>
	    <div class="stausrightfrom">
		<input type="text" placeholder="Category Name" value="@if(isset($category)){{ $category->category}}@endif" name="category" class="formbox" id="last_name">
	    </div>
	</div>
	   <div class="serchmainin">
               
	  
          <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                    <div class="bluebtn">
                        <a  href="#" onclick="document.categoryform.submit();">@if(isset($category))Update @else Create @endif</a>
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
