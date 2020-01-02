<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $event->title; ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">       
            <div class="row">
                <div class="col-md-12 col-lg-8">  
                    <div class="detail-event">
                        <div class="event-detail-img">
                            <img src="<?php echo UPLOAD_PATH; ?>/event/<?php echo $event->image; ?>" alt="">
                        </div>
                        <div class="event-content">
                            <div class="event-meta">
                                <div class="event-for"><span><?php echo $this->lang->line('event_for'); ?></span>: <?php echo $event->name ? $event->name : $this->lang->line('all'); ?></div>
                                <div class="event-place"><span><?php echo $this->lang->line('event_place'); ?></span>: <?php echo $event->event_place; ?></div>
                                <div class="event-date"><span><?php echo $this->lang->line('start_date'); ?></span>: <i class="far fa-clock"></i> <?php echo date('M j, Y', strtotime($event->event_from)); ?></div>
                                <div class="event-date"><span><?php echo $this->lang->line('end_date'); ?></span>: <i class="far fa-clock"></i> <?php echo date('M j, Y', strtotime($event->event_to)); ?></div>
                                <div class="event-info"><span><?php echo $this->lang->line('event_info'); ?></span>: <?php echo $event->note; ?></div>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="col-md-12 col-lg-4">
                    <section class="right-pane">
                        <h2 class="widget-title"><?php echo $this->lang->line('latest'); ?> <?php echo $this->lang->line('event'); ?></h2>                  

                         <?php if(isset($events) && !empty($events)) { ?>
                            <?php foreach($events as $obj) { ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="single-event-list">
                                    <div class="event-img">
                                        <a href="<?php echo site_url('event-detail'.$obj->id); ?>">
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
                                            <div class="more-link"><a href="<?php echo site_url('event-detail'.$obj->id); ?>" class="btn-link"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a></div>
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