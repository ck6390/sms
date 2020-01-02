<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $this->lang->line('notice'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row text-center">
            
            <?php if(isset($notices) && !empty($notices)) { ?>
            <?php foreach($notices as $obj) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="single-notice">                       
                        <h3><a href="<?php echo site_url('notice-detail/'.$obj->id); ?>"><?php echo substr($obj->title,0,35); ?>...</a></h3>
                        <div class="notice-meta">
                            <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date)); ?></span>
                        </div>
                        <p><?php echo substr($obj->notice, 0,120); ?>...</p>
                        <a href="<?php echo site_url('notice-detail/'.$obj->id); ?>" class="read-more-btn"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
             <?php } ?>
            <?php } else { ?>
            <div class="col-md-12 col-sm-12"><?php echo $this->lang->line('no_data_found'); ?></div>
            <?php } ?>
            
        </div>
    </div>
</section>