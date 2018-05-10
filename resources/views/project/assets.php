<div role="tabpanel" class="tab-pane animated fadeInRight in" id="graphic">
    <div role="tabpanel">
            <div class="row">
                <div class="col-md-3">
                    <ul class="tab-nav fearure" role="tablist">
                        <?php $cc = 'active';
                        foreach($imagecategories as $imagecategory){ ?>
                            <li role="presentation" class="<?php echo $cc?>" ><a href="#cat<?php echo $imagecategory->id?>" onclick="initdmUploader('cat<?php echo $imagecategory->id?>')" aria-controls="cat<?php echo $imagecategory->id?>" role="tab" data-toggle="tab"><?php echo $imagecategory->category?></a></li>
                        <?php $cc = ''; ?>
                        <?php } ?>
                        <!--<li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">Featured Image</a></li>
                        <li><a href="#Interior" aria-controls="Interior" role="tab" data-toggle="tab">Interior </a></li>
                        <li><a href="#Exteriors" aria-controls="Exteriors" role="tab" data-toggle="tab">Exteriors </a></li>
                        <li><a href="#View" aria-controls="View" role="tab" data-toggle="tab">View  </a></li>
                        <li><a href="#Layout" aria-controls="Layout" role="tab" data-toggle="tab">Layout  </a></li>
                        <li><a href="#Amenities" aria-controls="Amenities" role="tab" data-toggle="tab">Amenities  </a></li>
                        <li><a href="#Images" aria-controls="Images" role="tab" data-toggle="tab">360 Images  </a></li>-->

                        <!-- <li><a href="#Div2" aria-controls="messages11" role="tab" data-toggle="tab">Messages</a></li>
                                        <li><a href="#Div3" aria-controls="settings11" role="tab" data-toggle="tab">Settings</a></li>-->
                    </ul>
                </div>
                <div class="col-md-9">

                    <div class="tab-content">
                        <?php $ca = 'active'; 
                        foreach($imagecategories as $imagecategory){ ?>
                        <div role="tabpanel" class="tab-pane animated <?php echo $ca?> fadeIn" id="cat<?php echo $imagecategory->id?>">
                            <div role="tabpanel">
                                <ul class="tab-nav last-tab" role="tablist">
                                    <li class="active"><a href="#home<?php echo $imagecategory->id?>" aria-controls="home<?php echo $imagecategory->id?>" role="tab" data-toggle="tab">Phone</a></li>
                                    <li><a href="#profile<?php echo $imagecategory->id?>" aria-controls="profile<?php echo $imagecategory->id?>" role="tab" data-toggle="tab">Tablet</a></li>
                                    <li><a href="#messages<?php echo $imagecategory->id?>" aria-controls="messages<?php echo $imagecategory->id?>" role="tab" data-toggle="tab">Desktop</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home<?php echo $imagecategory->id?>">
                                        <?php $projectimages_p = $project->projectimages()->where('type',0)->where('img_category_id', $imagecategory->id)->get();?>
                                        <?php $imgcount=5;$swipe='swipe';
                                        if($imagecategory->id==1 || $imagecategory->id==2){ 
                                            $imgcount=1;$swipe='noswipe';
                                        }
                                        ?>
                                        <?php foreach ($projectimages_p as $image) { 
                                        $imgpath=url("project_images/".$image->image);    
                                        ?>
                                        <div class="col-md-4 <?php echo $swipe; ?>" id="<?php echo $image->id;?>" style="padding-top:15px;">
                                            <div class="fileinput fileinput-new">
                                                <div class="fileinput-preview thumbnail">
                                                    <img src="<?php echo $imgpath?>">
                                                </div>
                                                <div>
                                                <a href="javascript:void(0)" class="btn btn-danger" onClick="removeimage('<?php echo $image->id?>');">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if(count($projectimages_p) < $imgcount){ ?>
                                            <div class="col-sm-4" style="padding-top:15px;">                                         
                                                <!-- drag drop start -->        
                                                  <div  class="drag-and-drop-zone uploader <?php echo  str_replace(' ', '_', $imagecategory->category)?>_p"  catname="<?php echo $imagecategory->category?>" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_p" cat="<?php echo $imagecategory->id?>" typ="0" pid="<?php echo $project->id?>" paneldiv="home<?php echo $imagecategory->id?>">
                                                    <div>Drag &amp; Drop Images Here</div>
                                                    <div class="or">-or-</div>
                                                    <div class="browser">
                                                      <label>
                                                        <span>Select Image</span>
                                                        <input type="file" name="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_p" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_p_img" accept="image/jpeg"  title='Click to add Images'>
                                                      </label>
                                                    </div>
                                                  </div>
                                                  <div style="display: none;" class="progressbar_<?php echo  str_replace(' ', '_', $imagecategory->category)?>_p" >   
                                                  </div>
                                                <!-- drag drop end -->      
                                            </div>
                                        <?php } ?>        

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile<?php echo $imagecategory->id?>">
                                        <?php $projectimages_t = $project->projectimages()->where('type',1)->where('img_category_id', $imagecategory->id)->get();?>
                                        <?php $imgcount=5;$swipe='swipe';
                                        if($imagecategory->id==1 || $imagecategory->id==2){  
                                            $imgcount=1;$swipe='noswipe';
                                        }
                                        ?>
                                        <?php foreach ($projectimages_t as $image) { 
                                        $imgpath=url("project_images/".$image->image);    
                                        ?>
                                        <div class="col-md-4 <?php echo $swipe; ?>" id="<?php echo $image->id;?>" style="padding-top:15px;">
                                            <div class="fileinput fileinput-new">
                                                <div class="fileinput-preview thumbnail">
                                                    <img src="<?php echo $imgpath?>">
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0)" class="btn btn-danger" onClick="removeimage('<?php echo $image->id?>');">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if(count($projectimages_t) < $imgcount){ ?>
                                        <div class="col-sm-4" style="padding-top:15px;">
                                        
                                            <!-- <form method="post" catname="<?php echo $imagecategory->category?>" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t" cat="<?php echo $imagecategory->id?>" typ="1" pid="<?php echo $project->id?>" paneldiv="profile<?php echo $imagecategory->id?>">    
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                         <span class="fileinput-exists" >Upload</span>
                                                        <input type="file" name="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t">
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </form> -->

                                            <!-- drag drop start -->        
                                                  <div  class="drag-and-drop-zone uploader <?php echo  str_replace(' ', '_', $imagecategory->category)?>_t" catname="<?php echo $imagecategory->category?>" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t" cat="<?php echo $imagecategory->id?>" typ="1" pid="<?php echo $project->id?>" paneldiv="profile<?php echo $imagecategory->id?>">
                                                    <div>Drag &amp; Drop Images Here</div>
                                                    <div class="or">-or-</div>
                                                    <div class="browser">
                                                      <label>
                                                        <span>Select Image</span>
                                                        <input type="file" name="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t_img"  accept="image/jpeg"  title='Click to add Images'>
                                                      </label>
                                                    </div>
                                                  </div>
                                                  <div style="display: none;" class="progressbar_<?php echo  str_replace(' ', '_', $imagecategory->category)?>_t" >   
                                                  </div>
                                                <!-- drag drop end -->

                                        </div>
                                        <?php } ?>    
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="messages<?php echo $imagecategory->id?>" >
                                        <?php $projectimages_d = $project->projectimages()->where('type',2)->where('img_category_id', $imagecategory->id)->get();?>
                                        <?php $imgcount=5;$swipe='swipe';
                                        if($imagecategory->id==1 || $imagecategory->id==2){ 
                                            $imgcount=1;$swipe='noswipe';
                                        }
                                        ?>
                                        <?php foreach ($projectimages_d as $image) { 
                                        $imgpath=url("project_images/".$image->image);    
                                        ?>
                                            <div class="col-md-4 <?php echo $swipe; ?>" id="<?php echo $image->id;?>" style="padding-top:15px;">
                                                <div class="fileinput fileinput-new">
                                                    <div class="fileinput-preview thumbnail">
                                                        <img src="<?php echo $imgpath?>">
                                                    </div>
                                                    <div>
                                                         <a href="javascript:void(0)" class="btn btn-danger" onClick="removeimage('<?php echo $image->id?>');">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if(count($projectimages_d) < $imgcount){ ?>
                                        <div class="col-sm-4" style="padding-top:15px;">
                                          
                                            <!-- <form method="post" catname="<?php echo $imagecategory->category?>" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d" cat="<?php echo $imagecategory->id?>" typ="2" pid="<?php echo $project->id?>" paneldiv="messages<?php echo $imagecategory->id?>">         
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                <div>
                                                    <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Upload</span>
                                                    <input type="file" name="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            </form> -->

                                            <!-- drag drop start -->        
                                                  <div  class="drag-and-drop-zone uploader <?php echo  str_replace(' ', '_', $imagecategory->category)?>_d" catname="<?php echo $imagecategory->category?>" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d" cat="<?php echo $imagecategory->id?>" typ="2" pid="<?php echo $project->id?>" paneldiv="messages<?php echo $imagecategory->id?>">
                                                    <div>Drag &amp; Drop Images Here</div>
                                                    <div class="or">-or-</div>
                                                    <div class="browser">
                                                      <label>
                                                        <span>Select Image</span>
                                                        <input type="file" name="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d" id="<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d_img"  accept="image/jpeg"  title='Click to add Images'>
                                                      </label>
                                                    </div>
                                                  </div>
                                                  <div style="display: none;" class="progressbar_<?php echo  str_replace(' ', '_', $imagecategory->category)?>_d">   
                                                  </div>
                                                <!-- drag drop end -->

                                        </div>
                                        <?php } ?>    

                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php $ca = ''; } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    <div class="col-md-12" style="font-size: 10px;
    font-style: italic !important;
    font-weight: bold;
    letter-spacing: 0.11em; padding-top: 35px;"> 
    <div class="col-md-6"> 
        <div>Phone and Tablet:</div>
    <div>Featured Image: 1024 x 500 (JPG or 24 bit PNG)</div>
    <div>Project Thumbnail: 512 x 512 (32 bit PNG (with alpha)</div>
    <div>Images: Any resolution but with 16:9 aspect ratio</div></div>
    <div class="col-md-6"> 
        <div>Desktop:</div>
    <div>Featured Image: 2048 x 1000 (JPG or 24 bit PNG)</div>
    <div>Project Thumbnail: 512 x 512 (32 bit PNG with alpha)</div>
    <div>Images: Any resolution but with 16:9 aspect ratio</div>
    </div>
    
    </div>
    </div>


    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Error Massage</h4>
          </div>
          <div class="modal-body" id="msgDiv">
            
          </div>
          <div class="modal-footer">
            <button type="button" id="yes_btn" class="btn btn-primary" data-dismiss="modal">Yes</button>
            <button type="button" id="remove_lastimage"  class="btn btn-danger" data-dismiss="modal">No</button>
          </div>
         
        </div>
      </div>
    </div>