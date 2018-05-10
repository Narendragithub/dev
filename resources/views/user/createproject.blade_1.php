@extends('layouts/main')
@section('content')
<?php $email='';
$phone='';
if($profile){
$email=$profile->email;
$phone=$profile->phone;
}?>
<section id="main" data-layout="layout-1">
    <section id="content">
        <div class="container">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <div class="card">
                <div class="card-header">
                    <h3><span style="color:#009688;">Post</span> a New Project</h3>

                </div>
                <div class="card-body card-padding">
                    <div class="row">
                        <div class="process">
                            <div class="process-row nav nav-tabs">

                                <div class="process-step">
                                    <button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#menu1"><i class="fa fa-info fa-3x"></i></button>
                                    <p><small>Project Details</small></p>
                                </div>
                                <div class="process-step">
                                    <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2"><i class="fa fa-file-text-o fa-3x"></i></button>
                                    <p><small>Select Service</small></p>
                                </div>
                                <div class="process-step">
                                    <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu3"><i class="fa fa-upload fa-3x"></i></button>
                                    <p><small>Upload Files</small></p>
                                </div>
                                <div class="process-step">
                                    <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu4"><i class="fa fa-image fa-3x"></i></button>
                                    <p><small>Reference Images</small></p>
                                </div>

                                <div class="process-step">
                                    <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu5"><i class="fa fa-check fa-3x"></i></button>
                                    <p><small>Done</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content form-horizontal">

                            <div id="menu1" class="tab-pane fade active in">

                                <form name="createproject" id="createproject" method="POST"  action="javascript:void(0);" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="card-body card-padding">


                                        <div class="row">
                                            <h3>Project Detail</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Project Title</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="pidmenu1"  type="hidden" name="pid">

                                                    <input class="form-control input-sm" id="inputEmail3" placeholder="Project Title" type="text" name="project_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Company Name</label>
                                            <div class="col-sm-10">

                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="inputPassword3" placeholder="Company Name" type="text" name="company_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Short Description</label>
                                            <div class="col-sm-10">

                                                <div class="fg-line">

                                                    <textarea class="form-control input-sm" rows="5" placeholder="Short Description...." name="short_description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">

                                                <div class="fg-line">

                                                    <textarea class="form-control input-sm" rows="5" placeholder="Description...." name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Location</label>
                                            <div class="col-sm-10">

                                                <div class="fg-line">
                                                    <select class="selectpicker" name="location">
                                                        <option  value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                        <option  value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <h3>Contact Detail</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="Text1" placeholder="Website" name="website" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="Text2" placeholder="E-mail" name="email" value="{{ $email}}" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="Text3" placeholder="Phone" name="mobile" value="{{$phone}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h3>Category</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Select A Category</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <select class="selectpicker" name="category">
                                                        <option  value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option  value="{{$category->id}}">{{$category->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h3>Images</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Featured Image</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file"  name="feature_image">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Hi-Res Project Thumbnail* (512 x 512)</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
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
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">E-Brochure Link (If available)</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="Text4" placeholder="link if available" name="brochure" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Privacy Policy</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="" id="Text5" placeholder="Privacy Policy" type="checkbox" name="privacy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save & Next <i class="fa fa-chevron-right"></i></button>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                            <div id="menu2" class="tab-pane fade"> <form name="createprojectservices" id="createprojectservices" method="POST"  action="javascript:void(0);" >
                                    {!! csrf_field() !!}
                                    <div class="card-body card-padding">
                                        <div class="row">
                                            <h3>Select Service</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Premium Service</label>
                                            <input class="form-control input-sm" id="pidmenu2"  type="hidden" name="pid">
                                            <div class="col-sm-10">
                                                <div class="checkbox m-b-15">
                                                    <label> 

                                                        <input name="service" value="1" type="checkbox" checked="">
                                                        <i class="input-helper"></i> 
                                                    </label>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save & Next <i class="fa fa-chevron-right"></i></button>
                                        </li>
                                    </ul></form>
                            </div>

                            <div id="menu3" class="tab-pane fade ">

                                <form name="createprojectfile" id="createprojectfile" method="POST"  action="javascript:void(0);" >
                                    {!! csrf_field() !!}
                                    <div class="card-body card-padding">
                                        <div class="row">
                                            <h3>Upload Files</h3>
                                        </div>
                                        <input class="form-control input-sm" id="pidmenu3"  type="hidden" name="pid">
                                        <div class="row">
                                            <h3>Upload Layout</h3>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Enter Number Of Layout</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input class="form-control input-sm" id="Text6" name="no_of_layout" placeholder="Enter Number Of Layout" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Select Layout</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <select class="selectpicker" name="layout_id">
                                                        @foreach($layouts as $layout)
                                                        <option  value="{{$layout->id}}">{{$layout->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h3>File Upload</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">CAD Files</label>
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
                                        <div class="row">
                                            <h3>Select Theme</h3>
                                        </div>
                                        @foreach($attributes as $attribute)
                                        <?php $themes = $attribute->theme($attribute->attribute_id)->get();
                                        ?>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">{{$attribute->name}}</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <select class="selectpicker">
                                                        @foreach($themes as $theme)
                                                        <option id="{{$theme->name}}">{{$theme->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save & Next <i class="fa fa-chevron-right"></i></button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div id="menu4" class="tab-pane fade ">

                                <form name="createprojectimage" id="createprojectimage" method="POST"  action="javascript:void(0);" >
                                    {!! csrf_field() !!}
                                    <div class="card-body card-padding">
                                        
                                        <input class="form-control input-sm" id="pidmenu4"  type="hidden" name="pid">
                                        
                                        <div class="row">
                                            <h3>Upload Reference Images</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Interiors</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="...">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Exteriors</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="...">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Views </label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="...">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Reference Images and Renders </label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                        <div>
                                                            <span class="btn btn-info btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="...">
                                                            </span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button>
                                        </li>
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save & Next <i class="fa fa-chevron-right"></i></button>
                                        </li>
                                    </ul>
                                </form>
                            </div>


                            <div id="menu5" class="tab-pane fade">
                                <h3>Menu 5</h3>
                                <p>Some content in menu 4.</p>
                                <ul class="list-unstyled list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i>Back</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-success"><i class="fa fa-check"></i>Done!</button>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
</section>
@stop
