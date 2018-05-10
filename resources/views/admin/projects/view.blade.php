@extends('layouts/admin')
@section('content')
<style>

    .stausrightfrom {
        width: 350px;
    }
    .staus {
        min-width: 200px;

    }
    .bs-wizard {margin-top:30px;}

    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0; }
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;width: 14%;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none;   margin-left: -67px;  margin-top: 19.5px;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 75%; width: 0%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
</style>
<div class="allcontent">
    <div class="maintitle">{{$project->title}}
        <?php if ($project->premium_service == 1) { ?><div class="pull-right">   <?php if ($project->is_completed == 1) { ?>
                    <a href="#" class="btn btn-success">Project Completed</a><?php
                } else {
                    if (\Auth::user('admin')->is_main == 1) {
                        $projectsteps = \App\Projectsteps::where('project_id', $project->id)->where('step', $project->status)->first();
                        if ($projectsteps->completed == 0) {
                            ?> <a href="#" class="btn btn-warning">Task Pending</a><?php
                        } else {
                            if ($projectsteps->approved == 1) {
                                ?><a href="#" class="btn btn-success">Approved</a><?php } else { ?> <a href="{{adminurl('project/approve_task/'.$project->id)}}" class="btn btn-primary">Task Approve</a><?php
                            }
                        }
                    } else {
                        $projectsteps = \App\Projectsteps::where('project_id', $project->id)->where('step', \Auth::user('admin')->department_id)->first();
                        if ($projectsteps->completed == 0) {
                            ?> <a href="{{adminurl('project/complete_task/'.$project->id)}}" class="btn btn-primary">Complete Task</a><?php
                        } else {
                            if ($projectsteps->approved == 1) {
                                ?><a href="#" class="btn btn-success">Approved</a><?php } else { ?> <a href="#" class="btn btn-warning disabled">Pending Approval</a><?php
                            }
                        }
                    }
                }
                ?>
            </div>
        <?php } ?>
    </div>
    <?php if ($project->premium_service == 1) { ?>
        <div class="container" style="padding: 0px !important;">
            <div class="row bs-wizard" style="border-bottom:0;">
                <div class="col-xs-2 bs-wizard-step  complete ">
                    <div class="text-center bs-wizard-stepnum ">Submitted</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>                
                </div>
                <?php
                $completed = 0;
                foreach ($departments as $department) {
                    ?> 
                    <div class="col-xs-2 bs-wizard-step <?php if ($department->id < $project->status or $project->is_completed == 1) { ?> complete <?php } else { ?> disabled <?php } ?>">
                        <div class="text-center bs-wizard-stepnum">{{$department->department_name}}</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>                
                    </div>        
                <?php } ?> 
                <div class="col-xs-2 bs-wizard-step  <?php if ($project->is_completed == 1) { ?> complete <?php } else { ?> disabled <?php } ?>">
                    <div class="text-center bs-wizard-stepnum ">Completed</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>                
                </div> 
            </div>

        </div>
    <?php } ?>
    <div class="tabsbg">
        <div id="tab2">
            <div role="tabpanel">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home">Summary</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#gallery">Gallery</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="render" href="#render">Render</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="design" href="#design">Designs</a></li>
                    <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="assets" href="#assets">Assets Bundle</a></li>
                    <li role="presentation" class="pull-right"><a data-toggle="tab" role="tab" aria-controls="project_files" href="#project_files">Project Files</a></li>
                </ul>

            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="home" class="tab-pane active" role="tabpanel">
            <div class="row">
                <div style="padding-left: 46px;" class="col-md-11"><h2> Project Summary<div class="pull-right"><?php if ($project->premium_service == 1) { ?>
                                Premium
                            <?php } else { ?>
                                Free
                            <?php }
                            ?></div></h2>
                </div>
                <div class="col-md-11">
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td style="width: 150px;">Company Name:</td>
                                            <td>{{$project->company_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Category:</td>
                                            <td><?php
                                                $cat = \App\Category::find($project->category_id);
                                                if (count($cat) > 0) {
                                                    echo $cat->category;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>Location:</td>
                                            <td><?php echo$project->location; ?></td>
                                        </tr>
                                        <!--<tr>
                                            <td>City:</td>
                                            <td><?php
                                        $city = \App\City::find($project->city);
                                        if (count($city) > 0) {
                                            echo $city->name;
                                        }
                                        ?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{$project->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number:</td>
                                            <td>{{$project->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Website:</td>
                                            <td>{{$project->website}}</td>
                                        </tr>

                                        <tr>
                                            <td>Short Description:</td>
                                            <td>{{$project->short_description}}</td>

                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>{{$project->description}}</td>                                          
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div></div>
        <div role="tabpanel" class="tab-pane" id="gallery">
            <div role="tabpanel">
                <ul role="tablist" class="nav nav-tabs">
                    <?php $act = 'active'; ?>
                    @foreach($imagecategories as $imagecategory)
                    <li role="presentation" class="{{$act}}"><a href="#cat{{$imagecategory->id}}" aria-controls="cat{{$imagecategory->id}}" role="tab" data-toggle="tab">{{ucfirst($imagecategory->category)}}</a></li>                                                                                   
                    <?php $act = ''; ?>
                    @endforeach  
                </ul>
            </div>
            <div class="tab-content">
                <?php $act = 'active'; ?>
                @foreach($imagecategories as $imagecategory)                                                           
                <div role="tabpanel" class="tab-pane {{$act}}" id="cat{{$imagecategory->id}}">

                    <div class="row">

                        <?php
                        $projectimages = $project->projectimages()->where('img_category_id', $imagecategory->id)->orderBy('type', 'asc')->get();

                        foreach ($projectimages as $image) {
                            ?> 
                            <div class="col-md-3" id="{{$image->id}}">
                                <div class="fileinput fileinput-new" >

                                    <div class="fileinput-preview thumbnail" >

                                        <img src="{{url('project_images/'.$image->image)}}">
                                    </div>
                                    <div class="text-center">
                                        @if($image->type==0)
                                        <span class="fa fa-mobile-phone fa-2x"></span>
                                        @elseif($image->type==1)
                                        <span class="fa fa-tablet fa-2x"></span>
                                        @elseif($image->type==2)
                                        <span class="fa fa-desktop fa-2x"></span>    
                                        @endif
                                        <!--<a href="javascript:void(0)" class="btn btn-danger pull-right" onClick="removeimage({{$image->id}});"  >
                                           Remove
                                        </a>-->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php $act = ''; ?>
                @endforeach
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="render">
            <form action="{{adminurl('project/addrenderimage')}}" method="post" name="renderimages" id="renderimages" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type='hidden' name='pid' value='{{$project->id}}'/>

                <div class="serchmainin">

                    <div class="staus">Add Renders</div>
                    <div class="stausrightfrom">
                        <input type="file"   name="image" required="">
                    </div>
                </div>
                <div class="serchmainin">
                    <div class="staus"></div>
                    <div class="stausrightfrom">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
            <div class="row">

                <?php
                $projectimages = $project->projectimages()->where('img_category_id', $imagecategory->id)->get();

                foreach ($renderimages as $image) {
                    ?> 
                    <div class="col-md-3" id="{{$image->id}}">
                        <div class="fileinput fileinput-new" >
                            <div class="fileinput-preview thumbnail" >
                                <img src="{{url('project_images/render_images/'.$image->image)}}">
                            </div>
                            <!--                                                                                                            <div>
                                                                                                                                    </div>-->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="design" class="tab-pane" role="tabpanel">
            <div class="tabsbg">
                <div id="tab2">
                    <div role="tabpanel">
                        <ul role="tablist" class="nav nav-tabs">
                            <?php
                            $active = 'active';
                            foreach ($projectlayouts as $projectlayout) {
                                ?>
                                <li class="<?php echo $active; ?>" role="presentation"><a data-toggle="tab" role="tab" aria-controls="tab_layout<?php echo $projectlayout->id; ?>" href="#tab_layout<?php echo $projectlayout->id; ?>">{{$projectlayout->layout->name}}</a></li>

                                <?php
                                $active = '';
                            }
                            ?></ul>
                        <div class="tab-content">
                            <?php
                            $active = 'active in';
                            foreach ($projectlayouts as $projectlayout) {
                                ?>
                                <div role="tabpanel" class="tab-pane animated fadeInRight <?php echo $active; ?>" id="tab_layout<?php echo $projectlayout->id; ?>">
                                    <div  class="form-horizontal">

                                        <div class="row">
                                            <div class="card-body card-padding">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="inputEmail3">Mandatory Files</label>

                                                </div>

                                                <div class="col-md-9 col-md-offset-2">

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Top View File</label> 
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php if ($projectlayout->top_view) { ?><a href="<?php echo url('/project_files/' . $projectlayout->top_view); ?>" class="btn btn-primary">Download</a><?php } ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Side View File</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php if ($projectlayout->side_view) { ?><a href="<?php echo url('/project_files/' . $projectlayout->side_view); ?>" class="btn btn-primary">Download</a><?php } ?></label>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="inputEmail3">Optional Files</label>

                                                </div>

                                                <div class="col-md-9 col-md-offset-2">

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Furniture Plan File</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php if ($projectlayout->furniture_plan_view) { ?><a href="<?php echo url('/project_files/' . $projectlayout->furniture_plan_view); ?>" class="btn btn-primary">Download</a><?php } ?></label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-9 col-md-offset-2">

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Reference Image File</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php if ($projectlayout->reference_image) { ?><a href="<?php echo url('/project_files/' . $projectlayout->reference_image); ?>" class="btn btn-primary">Download</a><?php } ?></label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-9 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Ceiling Height</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php
                                                                if ($projectlayout->ceiling_height) {
                                                                    echo $projectlayout->ceiling_height;
                                                                }
                                                                ?></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-9 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Door Height</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php
                                                                if ($projectlayout->door_height) {
                                                                    echo $projectlayout->door_height;
                                                                }
                                                                ?></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-9 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Window Height</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php
                                                                if ($projectlayout->window_height) {
                                                                    echo $projectlayout->window_height;
                                                                }
                                                                ?></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-9 col-md-offset-2">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="inputEmail3">Window distance from ceiling</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6 control-label" for="inputEmail3"><?php
                                                                if ($projectlayout->window_distance_ceiling) {
                                                                    echo $projectlayout->window_distance_ceiling;
                                                                }
                                                                ?></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <?php
                                                $layouttheme = $projectlayout->projectlayoutthemes($project->id, $projectlayout->layout->id);
                                                foreach ($layouttheme as $themeinfo) {
                                                    $theme = \App\Themes::find($themeinfo->theme_id);
                                                    $attribute = \App\Attributes::find($themeinfo->attribute_id);
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-2 control-label">{{$attribute->name}}</label>

                                                    </div>

                                                    <div class="col-md-9 col-md-offset-2">

                                                        <div class="form-group">

                                                            <div class="col-md-4">

                                                                <img src="{{url('theme_images/'.$theme->image)}}" class="img-responsive">
                                                                <div class="radio m-b-14">
                                                                    <label>
                                                                        <h4>{{$theme->name}}</h4>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php } ?>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">XML File</label>

                                                </div>


                                                <div class="col-md-9 col-md-offset-2">

                                                    <div class="form-group" id="<?php echo $projectlayout->id; ?>_div">
                                                        <?php if ($projectlayout->xml_file) { ?>
                                                            <label class="col-sm-2 control-label" for="inputEmail3"><?php echo assetbundlepath($projectlayout->xml_file); ?></label> 
                                                            <div class="col-sm-8">
                                                                <label class="col-sm-6 control-label" for="inputEmail3"><a href="<?php echo assetbundlepath($projectlayout->xml_file); ?>'" class="btn btn-primary">Download</a></label>
                                                            </div>
                                                        <?php } ?>
                                                        <form method="post" lid="<?php echo $projectlayout->layout_id; ?>" id="<?php echo $projectlayout->id; ?>" pid="<?php echo $projectlayout->project_id; ?>">    
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">

                                                                <div>
                                                                    <span class="btn  btn-file">

                                                                        <input type="file" id="fUpload<?php echo $projectlayout->id; ?>" name="<?php echo $projectlayout->id; ?>">
                                                                    </span>
                                                                    <a href="#" class="btn btn-success fileinput-exists" >Uplaod</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>     
                                <?php
                                $active = '';
                            }
                            ?>   

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="assets" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="">

                    <div class="maintitle">Assets Bundle Settings </div>
                    <div class="maintablewhite">
                        <div role="tabpanel">
                            <ul role="tablist" class="nav nav-tabs">
                                <?php $act = 'active'; ?>
                                @foreach($assetsbundleplatform as $assets)
                                <li role="presentation" class="{{$act}}"><a href="#assets{{$assets->id}}" aria-controls="assets{{$assets->id}}" role="tab" data-toggle="tab">{{ucfirst($assets->name)}}</a></li>                                                                                   
                                <?php $act = ''; ?>
                                @endforeach  
                            </ul>
                        </div>
                        <div class="tab-content">
                            <?php
                            $act = 'active';
                            foreach ($assetsbundleplatform as $assets) {
                                $assets1 = $project->projectassets()->where('platform_type', $assets->id)->get();
                                ?>
                                <div role="tabpanel" class="tab-pane {{$act}}" id="assets{{$assets->id}}">

                                    <div class="row">
                                        <div class="col-md-3" style="padding: 0px;">

                                            <form action="{{adminurl('project/addassetbundle')}}" method="post" name="addassetbundle<?php echo $assets->id; ?>" id="addassetbundle<?php echo $assets->id; ?>" enctype="multipart/form-data" class="upload_asset_bundle">
                                                {{ csrf_field() }}
                                                <input type='hidden' name='pid' value='{{$project->id}}'/>
                                                 <input type='hidden' name='assetid' value='{{$assets->id}}'/>
                                                <div class="serchmainin">
                                                    <div class="staus"><h4 ><?php echo $assets->name; ?> Asset Bundle</h4></div>
                                                </div>
                                                <div class="serchmainin">
                                                    <input type="hidden"  value="<?php echo $assets->id; ?>"  name="type" >                                      
                                                    <div class="staus">Bundle Version</div>
                                                    <div class="stausrightfrom">
                                                        <input type="text" class="" name="version" required>
                                                    </div>
                                                </div>
                                                <div class="serchmainin">                              
                                                    <div class="staus">Upload Bundle</div>
                                                    <div class="stausrightfrom">
                                                        <input type="file"   name="bundle" required>
                                                    </div>
                                                </div>
						
                                                <div class="serchmainin">
                                                    <div class="staus"></div>
                                                    <div class="stausrightfrom">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <?php
                                        if (count($assets1) > 0) {
                                            ?>
                                            <div class="col-md-9" style="padding: 0px;">  
                                                <h4 ><?php echo $assets->name; ?> Asset Bundle List</h4>
                                                <div class="tablegrid">
                                                    <div class="tablegridheader">
                                                        <!--<div><input type="checkbox" id="checkbox" name="checkbox"><label for="checkbox"></label></div>-->
                                                        <div>Link</div>
                                                        <div>Size</div>
                                                        <div>Version</div>
                                                        <div>Date</div>
                                                        <div>Action</div>

                                                    </div>
                                                    @foreach($assets1 as $assets2)

                                                    <div class="tablegridrow">
                                                        <!--<div><input type="checkbox" id="2" name="checkbox"> <label for="2"></label></div>-->
                                                        <div align="left">{{ assetbundlepath($assets2->bundle_link)}} </div>
                                                        <div>{{ Human_filesize($assets2->bundle_size)}} </div>
                                                        <div>{{ $assets2->bundle_version}} </div>
                                                        <div>{{ $assets2->created_at}} </div>

                                                        <div>
                                                            <a href="{{assetbundlepath($assets2->bundle_link)}}" class="btn btn-primary"><i class="fa fa-cloud-download" ></i></a>  
                                                            <a class="btn btn-danger delete" prop="Assest Bundle" href="{{  adminurl('project/assets_delete/'.$assets2->id.'/'.$project->id) }} "><i class="fa fa-trash" ></i></a></div>        
                                                    </div>
                                                    @endforeach   

                                                </div>
                                            </div>

                                            <?php
                                        }
                                        ?>
                                    </div></div> 
                                    
                                    
                                    <?php
                                $act = '';
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div></div>
        <div id="project_files" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="">
                    <div class="maintitle">Project Files</div>
                    <div class="maintablewhite">
                        <div class="">
                            <div class="col-md-7" >
                                <table  class="table">
                                    <tr>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>User</th>
                                        <?php if ($user->is_main == 1) {
                                            ?><th> Action</th><?php } ?>
                                        <th>Date</th>
                                        <th>Download</th>
                                    </tr>
                                    @foreach($projectfiles as $projectfile)    
                                    <tr>
                                        <td>{{ $projectfile->title}} </td>
                                        <td>{{ $projectfile->file }} </td>
                                        <td><?php
                                            $admin = \App\Admin::find($projectfile->user_id);
                                            if (count($admin) > 0) {
                                                echo $admin->name;
                                            }
                                            ?></td>
                                        <?php if ($user->is_main == 1) {
                                            ?> <td><a class="delete"  href="{{  adminurl('project/projectfile_delete/'.$projectfile->id."/".$project->id) }} ">Delete</a>
                                            </td><?php } ?>
                                        <td><?php echo date("d/m/Y", strtotime($projectfile->created_at)); ?> </td>
                                        <td><a  href="{{url('project_files/'. $projectfile->file) }} ">Download</a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-4" >                 
                                <form action="{{adminurl('project/addfile')}}" method="post" name="addfile" id="addfile" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type='hidden' name='pid' value='{{$project->id}}'/>
                                    <div class="serchmainin">                
                                        <div class="staus">Title</div>
                                        <div class="stausrightfrom">
                                            <input placeholder="Title" name="title" class="formbox" type="text">
                                        </div>
                                    </div>
                                    <div class="serchmainin">                
                                        <div class="staus">Upload File</div>
                                        <div class="stausrightfrom">
                                            <input type="file"   name="file"  >
                                        </div>
                                    </div>
                                    <div class="serchmainin">
                                        <div class="staus"></div>
                                        <div class="stausrightfrom">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div></div>
    </div>
</div>
</div>
<style>
    #gallery > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        border-left:1px solid #eee;
    }
</style>
@stop