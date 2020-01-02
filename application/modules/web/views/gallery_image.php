<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $gallery->title; ?></h1></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <?php echo $gallery->note; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">    
                <?php foreach ($images as $obj) { ?>
                    <div class="col-md-4 col-sm-4 gallery-img">                
                        <a class="group4" href="<?php echo UPLOAD_PATH; ?>/gallery/<?php echo $obj->image; ?>">
                            <img src="<?php echo UPLOAD_PATH; ?>/gallery/<?php echo $obj->image; ?>" alt="<?php echo $obj->caption; ?>" style="width:100%">
                        </a>
                    </div> 
                <?php } ?>

            </div>

            <div class="col-md-4 col-lg-4">
                <section class="right-pane">
                    <h2 class="widget-title"><?php echo $this->lang->line('latest'); ?> <?php echo $this->lang->line('gallery'); ?></h2> 
                    <?php if (isset($galleries) && !empty($galleries)) { ?>
                        <?php foreach ($galleries as $obj) { ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="gallery">
                                    <a href="<?php echo site_url('gallery-image/'.$obj->id); ?>">
                                        <img src="<?php echo UPLOAD_PATH; ?>/gallery/<?php echo $obj->image; ?>" alt="Lights" style="width:100%">
                                    </a>
                                    <div class="gallery-title"><a href="<?php echo site_url('gallery-image/'.$obj->id); ?>"><?php echo $obj->title; ?></a></div>                      
                                </div> 
                            </div> 
                        <?php } ?>
                    <?php } ?>
                </section>
            </div>

        </div>
    </div>
</section>
