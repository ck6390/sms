<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $this->lang->line('news'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">

        <div class="row">

            <?php if(isset($news_list) && !empty($news_list)) { ?>
                <?php foreach ($news_list as $obj) { ?>
                    <div class="col-md-6 col-lg-6">
                        <article>
                            <div class="news-content">
                                <a href="<?php echo site_url('news-detail/'.$obj->id); ?>">
                                    <img src="<?php echo UPLOAD_PATH; ?>/news/<?php echo $obj->image; ?>" alt="Foto" class="news-listing-img img-fluid">
                                </a>
                                <a href="<?php echo site_url('news-detail/'.$obj->id); ?>"><h2><?php echo $obj->title; ?></h2></a>
                                <div class="news-date"><i class="fa fa-calendar"></i> <?php echo date('M j, Y', strtotime($obj->date)); ?></div>
                                <p>
                                    <?php echo substr($obj->news, 0,120); ?>...
                                </p>
                                <div class="more-link"><a href="<?php echo site_url('news-detail/'.$obj->id); ?>" class="btn-link"><?php echo $this->lang->line('read_more'); ?> <i class="fa fa-long-arrow-right"></i></a></div>
                            </div>                   
                        </article>
                    </div>
                <?php } ?>
             <?php } else { ?>
            <div class="col-md-12 col-sm-12"><?php echo $this->lang->line('no_data_found'); ?></div>
            <?php } ?>
        </div>
    </div>

</section>