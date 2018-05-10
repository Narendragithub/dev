@extends('layouts/main')
@section('content')
<?php
$email = '';
$phone = '';
if ($profile) {
    $email = $user->email;
    $phone = $profile->phone;
}
?>

<section id="main" data-layout="layout-1">
  @include('layouts/aside')


    <section id="content">
         <div class="col-md-12">
             <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="sidetab1">
            <div class="row">

                <div class="col-md-12">

                    <div class="card my-project">
                        <div class="card-body card-padding">

                            <div class="dash-widgets landing-widget">
                                <div class="row">
                                    <div class="myblock-header">
                                        <h3><span style="color: #009688;">Create</span> Project</h3>

                                    </div>

                                </div>
                                <hr />
                            </div>

                            <!-- side menu start-->

                            <!-- begin side tab section -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mb mt">

                                        <div class="nav-tabs-three">


                                            <div class="row">

                                                <div role="tabpanel" class="tab">

                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <ul class="tab-nav" role="tablist">
                                                                <li class="active" role="presentation"><a href="#messages9" aria-controls="messages9" role="tab" data-toggle="tab">Store Listing</a></li>
                                                                <?php if($service==1){ ?><li role="presentation"><a href="#" aria-controls="design9" role="tab" data-toggle="tab">Design</a></li>
                                                                <li role="presentation"><a href="#" aria-controls="render" role="tab" data-toggle="tab">Render</a></li>
                                                                <li role="presentation"><a href="#" aria-controls="publish" role="tab" data-toggle="tab">publishing Setting</a></li>
                                                                <li role="presentation"><a href="#" aria-controls="transfer" role="tab" data-toggle="tab">Transfer Project</a></li>
<?php }?>


                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="card">

                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active in animated fadeInRight" id="messages9">
                                                                    <div class="tab-header">
                                                                        <h2>Store Listing</h2>
                                                                    </div>

                                                                    <div class="date-filter pull-right">
                                                                        <p>Field makes with <span style="color: red;">*</span> need to be field withoud pulishing</p>

                                                                    </div>
                                                                    <div class="clearfix"></div>

                                                                     <form class="form-horizontal store" name="createproject" id="createproject" method="POST"  action="javascript:void(0);" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="service" value="{{$service}}">


                                                                        <div class="card-body card-padding">
                                                                            <h3>Project Detail</h3>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">Project Title</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <input class="form-control" type="text" name="project_title" placeholder="Project Title">
                                                                                    <input class="form-control input-sm" id="pidmenu1"  type="hidden" name="pid">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">Short description</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <textarea class="form-control" rows="5" name="short_description" placeholder="Short description"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">Full description</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <textarea class="form-control" rows="5" name="description" placeholder="Full description"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">Company name</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <input class="form-control" type="text" name="company_name" placeholder="Company name">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label"> City</label>
                                                                                <div class="col-sm-10">
                                                                                      <select class="form-control" data-live-search="true" name="city">
                                                                                        <option value="">Select City</option>
                                                                                        @foreach($countries as $country)
                                                                                        <option  value="{{$country->id}}">{{$country->name}}, {{$country->statename}}, {{$country->countryname}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label"> Location</label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control" type="text"  name="location" placeholder="Location">
                                                                                   
                                                                                </div>
                                                                            </div>
                                                                            <h3>Contact Detail</h3>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label"> Website</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <input class="form-control" type="text" name="website" placeholder="Website">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">E-mail</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <input class="form-control" type="text" name="email" placeholder="E-mail" value="{{$email}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label">Phone</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="fg-line">
                                                                                        <input class="form-control" type="text" name="mobile" placeholder="Phone" value="{{$phone}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                             <div class="form-group">
                                                                                <label for="" class="col-sm-2 control-label"> E-brochure</label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control" type="text"  name="ebrochure" placeholder="E-brochure">
                                                                                   
                                                                                </div>
                                                                            </div>
<h3>Category</h3>
                                                                          <div class="form-group">
                                                                                        <label for="" class="col-sm-2 control-label"> Select Category</label>
                                                                                        <div class="col-sm-10">
                                                                                            <select class="form-control" name="category">
                                                                                                <option  value="">Select Category</option>
                                                                                                @foreach($categories as $category)
                                                                                                <option   value="{{$category->id}}">{{$category->category}}</option>
                                                                                                @endforeach

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>                           
                                                                      </div>
                                                                   <div class="clearfix"></div>
                                                                    <div class="card-header">
                                                                        <h2>Graphics Assets <small>If you have add localized graphics for each language graphics for your detailed language is used
                                                                                <br />
                                                                                <span style="color: #009688;">Learn more about graphics assets</span></small></h2>
                                                                    </div>
                                                                


                                                                    <div class="card second-tab">
                                                                        <div class="card-body card-padding">
                                                                            <div role="tabpanel" class="tab">
                                                                                <ul class="tab-nav" role="tablist">
                                                                                    <li class="active"><a href="#home10" aria-controls="home10" role="tab" data-toggle="tab"> featured & thumb Image</a></li>
<!--                                                                                    <li role="presentation"><a href="#thumb10" aria-controls="thumb10" role="tab" data-toggle="tab"> thumb Image</a></li>-->
                                                                                   
                                                                                    @foreach($imagecategories as $imagecategory)
                                                                                        
                                                                                        <li role="presentation"><a href="#{{$imagecategory->category}}" aria-controls="{{$imagecategory->category}}" role="tab" data-toggle="tab">{{$imagecategory->category}}</a></li>                                                                                   
                                                                                        @endforeach  
                                                                                       
                                                                                </ul>

                                                                                <div class="tab-content">
                                                                                    <div role="tabpanel" class="tab-pane active animated fadeIn" id="home10">
                                                                                        <div class="row">                                                    
                                                                                            <div class="col-md-3">
                                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                                                                    <div>
                                                                                                        <span class="btn btn-info btn-file">
                                                                                                            <span class="fileinput-new">Select featured image</span>
                                                                                                            <span class="fileinput-exists">Change</span>
                                                                                                            <input type="file"  name="feature_image">
                                                                                                        </span>
                                                                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                             <div class="col-md-3">
                                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                                                                    <div>
                                                                                                        <span class="btn btn-info btn-file">
                                                                                                            <span class="fileinput-new">Select thumb image</span>
                                                                                                            <span class="fileinput-exists">Change</span>
                                                                                                           <input type="file"  name="thumbnail">
                                                                                                        </span>
                                                                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
<!--                                                                                    <div role="tabpanel" class="tab-pane animated fadeIn" id="thumb10">
                                                                                        <div class="row">
                                                                                            
                                                                                            <div class="col-md-3">
                                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                                                                    <div>
                                                                                                        <span class="btn btn-info btn-file">
                                                                                                            <span class="fileinput-new">Select image</span>
                                                                                                            <span class="fileinput-exists">Change</span>
                                                                                                           <input type="file"  name="thumbnail">
                                                                                                        </span>
                                                                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>-->
                                                                                    @foreach($imagecategories as $imagecategory)                                                           
                                                                                        <div role="tabpanel" class="tab-pane animated fadeIn" id="{{$imagecategory->category}}">
                                                                                       
                                                                                        <div class="row">
                                                      
                                                                                         
                                                                                          <?php for($i=1;$i<11;$i++){ ?>  
                                                                                            <div class="col-md-3">
                                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                                                                    <div>
                                                                                                        <span class="btn btn-info btn-file">
                                                                                                            <span class="fileinput-new">Select image</span>
                                                                                                            <span class="fileinput-exists">Change</span>
                                                                                                            <input type="file" name="{{$imagecategory->category.$i}}">
                                                                                                        </span>
                                                                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
<?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                        @endforeach
                                                                  
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                    <button type="submit" class="btn btn-info pull-right"> Save & Pay <i class="fa fa-chevron-right"></i></button>
                                       
                                  <br />

 </form>

                                                                </div>


                                                                <div role="tabpanel" class="tab-pane  animated fadeInRight in" id="design9">
  <form class="form-horizontal store" name="createprojectservices" id="createprojectservices" method="POST"  action="javascript:void(0);" >
                                    {!! csrf_field() !!}
                                                             <input class="form-control input-sm" id="pidmenu2"  type="hidden" name="pid">
                                                             <div class="tab-header">
                                                                        <h2>Design</h2>
                                                                    </div>


                                                                    <div class="clearfix"></div>
                                                                    <div class="card-body card-padding">
                                                                          
                                                                            <div class="card-body card-padding">

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Select Category Layout</label>
                                                                                    <div class="col-sm-10">
                                                                                      <select class="selectpicker" name="layout" id="layout">
                                    <option  value="">Select Layout</option>
                                                                                        @foreach($layouts as $layout)
                                                                                        <option <?php if(isset($project) && $project->category_id==$category->id){ echo 'selected=""'; } ?>  value="{{$layout->id}}">{{$layout->name}}</option>
                                                                                        @endforeach
                                    </select>





                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Mandatory Files</label>
                                                                                    
                                                                                </div>

                                                                                
                                                                                <div class="col-md-11 col-md-offset-2">

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Side View File</label>
                                                                                    <div class="col-sm-10">
                                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                    <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Furniture Plan File</label>
                                                                                    <div class="col-sm-10">
                                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                                                                    </div>
                                                                               
                                                                                </div>

                                                                                
</div>

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Optional Files</label>
                                                                                    
                                                                                </div>

                                                                                <div class="col-md-11 col-md-offset-2">

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Furniture Plan File</label>
                                                                                    <div class="col-sm-10">
                                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                                                                    </div>
                                                                                </div>

                                                                                
</div>
                                                                                <div class="col-md-11 col-md-offset-2">

                                                                                <div class="form-group">
                                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Reference Image File</label>
                                                                                    <div class="col-sm-10">
                                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                                                                    </div>
                                                                                </div>

                                                                                
</div>


                                                                                <div class="form-group">
                                                                                    <div class="col-sm-offset-2 col-sm-10">
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                       

                                                                        </div>
                                                                    <div class="card second-tab">
                                                                        <div class="card-body card-padding">
                                                                            <div role="tabpanel" class="tab">
                                                                                <ul class="tab-nav" role="tablist">
                                                                                    <li class="active"><a href="#Living" aria-controls="Living" role="tab" data-toggle="tab">Living Room</a></li>
                                                                                    <li role="presentation"><a href="#Kitchen" aria-controls="Kitchen" role="tab" data-toggle="tab">Kitchen</a></li>
                                                                                    <li role="presentation"><a href="#Bedroom" aria-controls="Bedroom" role="tab" data-toggle="tab">Bedroom</a></li>
                                                                                </ul>

                                                                                <div class="tab-content room">
                                                                                    <div role="tabpanel" class="tab-pane active animated fadeInRight in" id="Living">
                                                                                        <ul class="row">
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>

                                                                                        </ul>

                                                                                    </div>
                                                                                    <div role="tabpanel" class="tab-pane animated fadeInRight" id="Kitchen">
                                                                                        <ul class="row">
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>

                                                                                        </ul>
                                                                                    </div>
                                                                                    <div role="tabpanel" class="tab-pane animated fadeInRight" id="Bedroom">
                                                                                        <ul class="row">
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="col-md-4">
                                                                                                <img class="img-responsive" src="{{url('html/img/middle3.jpg')}}" />
                                                                                                <div class="radio m-b-15">
                                                                                                    <label>
                                                                                                        <input type="radio" name="sample" value="">
                                                                                                        <i class="input-helper"></i>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>

                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div><ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <a href="#messages9" aria-controls="messages9" role="tab" data-toggle="tab" aria-expanded="true">  <button type="submit" class="btn btn-primary ">Back</button> </a>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save & Next</button>
                                        </li>
                                    </ul></div>
                                                                    </div>
  </form>

                                                                </div>



                                                                 <div role="tabpanel" class="tab-pane animated fadeInRight in" id="render">

                                                                            <div class="tab-header">
                                                                                <h2>Render </h2>
                                                                            </div>


                                                                            <div class="clearfix"></div>
                                                                                
                                                                            



                                                                        </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>







                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end side tab section -->

                        <!--side menu end-->

                    </div>

                </div>


            </div>
        </div>
                 
                <div role="tabpanel" class="tab-pane" id="profile11">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        
                                    </div>
<!--                                    <div role="tabpanel" class="tab-pane" id="messages11">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="settings11">
                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body card-padding">
                                                        <p>Morbi mattis ullamcorper velit. Etiam rhoncus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Cras id dui. Curabitur turpis.
            Etiam ut purus mattis mauris sodales aliquam. Aenean viverra rhoncus pede. Nulla sit amet est. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Praesent ac sem eget est egestas volutpat.
            Cras varius. Morbi mollis tellus ac sapien. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Fusce vel dui.</p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>-->

       </div>
        </div>


    </section>
</section>
@stop
