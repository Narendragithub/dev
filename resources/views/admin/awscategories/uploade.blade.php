@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">Add Folder on Aws</div>
     <div class="maintablewhite">
	<div class="whiteboxsearch">
            <form name="uploadeform" id="uploadeform" method="post" action="{{adminurl('awscategories/uploadestore')}}">
               
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
            <div class="staus">Folder Name</div>
               <div class="stausrightfrom"><div>
    		      <input type='text' name='foldername' class="formbox" placeholder="Folder Name" value=''/>
    	       </div>
    	    </div>
    	    <div class="staus">Folder Path</div>
        	    <div class="stausrightfrom">
        		<input type="text" placeholder="Uploade Folder Path" value="" name="folderpath" class="formbox" id="folderpath">
        	    </div>
    	   </div>

    	   <div class="serchmainin">
              <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                <div class="bluebtn">
                    <a  href="#" onclick="document.uploadeform.submit();">Uploade</a>
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
