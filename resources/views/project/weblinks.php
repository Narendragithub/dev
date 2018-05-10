<div role="tabpanel" class="tab-pane  animated fadeInRight" id="prlinks">
    <div class="tab-header">
        <h2>Web Links</h2>
    </div>

    <div class="clearfix"></div>
    <form class="form-horizontal store" name="links" id="links" method="POST" action="<?php echo url('project/savelinks')?>" enctype="multipart/form-data">
        <?php echo csrf_field()?>
        <input class="form-control input-sm" id="pidmenu1" type="hidden" value="<?php echo $project->id?>" name="pid">
        <div class="card-body card-padding">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Site Location</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" value="<?php echo $project->location?>" name="location" placeholder="Google Map Link">

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"> Website</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" value="<?php echo $project->website?>" name="website" placeholder="Website">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"> E-brochure</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="<?php echo $project->brochure_link?>" name="ebrochure" placeholder="E-brochure">
                    </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Featured Video Link</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="<?php echo $project->featured_video?>" name="featured_video" placeholder="Youtube video url">
                    </div>
            </div>
        </div>
    <button type="submit" class="btn btn-info pull-right">Save <i class="fa fa-chevron-right"></i></button>
    <br />
    </form>
</div>