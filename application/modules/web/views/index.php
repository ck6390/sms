   <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
         <div class="carousel-inner">
        <?php foreach($sliders as $obj){ 
            //var_dump($obj->image);
            //die();
        ?>           
          <div class="item">
            <img src="<?php echo "assets/uploads/slider/{$obj->image}" ?>" alt="Los Angeles" class="img-responsive">
            <div class="carousel-caption">
           
            </div>
          </div>
          <?php } ?>
        </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
          <div class="slide-layer"></div>
    </div>
<div class="container navbar-fixed-top">
    <?php $this->load->view('layout/header'); ?> 
</div>
<section class="content-area">
    <div class="container">
        <div class="row about-area">
            <div class="col-12"><div class="site-title"><h1><?php echo $about->page_title; ?></h1></div></div>
            <div class="col-lg-6">
                <?php echo $about->page_description; ?>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid img-thumbnail" src="<?php echo UPLOAD_PATH; ?>/page/<?php echo $about->page_image; ?>" alt="">
            </div>
        </div>

        <?php if(isset($notices) && !empty($notices)){ ?>
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="site-title">
                    <h2><?php echo $this->lang->line('notice'); ?></h2>
                </div>
            </div>

           <?php foreach($notices as $obj){ ?> 
            <div class="notice-single col-lg-4">                
                <div class="notice-title">
                    <h2><?php echo $obj->title; ?></h2>
                    <h3><i class="fa fa-calendar"></i>  <?php echo date('M j, Y', strtotime($obj->date)); ?> </h3>
                </div>
                <div>
                    <p><?php echo substr($obj->notice, 0,120); ?>...</p>
                </div>
                <div class="more-link"><a href="<?php echo site_url('notice-detail'); ?>" class="btn-link"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a></div>
            </div>
           <?php } ?>                
        </div>
        <?php } ?>
        
    </div>
</section>

 <?php if(isset($events) && !empty($events)){ ?>
    <section id="events" class="event-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="site-title">
                    <h2><?php echo $this->lang->line('event'); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container service_container">
        <div class="row text-center justify-content-center">
            <?php foreach($events as $obj){ ?> 
                <div class="col-md-4 col-sm-6">
                    <div class="single-event-list">
                        <div class="event-img">
                            <a href="<?php echo site_url('event-detail/'.$obj->id); ?>"><img src="<?php echo UPLOAD_PATH; ?>/event/<?php echo $obj->image; ?>" alt=""></a>
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
        </div>
    </div>
</section>
<?php } ?>

