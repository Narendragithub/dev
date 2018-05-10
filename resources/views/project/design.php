<div role="tabpanel" class="tab-pane  animated fadeInRight in" id="design9">
    <form class="form-horizontal store" name="" id="addlayout" method="POST" action="{{url('project/addprojectlayout')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input class="form-control input-sm" id="pidmenu2" value="{{$project->id}}" type="hidden" name="pid">
        <div class="tab-header">
            <h2>Design</h2>
        </div>
        <div class="date-filter pull-right">
            <div class="btn-group">
                <button class="btn btn-info waves-effect btn-addlayout" id="addlayoutbtn" type="button">Add Layout</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="addlayoutform" style="display: none;">
            <div class="card-body card-padding">
                <div class="card-body card-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail3">Select Layout</label>
                        <div class="col-sm-10">
                            <?php $pro_layout = new \App\Projectlayouts();?>
                            <select class="selectpicker" name="layout" id="layout" onchange="getattribute(this.value);">
                            <option value="1">Select Layout</option>
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
                                                        <input type="file" name="furniture_plan_view" id="furniture_plan_view">
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
                                                        <input type="file" name="reference_image" id="reference_image">
                                                        </span>
                                                        <span class="fileinput-filename"></span>
                                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <h3>Check out our Our Sample files</h3>
                                                <p> <a href="{{url('Sample CAD.zip')}}"> Download Sample file</a> | <a href="#"> Preview Sample file</a></p>

                                            </div>
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
                                            <button class="btn btn-info waves-effect btn-addlayout" type="button">Cancel</button>

                                            <button type="submit" class="btn btn-info ">Save<i class="fa fa-chevron-right"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="card second-tab" id="viewlayoutlist">
                            <div class="card-body card-padding">

                                <div role="tabpanel" class="tab">
                                    <ul class="tab-nav" role="tablist">
                                        <?php
                                                                                            $active = 'active';
                                                                                            foreach ($projectlayouts as $projectlayout) {
                                                                                                ?>
                                            <li class="<?php echo $active; ?>"><a href="#<?php echo $projectlayout->id; ?>" aria-controls="<?php echo $projectlayout->id; ?>" role="tab" data-toggle="tab">{{$projectlayout->layout->name}}</a></li>

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
                                                                    </div>

                                                                </div>

                                                                <?php } ?>

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