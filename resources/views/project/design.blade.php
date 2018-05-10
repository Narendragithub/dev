<div role="tabpanel" class="tab-pane  animated fadeInRight in" id="design9">
    <form class="form-horizontal store" name="" id="addlayout" method="POST" action="{{url('project/addprojectlayout')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input class="form-control input-sm" id="pidmenu2" value="{{$project->id}}" type="hidden" name="pid">
        <div class="tab-header">
            <h2>Design</h2>
        </div>
       <?php if($project->premium_service > 0){ ?>  
        <div class="date-filter pull-right">
            <div class="btn-group">
                <button class="btn btn-info waves-effect btn-addlayout" id="addlayoutbtn" type="button">Add Layout</button>
            </div>
        </div>
       <?php }?>
        <div class="clearfix"></div>
        <div id="addlayoutform" style="display: none;">
                <div class="card-body card-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">Select Layout</label>
                        <div class="col-sm-10">
                            <?php $pro_layout = new \App\Projectlayouts();?>
                            <select class="form-control" name="layout" id="layout" onchange="getattribute(this.value);">
                            <option value="">Select Layout</option>
                            <?php
                                foreach ($layouts as $layout) {
                                //$check =   $pro_layout->projectlayoutthemes($project->id,$layout->id);
                                $check = $project->projectlayouts()->where('project_id', $project->id)->where('layout_id', $layout->id)->get();
                                if (count($check) == 0) {
                                ?>
                                <option value="{{$layout->id}}">{{$layout->name}}</option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">Mandatory Files</label>
                    </div>
                    <div class="col-md-11 col-md-offset-2">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Top View File</label>
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file m-r-10">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="top_view">
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputEmail3">Side View File</label>
                            <div class="col-sm-10">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file m-r-10">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="side_view">
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                </div>
                               
                            </div>
                        </div>
                        
                                <div class="form-group">
                                    <p class="text-center"><b>OR</b></p> 
                                    <label for="" class="col-sm-2 control-label"> Specify height from ceiling(in meters)</label>
                                    <div class="col-sm-10">
                                        <div class="fg-line">
                                            <input class="form-control" type="text" value="<?php echo $project->ceiling_height?>" name="ceiling_height" id="ceiling_height" placeholder="Ceiling Height in meters">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"> Specify door height(in meters)</label>
                                    <div class="col-sm-10">
                                        <div class="fg-line">
                                            <input class="form-control" type="text" value="<?php echo $project->door_height?>" name="door_height" id="door_height" placeholder="Door Height in meters">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"> Specify window height(in meters)</label>
                                    <div class="col-sm-10">
                                        <div class="fg-line">
                                            <input class="form-control" type="text" value="<?php echo $project->window_height?>" name="window_height" id="window_height" placeholder="Window Height in meters">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Specify window distance from ceiling(in meters)</label>
                                    <div class="col-sm-10">
                                        <div class="fg-line">
                                            <input class="form-control" type="text" value="<?php echo $project->window_distance_ceiling?>" name="window_distance_ceiling" id="window_distance_ceiling" placeholder="Window distance from ceiling in meters">
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
                                                        <input type="file" name="furniture_plan_view">
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
                                                        <input type="file" name="reference_image">
                                                        </span>
                                                        <span class="fileinput-filename"></span>
                                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10 gallery clearfix">
                                                <h3>Check out our Sample files</h3>
                                                <p> <a class="text-warning" href="{{url('Sample CAD.zip')}}"> Download Sample file</a> | <a class="text-success" href="{{url('images/ceiling_layout.JPG')}}" rel="prettyPhoto[pp_gal]"> Preview Sample file</a>
                                                <a href="{{url('images/floor_plan.JPG')}}" rel="prettyPhoto[pp_gal]"> </a>
                                                <a href="{{url('images/wall_section.JPG')}}" rel="prettyPhoto[pp_gal]"> </a></p>
                                                
                                            </div>
                                        </div>
                                    </div>

                           
                                <div class="card second-tab">
                                    <div class="card-body card-padding">
                                        <div id="layoutattribute"></div>
                                    </div>
                                </div>
                                <div>
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li>
                                            <button type="submit" class="btn btn-info ">Save<i class="fa fa-chevron-right"></i></button>
                                            <button class="btn btn-danger waves-effect btn-addlayout" type="button">Cancel</button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="card second-tab" id="viewlayoutlist">
                            <div class="card-body card-padding">
                        <?php if($project->premium_service >= 0){ ?> 

                           <!--  <div class="col-md-12"><iframe id="myiframe" width="800" height="500" style="margin-top:40px;"  src="<?php echo $webgl_link; ?>" onLoad="iframeDidLoad();"></iframe></div> -->
                                <div role="tabpanel" class="tab">
                                    <ul class="tab-nav" role="tablist">
                                        <?php
                                            $active = 'active';
                                            foreach ($projectlayouts as $projectlayout) {
                                        ?>
                                                    <li class="<?php echo $active; ?>"><a href="#<?php echo $projectlayout->id; ?>" aria-controls="<?php echo $projectlayout->id; ?>" role="tab" data-toggle="tab" onclick="click_layout(<?php echo $project->id; ?>,<?php echo $projectlayout->id; ?>)">{{$projectlayout->layout->name}}</a></li>

                                        <?php
                                            $active = '';
                                            }
                                        ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php
                                            $active = 'active in';
                                            foreach ($projectlayouts as $projectlayout) {
                                                ?>
                                            <div role="tabpanel" class="tab-pane animated fadeInRight <?php echo $active; ?>" id="<?php echo $projectlayout->id; ?>">
                                                <div class="form-horizontal">
                                                    <div class="row">
                                                        <div class="card-body card-padding">
                                                        <div class="col-md-12"><iframe id="myiframe" width="900" height="500" style="margin-top:40px;"  src="<?php echo $webgl_link; ?>" onLoad="iframeDidLoad();"></iframe></div>
                                                        <!--    
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label" for="inputEmail3">Mandatory Files</label>

                                                            </div>

                                                            <div class="col-md-11 col-md-offset-2">

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Top View File</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->top_view; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Side View File</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->side_view; ?>
                                                                        </label>
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
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->furniture_plan_view; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-11 col-md-offset-2">

                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Reference Image File</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->reference_image; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-11 col-md-offset-2">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Ceiling Height</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->ceiling_height; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-11 col-md-offset-2">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Door Height</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->door_height; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-11 col-md-offset-2">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Window Height</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->window_height; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-11 col-md-offset-2">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="inputEmail3">Window Distance form ceiling</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="col-sm-6 control-label" for="inputEmail3">
                                                                            <?php echo $projectlayout->window_distance_ceiling ; ?>
                                                                        </label>
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

                                                                <div class="col-md-11 col-md-offset-2">

                                                                    <div class="form-group">

                                                                        <div class="col-md-4">

                                                                            <img src="{{url('theme_images/'.$theme->image)}}" class="img-responsive">
                                                                            <div class="radio m-b-14">
                                                                                <label>
                                                                                    <h4>{{$theme->name}}</h4>

                                                                                </label>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                         <?php  if($project->is_submitted == 0) { ?>
                                                                        <div class="col-md-4"> <a href="#" class="btn btn-primary" data-toggle="modal" onclick="getLayoutattribute(<?php echo $project->id; ?>,<?php echo $projectlayout->layout->id; ?>,<?php echo $themeinfo->attribute_id; ?>)" data-target="#largeModal">Edit</a></div>
                                                                        <?php } ?>
                                                                    </div>

                                                                </div>

                                                                <?php } ?> -->

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
                               <?php  } else{ 
                                    
                                    echo "This feature is available only for premium projects"; 
                                }?>
                            </div>
                        </div>
                    </div>


         

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Select Themes</h4>
      </div>
       <form class="form-horizontal store" name="" id="changes_attribute" method="POST" action="{{url('project/editattribute')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        
      <div class="modal-body" id="attribute">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary getattribute-btn">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

