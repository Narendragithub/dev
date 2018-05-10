<div role="tabpanel" class="tab-pane animated fadeInRight in" id="render">

    <div class="tab-header">
        <h2>Renders</h2>
    </div>
    

    <div class="clearfix"></div>
   
    <div class="card-body card-padding" style=" min-height: 600px;">
     <?php if($project->premium_service > 0){ ?>   
        <?php if(count($renderimages) > 0){ ?>
       
            <div class="col-md-12" style="border-bottom:1px solid #cecece;margin-bottom: 15px;">
                <div class="col-md-2">
                    <a href="<?php echo url('project/email_file/'.$project->id);?>" title="Email"><i class="zmdi zmdi-hc-4x zmdi-email"></i></a></div>
                <div class="col-md-2">
                    <a href="" title="Print"><i class="zmdi zmdi-hc-4x zmdi-print"></i></a></div>
                <div class="col-md-2">
                    <a href="<?php echo url('project/download_file/'.$project->id);?>" title="Download"><i class="zmdi zmdi-hc-4x zmdi-download"></i></a></div>
                
            </div>
            <div class="row col-md-12 ">
    <?php foreach ($renderimages as $image) { 
        $imgpath=url("project_images/render_images/".$image->image);    
        ?>
        <div class="col-md-4" id="<?php echo $image->id;?>" >
        <div class="fileinput fileinput-new">
        <div class="fileinput-preview thumbnail">
        <img src="<?php echo $imgpath?>">
        </div>

        </div>
        </div>
        <?php } ?>
            </div>
    <?php }else{ ?>
    <p>
        <div>Please wait. Renders are in production and will be uploaded soon.</div>
        <div class="clearfix"></div>
    </p>
     <?php }} else{ echo "This feature is available only for premium projects"; }?>
    </div>

</div>
