<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $notice->title; ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <div class="text-center">
                    <div class="detail-notice"> 
                        <div class="notice-meta">
                            <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($notice->date)); ?></span>
                        </div>
                        <p>
                            <?php echo $notice->notice; ?>
                        </p>
                    </div>

                </div>
            </div>

            <div class="col-md-12 col-lg-4">
                <section class="right-pane">
                    <h2 class="widget-title"><?php echo $this->lang->line('latest'); ?> <?php echo $this->lang->line('notice'); ?></h2>                  

                    <?php if (isset($notices) && !empty($notices)) { ?>
                        <?php foreach ($notices as $obj) { ?>
                            <div class="single-notice">                       
                                <h4><a href="<?php echo site_url('notice-detail/' . $obj->id); ?>"><?php echo $obj->title; ?></a></h4>
                                <div class="notice-meta">
                                    <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date)); ?></span>
                                </div>
                                <p><?php echo substr($obj->notice, 0, 60); ?>...</p>
                                <a href="<?php echo site_url('notice-detail/' . $obj->id); ?>" class="read-more-btn"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </section> 
            </div>

        </div>
    </div>
</section>