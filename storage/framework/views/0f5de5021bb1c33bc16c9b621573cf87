<div role="tabpanel" class="tab-pane  animated fadeInRight" id="prdetails">
    <div class="tab-header">
        <h2>Project Details</h2>
    </div>
    <div class="date-filter pull-right">
        <p>Field makes with <span style="color: red;">*</span> need to be field withoud pulishing</p>
    </div>
    <div class="clearfix"></div>
    <form class="form-horizontal store" name="editproject" id="editproject" method="POST" action="<?php echo url('project/savedetails')?>">
        <?php echo csrf_field();?>
        <div class="card-body card-padding">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Project Title</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" name="project_title" value="<?php echo $project->title?>" placeholder="Project Title">
                        <input class="form-control input-sm" id="pidmenu1" type="hidden" value="<?php echo $project->id?>" name="pid">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Short description (Max 500 characters)</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <textarea class="form-control" rows="5" name="short_description" placeholder="Short description"><?php echo $project->short_description?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Full description (Max 5000 characters)</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <textarea class="form-control" rows="5" name="description" placeholder="Full description"><?php echo $project->description?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Company name</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                            <input class="form-control" type="text" name="company_name" value="<?php echo $project->company_name?>" placeholder="Company name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"> Select Category</label>
                <div class="col-sm-10">
                    <select class="form-control" name="category" required="">
                        <option value="">Select Category</option>
                            <?php foreach($categories as $category){ ?>
                            <option <?php if ($project->category_id == $category->id) { echo 'selected=""'; } ?> value="<?php echo $category->id ?>"><?php echo $category->category?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    <button type="submit" class="btn btn-info pull-right">Save <i class="fa fa-chevron-right"></i></button>
    <br />
    </form>
</div>