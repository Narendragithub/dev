@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">@if (isset($ticket_category)) Update Ticket Category @else Add Ticket Category @endif</div>
      
     <div class="maintablewhite">
	<div class="whiteboxsearch">
            @if(isset($ticket_category))
                <form name="ticket_categoryform" method="post" action="{{adminurl('ticket_category/update/'.$ticket_category->id)}}">
                
            @else
                <form name="ticket_categoryform" method="post" action="{{adminurl('ticket_category/store')}}">
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
		<input type="text" placeholder="Ticket Category Name" value="@if(isset($ticket_category)){{ $ticket_category->ticket_category_name}}@endif" name="ticket_category" class="formbox" id="last_name">
	    </div>
	</div>
	   <div class="serchmainin">
              
          <div style="text-align: right; padding-top: 14px; margin-right: 60px;">
                    <div class="bluebtn">
                        <a  href="#" onclick="document.ticket_categoryform.submit();">@if(isset($ticket_category))Update @else Create @endif</a>
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
