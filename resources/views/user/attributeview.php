<div role="tabpanel" class="tab">
    <ul class="tab-nav" role="tablist">
        <?php
        $active = 'active';
        foreach ($attributes as $attributeinfo) {
            $attribute = $attributeinfo->attributes;
            ?>
            <li class="<?php echo $active; ?>"><a href="#attr<?php echo $attribute->id; ?>" aria-controls="attr<?php echo $attribute->id; ?>" role="tab" data-toggle="tab"><?php echo $attribute->name; ?></a></li>
            <?php
            $active = '';
        }
        ?>
    </ul>

    <div class="tab-content room">
        <?php
        $active = 'active in';
        foreach ($attributes as $attributeinfo) {
            $attribute = $attributeinfo->attributes;
            $themes = $attribute->themes;
            //  print_r($themes);
            ?>
            <div role="tabpanel" class="tab-pane animated fadeIn <?php echo $active; ?>" id="attr<?php echo $attribute->id; ?>">
                <ul class="row">

    <?php foreach ($themes as $theme) { ?><li class="col-md-4">
                            <img class="img-responsive" style="max-width:230px;height:auto;" src="<?php echo url('theme_images/' . $theme->image); ?>" />
                            <div class="radio m-b-15">
                                <label>
                                    <input type="radio" checked="" name="attr_<?php echo $attribute->id; ?>" class="selecttheme" value="<?php echo $theme->id; ?>">
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </li>
    <?php } ?>
                </ul>

            </div> 
            <?php
            $active = '';
        }
        ?>
 </div>
</div>
