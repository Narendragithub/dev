@extends('layouts/admin')
@section('content')
<div class="allcontent">
      
     <div class="maintablewhite">
	<div class="tebaltop">
	  <span class="diplytext">Display  Records Through  Records</span>
	  <span class="diplytextblack">Result Per Page :</span>
	  <div class="pagewtopbtn">
	  <div class="select-main">
			<label>
			  <select>
				<option>20</option>
				<option>40</option>
			  </select>
			</label>
	  </div>
	  </div>
	   <div class="pagewtopbtn" style="margin-right: 12px;">
	  <div class="dropdown">
	    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
	
	 <div id="gride-bg">
					  <div class="tablegrid">
                                    <div class="tablegridheader">
                                            <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                                            <div>Domain</div>
                                            <div>Fullname</div>
                                            <div>Image</div>
                                            <div>Content</div>
                                            <div>Action</div>
                                          
                                    </div>
                                    @foreach($testimonials as $testimonial)
                                    <div class="tablegridrow">
                                           <div>{{$testimonial->domain}}</div>
                                           <div>{{$testimonial->fullname}}</div>
                                           <div><img src='{{url('product_images/'.$testimonial->image)}}' height='100' width='100'></div>
                                           <div>{{$testimonial->testimonial}}</div>
                                           <div>@if($testimonial->status==0) <a href="{{adminurl('approvetestimonial/'.$testimonial->id)}}" class="btn btn-success">Approve</a> @else <a href="{{adminurl('disapprovetestimonial/'.$testimonial->id)}}" class="btn btn-danger">Disapprove</a> @endif <a href="{{adminurl('deletetestimonial/'.$testimonial->id)}}" class="btn btn-warning">Delete</a></div>
                                          
                                    </div>
                                   @endforeach
                                    
                                    
                 </div>
                     <?php //echo $tickets->render(); ?>
                       <div class="clearboth"></div>
					   </div>
	
     </div>
   </div>
@stop
