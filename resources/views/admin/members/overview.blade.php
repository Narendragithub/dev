@extends('layouts/admin')
@section('content')
<div class="allcontent">
      <div class="maintitle">Member Overview</div>
      <div class="tabsbg">
	    <div id="tab2">
	       <div role="tabpanel">
		   <ul role="tablist" class="nav nav-tabs">
		      <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home">Summary</a></li>
<!--		      <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#profile">Products</a></li>
		      <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#fancyanywear">Ticket</a></li>
		       <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#four">Downloads</a></li>
		       <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#five">Withdrawal</a></li>
		       <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#six"> Invoices</a></li>
		        <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#sevan">Send Email</a></li>
<!--			 <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile" href="#eight">Logs</a></li>-->
		    </ul>
		    
		</div>
	   </div>
      </div>
      <div class="tab-content">
	  <div id="home" class="tab-pane active" role="tabpanel">
	      <div class="acnametext">Account Details</div>
	      <!--<div class="accrightsins"><div class="editntns"><a href="#">Edit Account Details</a></div></div>-->
	      <div class="clearboth"></div>
	      <div style="height: 30px;"></div>
	      <div class="row">
		    <div style="background: #f7f8fa;" class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>Member ID</b></div>
			  <div>{{$member->id}}</div>
		    </div>
		    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>First Name</b></div>
			  <div>{{$member->firstname}} </div>
		    </div>
		    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>Last Name</b></div>
			  <div>{{$member->lastname}} </div>
		    </div>
                    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>Email</b></div>
			  <div>{{$member->email}}</div>
		    </div>
		    <div class="col-sm-4 col-md-2">
		        <div style="padding-bottom: 10px;"><b>Mobile No.</b></div>
			<div>{{$member->profile->phone}}</div>
		    </div>
		    
		</div>
	        <div class="row">
		    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>Address</b></div>
			  <div>{{$member->profile->address}}</div>
		    </div>
		    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>City</b></div>
			  <div>@if($member->profile){{$member->profile->usercity->name}}@endif</div>
		    </div>
                     <div style="background: #f7f8fa;" class="col-sm-4 col-md-2">
		        <div style="padding-bottom: 10px;"><b>State</b></div>
			<div>@if($member->profile){{$member->profile->userstate->name}}@endif</div>
		    </div>
		    <div class="col-sm-4 col-md-2">
			  <div style="padding-bottom: 10px;"><b>Country</b></div>
			  <div>@if($member->profile){{$member->profile->usercountry->name}}@endif</div>
		    </div>	    
		    <div class="col-sm-4 col-md-2">
		       <div style="padding-bottom: 10px;"><b>Zipcode</b></div>
			<div>{{$member->profile->zip}}</div>
		    </div>
		</div>
	     
	  </div>
	   <div id="profile" class="tab-pane" role="tabpanel">
	      <div class="acnametext">Products</div>
		<div class="prosubrightins">
		    <div class="prttitlsis"><b>Products Purchased :</b> 7 | <b>Total Paid :</b> $1429| <b>Total Comm. Earned :</b> 0 </div>
		    <div class="pagewtopbtn" style="margin-right: 12px;">
			<div class="dropdown open">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: #ffffff;">
			    Action
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			    <li><a href="#"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a></li>
			    <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
			  </ul>
			</div>
		    </div>
		</div>
		<div class="clearboth"></div>
		<div class="dominboxnewa">domainname.com</div>
	        <div id="gride-bg">
		  <div class="tablegrid proudcuttables">
		      <div class="tablegridheader">
			      <div>Products</div>
			      <div>Price</div>
			      <div>Paid Amount</div>
			      <div>Purchase Date</div>
			      <div>Processor</div>
			     
			    
		      </div>
                      @if($orderdetails)
		      @foreach($orderdetails as $item)
		      <div class="tablegridrow">
			      <div>
				{{$item['productname']}} <span style="font-size: 10px;">License Key : ad12514ghg</span>
			      </div>
			      <div>{{$item['product_price']}}</div>
			      <div>{{$item['paid_amount']}}</div>
			      <div>{{$item['created_at']}}</div>
			      <div>@if($item['payment_mode']==1)Paypal @endif</div>
		      </div>
		      @endforeach
                      @else <div class="tablegridrow"><h2>No orders yet.</h2></div>
                      @endif
		  </div>
                </div>
	   </div>
		  <div id="fancyanywear" class="tab-pane" role="tabpanel">
		      <div class="totaltickets">Total Tickets : @if($tickets && count($tickets) > 0) {{$tickets->count()}} @endif </div>
	       <div class="creright"><a href="#">[ Create New Ticket ]</a></div>
	       <div class="clearboth"></div>
		<div class="tablegrid">
				    <div class="tablegridheader">
					   <div style="text-align: left; padding-left: 8px;">{{$member->firstname."'s"}} tickets</div>
					    <div></div>
					    <div></div>
					    <div></div>
				    </div>
                                    @if($tickets)
                                    @foreach($tickets as $ticket)
				    <div class="tablegridrow">
					    <div style="text-align: left; padding-left: 8px;">Ticket ID #0000</div>
                                            <div>{{$ticket->subject}} #<a href='{{adminurl('support/view/'.$ticket->id)}}'>{{$ticket->ticket_id}}</a></div>
					    <div>Domainname.com</div>
					    <div>{{$ticket->created_at}}</div>
				    </div>
				    @endforeach
                                    @else <div class="tablegridrow">No tickets raised.</div>
                                    @endif
				     
		 </div> 
		</div>
	    <div id="four" class="tab-pane" role="tabpanel">
	       <div class="acnametext">Downloads </div>
	       <div class="dwlefts"><b>Total Downloads :</b> Main Product (3)  Modules (2) </div>
	       <div class="dswrights">
		  <b>Total Downloads :</b> 3
	       </div>
	       <div class="clearboth"></div>
	        <div id="gride-bg">
		  <div class="tablegrid">
		    <div class="tablegridheader">
			    <div>Products Name</div>
			    <div>Domain</div>
			    <div>IP Address</div>
			    <div>Date</div>
			    
			  
		    </div>
		    
		    <div class="tablegridrow">
			  
			    <div>Main Product</div>
			    <div>Domainname.com</div>
			    <div>000.000.00.00</div>
			    <div>09-05-2015</div>
			   
			 
		    </div>
		    <div class="tablegridrow">
			    <div>Modules</div>
			    <div>Domainname.com</div>
			    <div>000.000.00.00</div>
			    <div>09-05-2015</div>
			   
		   </div>
		      <div class="tablegridrow">
			    <div>Modules</div>
			    <div>Domainname.com</div>
			    <div>000.000.00.00</div>
			    <div>09-05-2015</div>
			   
		   </div>
		    
		    
	           </div>
               </div>
	    </div>
	    <div id="five" class="tab-pane" role="tabpanel">
		<div class="dwlefts">Withdrawal</div>
		 <div class="dswrights">
		    <b>Total Requests :</b>  0
		 </div>
		 <div class="clearboth"></div>
		   <div id="gride-bg">
		  <div class="tablegrid">
		    <div class="tablegridheader">
			    <div>Sr. no.</div>
			    <div>User Id</div>
			    <div>Processor</div>
			    <div>Amount</div>
			    <div>Date</div>
			    <div>Status</div>
			  
		    </div>
		    
		    <div class="tablegridrow">
			  
			    <div>1</div>
			    <div>0000000</div>
			    <div>PayPal</div>
			    <div>$000.00</div>
			    <div>07/07/2016</div>
			    <div>Paid</div>
		    </div>
		    <div class="tablegridrow">
			    <div>2</div>
			    <div>0000000</div>
			    <div>PayPal</div>
			    <div>$000.00</div>
			    <div>07/07/2016</div>
			    <div>Waiting</div>
			   
		   </div>
		      <div class="tablegridrow">
			    <div>3</div>
			    <div>0000000</div>
			    <div>PayPal</div>
			    <div>$000.00</div>
			    <div>07/07/2016</div>
			    <div>Cancel</div>
		   </div>
		    
		    
	           </div>
               </div>
	    </div>
	    <div id="six" class="tab-pane" role="tabpanel">
	      <div class="acnametext">Invoices</div>
	      <div id="gride-bg">
		  <div class="tablegrid">
		    <div class="tablegridheader">
			    <div>Invoice Name</div>
			    <div>Invoice Date</div>
			    <div>Due Date</div>
			    <div>Date Paid</div>
			    <div>Total Amount</div>
			    <div>Payment Method</div>
			    <div>Status</div>
			    <div></div>
			    
			  
		    </div>
		    @foreach($invoicedetails as $invoice)
		    <div class="tablegridrow">
			  
			    <div>{{$invoice['invoice_number']}}</div>
			    <div>{{$invoice['invoice_date']}}</div>
			    <div>{{$invoice['invoice_date']}}</div>
			    <div>{{$invoice['invoice_date']}}</div>
			    <div>${{$invoice['total_amount']}}</div>
			    <div>@if($invoice['payment_mode']==1) Paypal @endif</div>
			     <div>@if($invoice['status']==0) Pending @else Completed @endif</div>
			    <div>
			      <i style="font-size: 16px;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
			      <i style="font-size: 16px; color: #dd5e5e;" aria-hidden="true" class="fa fa-times-circle-o"></i>
			    </div>
		    </div>
		    @endforeach
	           </div>
               </div>
	    </div>
	    <div id="sevan" class="tab-pane" role="tabpanel">
	        <div style="text-align: center;">
		  <div class="emailboxmainsbox">
		      <div class="acnametext">Send Email</div>
		      <div><input type="text" id="last_name" class="formbox" name="last_name" value="" placeholder="Subject :"></div>
		      <div class="sendemail"><textarea></textarea></div>
		      <div align="center" class="search_button"><input type="submit" value="SUBMIT" style="background: #3ab2cc; color: #ffffff; float: none; margin-top: 5px;"></div>
		  </div>
		</div>
	    </div>
	    <div id="eight" class="tab-pane" role="tabpanel">
	        <div class="acnametext">Logs</div>
	      <div id="gride-bg">
		  <div class="tablegrid">
		    <div class="tablegridheader">
			    <div>Date</div>
			    <div>Description</div>
			    
			    <div>IP Addres</div>
			   
			    
			  
		    </div>
		    @foreach($logs as $log)
		    <div class="tablegridrow">
			  
			    <div>{{$log->created_at}}</div>
			    <div>{{$log->text}}</div>
			    
			    <div>{{$log->ip_address}}</div>
			    
		    </div>
                    @endforeach
		    
		    
		    
	           </div>
               </div>
	    </div>
      </div>
   </div>
@stop