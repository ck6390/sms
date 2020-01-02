<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $news->title; ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">

        <div class="row">
             <div class="col-md-12 col-lg-8"> 
            <article>
                <div class="news-content">                   
                        <img src="<?php echo UPLOAD_PATH; ?>/news/<?php echo $news->image; ?>" alt="Foto" class="img-fluid">                  
                    <div class="news-date"><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($news->date)); ?></div>
                    <p>
                       <?php echo $news->news; ?>
                    </p>                   
                </div>                   
            </article>
        </div>

            <div class="col-md-12 col-lg-4">
                <section class="right-pane">
                    <h2 class="widget-title"><?php echo $this->lang->line('latest'); ?> <?php echo $this->lang->line('news'); ?></h2>                  

                    <?php if (isset($news_list) && !empty($news_list)) { ?>
                        <?php foreach ($news_list as $obj) { ?>
                            <article>
                                <div class="news-content">
                                    <a href="<?php echo site_url('news-detail/' . $obj->id); ?>">
                                        <img src="<?php echo UPLOAD_PATH; ?>/news/<?php echo $obj->image; ?>" alt="Foto" class="img-fluid">
                                    </a>
                                    <a href="<?php echo site_url('news-detail/' . $obj->id); ?>"><h3><?php echo $obj->title; ?></h3></a>
                                    <div class="news-date"><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date)); ?></div>                                    
                                    <div class="more-link"><a href="<?php echo site_url('news-detail/' . $obj->id); ?>" class="btn-link"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a></div>
                                </div>                   
                            </article>
                        <?php } ?>
                    <?php } ?>
                </section> 
            </div>
        </div>
    </div>
</section>