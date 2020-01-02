<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $this->lang->line('event'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">

            <?php if(isset($events) && !empty($events)) { ?>
            <?php foreach($events as $obj) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="single-event-list">
                        <div class="event-img">
                            <a href="<?php echo site_url('event-detail/'.$obj->id); ?>">
                                <img src="<?php echo UPLOAD_PATH; ?>/event/<?php echo $obj->image; ?>" alt="">
                            </a>
                        </div>
                        <div class="event-content">
                            <div class="event-meta">
                                <div class="event-title"><?php echo $obj->title; ?></div>
                                <div class="event-for"><span><?php echo $this->lang->line('event_for'); ?></span>: <?php echo $obj->name ? $obj->name : $this->lang->line('all'); ?></div>
                                <div class="event-place"><span><?php echo $this->lang->line('event_place'); ?></span>: <?php echo $obj->event_place; ?></div>
                                <div class="event-date"><span><?php echo $this->lang->line('start_date'); ?></span>: <i class="far fa-clock"></i> <?php echo date('M j, Y', strtotime($obj->event_from)); ?></div>
                                <div class="event-date"><span><?php echo $this->lang->line('end_date'); ?></span>: <i class="far fa-clock"></i> <?php echo date('M j, Y', strtotime($obj->event_to)); ?></div>
                            </div>
                            <div class="more-link"><a href="<?php echo site_url('event-detail/'.$obj->id); ?>" class="btn-link"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a></div>
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