@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">@if (isset($layout)) Update Layout @else Add Layout @endif</div>
      
     <div class="maintablewhite">
	<div class="whiteboxsearch">
            @if(isset($layout))
                <form name="layoutform" method="post" action="{{adminurl('layouts/update/'.$layout->id)}}">
                
            @else
                <form name="layoutform" method="post" action="{{adminurl('layouts/store')}}">
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
		<input type="text" placeholder="Layout Title" value="@if(isset($layout)){{ $layout->name}}@endif" name="title" class="formbox" id="title">
	    </div>
	</div>
            <div class="serchmainin">
	    <div class="staus">Attributes</div>
	    <div class="stausrightfrom">
		@foreach($attributes as $attribute)
                            <div class="col-md-6 checkbox">
                                <input @if(isset($layout) && in_array($attribute->id,$layoutattributes)) checked @endif type="checkbox" value="{{$attribute->id}}" name="attribute[]" class="" style="display:block">{{$attribute->name}}
                            </div>
                            @endforeach
	    </div>
	</div>
	   <div class="serchmainin">
              
          <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                    <div class="bluebtn">
                        <a  href="#" onclick="document.layoutform.submit();">@if(isset($layout))Update @else Create @endif</a>
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
