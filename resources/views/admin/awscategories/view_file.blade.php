@extends('layouts/admin')
@section('content')
<div class="allcontent">
    
    <div class="maintitle">Aws Categories</div>
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
    
    <div class="maintablewhite">
        
        <div class="tebaltop">
            
            <span class="diplytext">
    
    
</span>
            <div class="bluebtn"><a data-toggle="modal" data-target="#addfile" href="javascript:;">+Add New File</a></div>
          
        </div>

        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div>File</div>
                    <div>Download</div>
                </div>
                @foreach($files as $file) 

                <div class="tablegridrow">
                    <div><?php $filename = $file['Key'];
    echo $filename; ?></div>  
                    <div><a href="http://s3-us-west-2.amazonaws.com/cubedots/<?php echo $filename; ?>" class="btn btn-primary">Download</a> </div>
                </div>
                @endforeach   
            </div>
         
            <div class="clearboth"></div>
        </div>

    </div>
</div>

 <!------edit ticket model-------->
            <div id="addfile" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{adminurl('awscategories/addfile_sub')}}" method="post"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-content">
                          
                            <div class="modal-body">
                                    
                                                <input type='hidden' name='id' value='{{$id}}'/>
                                                                           
                                                    <div class="staus">File Upload</div>
                                                    <div class="stausrightfrom">
                                                        <input type="file"   name="bundle" required>
                                                    </div>
                  
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">ADD</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!------edit ticket model-------->
@stop