<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $this->lang->line('gallery'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">

            <?php if (isset($galleries) && !empty($galleries)) { ?>
                <?php foreach ($galleries as $obj) { ?>
                    <div class="col-md-4 col-sm-4">
                        <div class="gallery">
                            <a href="<?php echo site_url('gallery-image/'.$obj->id); ?>">
                                <img src="<?php echo UPLOAD_PATH; ?>/gallery/<?php echo $obj->image; ?>" alt="Lights" style="width:100%">
                            </a>
                            <div class="gallery-title"><a href="<?php echo site_url('gallery-image/'.$obj->id); ?>"><?php echo $obj->title; ?></a></div>                      
                        </div> 
                    </div> 
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-12 col-sm-12"><?php echo $this->lang->line('no_data_found'); ?></div>
            <?php } ?>
        </div>
    </div>
</section>
