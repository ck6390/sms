<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12"><h1 class="page-title"><?php echo $this->lang->line('teacher'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">

            <?php if (isset($teachers) && !empty($teachers)) { ?>
                <?php foreach ($teachers as $obj) { ?>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class=" profile-details">                       
                            <div class="text-center">
                                <?php  if($obj->photo != ''){ ?>
                                <img src="<?php echo UPLOAD_PATH; ?>/teacher-photo/<?php echo $obj->photo; ?>" alt="" width="120" class="img-circle img-responsive"/> 
                                <?php }else{ ?>
                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="120" class="img-circle img-responsive"/> 
                                <?php } ?>
                            </div>
                            <h4><?php echo $obj->name; ?></h4>                          
                            <h5><?php echo $obj->responsibility; ?></h5>                          
                            <ul class="list-unstyled">
                                <li><div  class="left-part"><i class="fa fa-map-marker"></i></div> <div  class="right-part"><?php echo $obj->present_address; ?></div></li>
                                <li><div class="left-part"><i class="fa fa-phone"></i></div> <div  class="right-part"><?php echo $obj->phone; ?></div></li>
                                <li><div class="left-part"><i class="fa fa-envelope"></i></div> <div  class="right-part"><?php echo $obj->email; ?></div></li>
                                <li><div class="left-part"><i class="fa fa-tint"></i></div> <div class="right-part"><?php echo $this->lang->line($obj->blood_group); ?></div></li>
                            </ul> 

                            <ul class="social">
                                <?php if($obj->facebook_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->facebook_url; ?>"><i class="fa fa-facebook-square"></i></a></li>
                                <?php } ?>
                                <?php if($obj->linkedin_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->linkedin_url; ?>"><i class="fa fa-linkedin-square"></i></a></li>
                                <?php } ?>
                                <?php if($obj->google_plus_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->google_plus_url; ?>"><i class="fa fa-google-plus-square"></i></a></li>
                                <?php } ?>
                                <?php if($obj->instagram_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->instagram_url; ?>"><i class="fa fa-instagram"></i></a></li>
                                <?php } ?>
                                <?php if($obj->pinterest_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->pinterest_url; ?>"><i class="fa fa-pinterest-square"></i></a></li>
                                <?php } ?>
                                <?php if($obj->twitter_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->twitter_url; ?>"><i class="fa fa-twitter-square"></i></a></li>
                                <?php } ?>
                                <?php if($obj->youtube_url){ ?>
                                <li><a target="_blank" href="<?php echo $obj->youtube_url; ?>"><i class="fa fa-youtube-square"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-12 col-sm-12"><?php echo $this->lang->line('no_data_found'); ?></div>
            <?php } ?>
        </div>
    </div>
</section>
