<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $this->lang->line('about'); ?> <?php echo $this->lang->line('school'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <?php echo $about->page_description; ?>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid img-thumbnail" src="<?php echo UPLOAD_PATH; ?>/page/<?php echo $about->page_image; ?>" alt="">
            </div>      
        </div>
    </div>
</section>