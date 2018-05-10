<div role="tabpanel" class="tab">
    <ul class="tab-nav" role="tablist">
        <?php $active = 'active';?>
            <li class="<?php echo $active; ?>"><a href="#attr<?php echo $attribute->id; ?>" aria-controls="attr<?php echo $attribute->id; ?>" role="tab" data-toggle="tab"><?php echo $attribute->name; ?></a></li>   
    </ul>
    <div class="tab-content room">
        <?php
            $active = 'active in';
            $themes = $attribute->themes;
        ?>
            <div role="tabpanel" class="tab-pane animated fadeIn <?php echo $active; ?>" id="attr<?php echo $attribute->id; ?>">
          <ul class="row">
                <?php
                    $attributetheme = $attribute->attributetheme($project_id,$layout_id,$attribute->id);
                ?>
                <input class="form-control input-sm"  value="<?php echo $project_id; ?>" type="hidden" name="pid">
                <input class="form-control input-sm"  value="<?php echo $layout_id; ?>" type="hidden" name="layout_id">
                <input class="form-control input-sm"  value="<?php echo $attribute->id; ?>" type="hidden" name="attribute_id">
                <?php foreach($themes as $theme) { ?><li class="col-md-4">

                            <img class="img-responsive" style="max-width:230px;height:auto;" src="<?php echo url('theme_images/' . $theme->image); ?>" />
                            <div class="radio m-b-15">
                                <label>
                                    <?php if($attributetheme[0]->theme_id==$theme->id){ ?>

                                        <input type="radio" checked="checked" name="theme_id" class="selecttheme" value="<?php echo $theme->id; ?>">

                                    <?php }else{ ?>

                                         <input type="radio"  name="theme_id" class="selecttheme" value="<?php echo $theme->id; ?>">
                                   
                                    <?php } ?>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </li>
                <?php } ?>
                </ul>

            </div> 
           
 </div>
</div>
