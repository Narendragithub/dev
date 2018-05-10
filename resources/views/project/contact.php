<div role="tabpanel" class="tab-pane  animated fadeInRight" id="prcontact">
    <div class="tab-header">
        <h2>Contact Details</h2>
    </div>

    <div class="clearfix"></div>
    <form class="form-horizontal store" name="contact" id="contact" method="POST" action="<?php echo url('project/savecontact')?>" enctype="multipart/form-data">
        <?php echo csrf_field() ?>
        <input class="form-control input-sm" id="pidmenu1" type="hidden" value="<?php echo $project->id?>" name="pid">
        <div class="card-body card-padding">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" value="<?php echo $project->email?>" name="email" placeholder="E-mail">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" name="mobile" value="<?php echo $project->phone?>" placeholder="Phone">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <textarea class="form-control" rows="5" name="address" placeholder="Address"><?php echo $project->address?></textarea>
                    </div>
                </div>
            </div>
        </div>
    <button type="submit" class="btn btn-info pull-right">Save<i class="fa fa-chevron-right"></i></button>
    <br />
    </form>
</div>