@extends('layouts/admin')
@section('content')
<div class="allcontent">
    <div class="maintitle">Advert</div>
    @if(Session::has('message'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-success text-center">
            {{Session::get('message')}}
        </div>
    </div>
    @endif

    @if(Session::has('error'))
    <div class="container">
        <div class="col-md-8 col-md-offset-2 alert alert-danger text-center">
            {{Session::get('error')}}
        </div>
    </div>
    @endif 
<div id="paneldiv" class="row maintablewhite">
     @foreach($images as $image)
    	<?php $imgpath=url("advert_images/".$image->image);?>    
    <div class="col-md-2 swipe" id="{{$image->id}}" style="padding-top:15px;">
        <div class="fileinput fileinput-new">
            <div class="fileinput-preview thumbnail">
                <img src="<?php echo $imgpath?>" style="height: 136px;width: 230px;">
            </div>
            <div>
                <a href="javascript:void(0)" class="btn btn-danger" onClick="removeAdvertImage({{$image->id}});">Remove</a>
            </div>
        </div>
    </div>
   @endforeach  
    <div id="uploader" class="col-sm-2" style="padding-top:15px;">
        <!-- drag drop start -->        
              <div  class="drag-and-drop-zone uploader">
                <div>Drag &amp; Drop Images Here</div>
                <div class="or">-or-</div>
                <div class="browser">
                  <label>
                    <span>Select Image</span>
                    <input type="file" name="image" id="image"  accept="image/jpeg"  title='Click to add Images'>
                  </label>
                </div>
              </div>
              <div style="display: none;" class="progressbar">   
              </div>
        <!-- drag drop end -->
    </div>
    </div>

</div>
@stop