<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $this->lang->line('holiday'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row text-center">

            <?php if (isset($holidays) && !empty($holidays)) { ?>
                <?php foreach ($holidays as $obj) { ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-notice">
                            <div class="notice-content">
                                <h3><a href="<?php echo site_url('holiday-detail/'.$obj->id); ?>"><?php echo substr($obj->title,0,35); ?>...</a></h3>
                                <div class="notice-meta">
                                    <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date_from)); ?></span>
                                    <i class="fa fa fa-arrows-h"></i>&nbsp;&nbsp;  
                                    <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date_to)); ?></span>
                                </div>
                                <p><?php echo substr($obj->note, 0,120); ?>...</p>
                                <a href="<?php echo site_url('holiday-detail/'.$obj->id); ?>" class="read-more-btn"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
            <div class="col-md-12 col-sm-12"><?php echo $this->lang->line('no_data_found'); ?></div>
            <?php } ?>
        </div>
    </div>
</section>