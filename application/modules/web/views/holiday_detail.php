<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $holiday->title; ?></h1></div>
        </div>
    </div>
</section>


<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">

                <div class="detail-notice"> 
                    <div class="notice-meta">
                        <div class="notice-meta">
                            <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($holiday->date_from)); ?></span>
                            <i class="fa fa fa-arrows-h"></i>&nbsp;&nbsp;  
                            <span><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($holiday->date_to)); ?></span>
                        </div>
                    </div>
                    <p>
                        <?php echo $holiday->note; ?>
                    </p>                    
                </div>

            </div>
            <div class="col-md-12 col-lg-4">
                <section class="right-pane">
                    <h2 class="widget-title"><?php echo $this->lang->line('latest'); ?> <?php echo $this->lang->line('holiday'); ?></h2> 

                    <?php if (isset($holidays) && !empty($holidays)) { ?>
                        <?php foreach ($holidays as $obj) { ?>
                            <div class="col-md-12 col-sm-12">
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
                    <?php } ?>

                </section>

            </div>
        </div>
    </div>
</section>