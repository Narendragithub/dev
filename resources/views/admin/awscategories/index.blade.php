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

            <div style="float:left">
            Path : <a href='{{adminurl('awscategories')}}'>Root</a> 
            @foreach($breadcrumb as $key=>$value)
               >> <a href='{{adminurl('awscategories')}}?dir={{$value["href"]}}'>{{$value["text"]}}</a> 
            @endforeach
            <br/>
            <form id="aws" name="aws" action="{{adminurl('awscategories')}}">
            <select name="dir"  onchange="this.form.submit()">
            <option value=''>Select</option>
           
            @foreach($awsfiles as $key1=>$value1)
            	@if(is_array($value1))
            		
            	<option value=@if($prefix!=''){{$prefix}}/@endif{{$key1}}>{{$key1}}</option>
            		
             	@endif
            @endforeach
            </select>
            </form>
            </div>
            </span>
            <div class="bluebtn"><a class="uploade"  prop="category"  href="{{adminurl('awscategories/uploadefolder')}}/uploade">+ Create Folder</a></div>
            <div class="bluebtn"><a href="{{adminurl('awscategories/create')}}@if($prefix!='')?dir={{$prefix}}@endif">+ Add New Aws Category</a></div>
            
        </div>

        <div id="gride-bg">
            <div class="tablegrid">
                <div class="tablegridheader">
                    <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                    <div>Name</div>
                    <div>Parent</div>
                    <div>Action</div>
                </div>
                @foreach($awsfiles as $key1=>$value1)
            	@if(!is_array($value1))
                <div class="tablegridrow">
                    <!--<div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                    <div>{{$value1}} </div> 
                    <div>{{$prefix}}</div>   
                    <div>
                    <!-- @if($prefix)
                      <a class="uploade"  prop="category"  href="{{adminurl('awscategories/uploadefolder/').$prefix}}">Uploade Folder</a>    
                      /
                     @endif -->
                      <a class="delete"  prop="category"  href="{{adminurl('awscategories/delete/').$value1}}">Delete</a>  
                    </div>
                </div>
                @endif
                @endforeach   
               

            </div>
            <?php echo $categories->render(); ?>
            <!--<ul class="nice_paging">
                               <li><a href="#">< Previous</a></li>
                               <li><a href="#">1</a></li>
                               <li class="current">2</li>
                               <li><a href="#">3</a></li>
                               <li><a href="#">4</a></li>
                               <li><a href="#">5</a></li>
                               <li><a href="#">Next ></a></li>
             </ul>-->
            <div class="clearboth"></div>
        </div>

    </div>
</div>
@stop