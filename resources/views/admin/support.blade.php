@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">Support</div>
      <div class="searchbtn"><a href="#">Search/Filter</a></div>
      <div class="whiteboxsearch">
         <form action="{{adminurl('support/search')}}" method="post">
              {!! csrf_field() !!}
	<div class="serchlefts">
	  <div class="serchmainin">
		<div class="staus">Status</div>
		<div class="stausrightfrom">
		     <div class="select-main">
			<label>
                 <select id="status" name="status">
                <option selected="" value="">All Tickets</option> 
                <option <?php if(isset($request)){ if($request->status==0){ echo "selected='selected'";} } ?> value="0">Open</option>
		<option <?php if(isset($request)){ if($request->status==1){ echo "selected='selected'";} } ?> value="1">Customer Reply</option>
		<option <?php if(isset($request)){ if($request->status==2){ echo "selected='selected'";} } ?> value="2">Answered</option>
		<option <?php if(isset($request)){ if($request->status==3){ echo "selected='selected'";} } ?> value="3">In Progress</option>
		<option <?php if(isset($request)){ if($request->status==4){ echo "selected='selected'";} } ?> value="4">Closed</option>
			  </select>
			</label>
		     </div>
		</div>
	  </div>
	   <div class="serchmainin">
	  <div class="staus">Ticket Category</div>
	  <div class="stausrightfrom">
	       <div class="select-main">
		  <label>
                      <select id="department" name="department">
                          <option value="">Any</option>
			   @foreach($departments as $department)
                              <option <?php if(isset($request)){ if($request->department==$department->id){ echo "selected='selected'";} } ?> value="{{$department->id}}">{{$department->ticket_category_name}}</option>
				@endforeach
		    </select>
		  </label>
	       </div>
	  </div>
	</div>
	
	</div>
	<div class="serchlefts">
	  <div class="serchmainin">
		<div class="staus">Client</div>
		<div class="stausrightfrom">
		     <div class="select-main">
			<label>
                            <select id="user" name="user">
                                <option value="">Any</option>
                              @foreach($users as $user)
                              <option <?php if(isset($request)){ if($request->user==$user->id){ echo "selected='selected'";} } ?>  value="{{$user->id}}">{{$user->firstname}}</option>
			@endforeach
                             
			  </select>
			</label>
		     </div>
		</div>
	  </div>
	   <div class="serchmainin">
	  <div class="staus">Ticket ID</div>
	  <div class="stausrightfrom">
	      <input id="ticket_id" class="formbox" type="text" name="ticket_id" value="@if(isset($request)){{$request->ticket_id}}@endif" />
	  </div>
	</div>
	
	<div class="serchmainin" style="padding-bottom:0px;">
	   <div class="staus"></div>
	    <div class="stausrightfrom">
		<div align="center" class="search_button"><input type="submit" value="SEARCH"></div>
		<div class="clearboth"></div>
	    </div>
	</div>
	</div>
      </form>
     </div>
     <div class="maintablewhite">
	<div class="tebaltop">
	  <span class="diplytext">Display {{$tickets->count()}} Records Through {{$tickets->total()}} Records</span>
	  
	   
	</div>
	
	 <div id="gride-bg">
					  <div class="tablegrid">
                                    <div class="tablegridheader">
                                        <div>Ticket Id</div>
                                            <div>Category</div>
                                            <div>Subject</div>
                                            <div>Submitter</div>
                                            <div>Status</div>
                                            <div>Last Reply</div>
                                            <div>Action</div>
                                          
                                    </div>
                                    @foreach($tickets as $ticket)
                                    <?php $ticket_category=$ticket->department($ticket->department)->first();
                                     $member = $ticket->user($ticket->user_id)->first();
                                    ?>
                                    <div class="tablegridrow">
                                            <div>{{$ticket->ticket_id}}</div>
                                            <div>{{$ticket_category->ticket_category_name}}</div>
                                            <div>{{$ticket->subject}}</div>
                                            <div><b>{{$member->firstname.' '.$member->lastname}}</b></div>
                                            <div>@if($ticket->status==0)In Progress @else Closed @endif</div>
                                            <div>{{$ticket->lastresponsetime($ticket->ticket_id)}}</div>
                                            <div><a href="{{adminurl('support/view/'.$ticket->id)}}" class="btn btn-primary btn-small">View</a></div>
                                         
                                    </div>
                                    @endforeach
                                    
                                    
                 </div>
                     <?php echo $tickets->render(); ?>
                       <div class="clearboth"></div>
					   </div>
	
     </div>
   </div>
@stop
