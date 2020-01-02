<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3 class="footer-title"><?php echo $this->lang->line('about'); ?> <?php echo $this->lang->line('school'); ?></h3>
                <div class="footer-text">
                    <?php echo substr($about->page_description, 0, 320); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="q-links">
                    <h3 class="footer-title"><?php echo $this->lang->line('quick_link'); ?></h3>
                    <ul>
                        <li><a href="<?php echo site_url('news'); ?>"><?php echo $this->lang->line('news'); ?></a></li>
                        <li><a href="<?php echo site_url('notice'); ?>"><?php echo $this->lang->line('notice'); ?></a></li>
                        <li><a href="<?php echo site_url('holiday'); ?>"><?php echo $this->lang->line('holiday'); ?></a></li>
                        <li><a href="<?php echo site_url('events'); ?>"><?php echo $this->lang->line('event'); ?></a></li>
                        <li><a href="<?php echo site_url('galleries'); ?>"><?php echo $this->lang->line('gallery'); ?></a></li>
                        <li><a href="<?php echo site_url('admission'); ?>"><?php echo $this->lang->line('admission'); ?></a></li>
                        <li><a href="<?php echo site_url('teachers'); ?>"><?php echo $this->lang->line('teacher'); ?></a></li>
                        <li><a href="<?php echo site_url('staff'); ?>"><?php echo $this->lang->line('staff'); ?></a></li>
                        <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('contact_us'); ?></a></li>
                        <li><a href="<?php echo site_url('terms'); ?>"><?php echo $this->lang->line('terms_and_condition'); ?></a></li>
                        <li><a href="<?php echo site_url('privacy'); ?>"><?php echo $this->lang->line('privacy_policy'); ?></a></li>
                        <li><a href="<?php echo site_url('about'); ?>"><?php echo $this->lang->line('about'); ?></a></li>                    
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="q-links">
                    <h3 class="footer-title"><?php echo $this->lang->line('social_link'); ?></h3>
                    <ul class="social-links">
                        <?php if ($settings->facebook_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->facebook_url; ?>"><i class="fa fa-facebook-square"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->twitter_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->twitter_url; ?>"><i class="fa fa-twitter-square"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->linkedin_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->linkedin_url; ?>"><i class="fa fa-linkedin-square"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->google_plus_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->google_plus_url; ?>"><i class="fa fa-google-plus-square"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->youtube_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->youtube_url; ?>"><i class="fa fa-youtube-square"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->instagram_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->instagram_url; ?>"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if ($settings->pinterest_url) { ?>
                            <li><a target="_blank" href="<?php echo $settings->pinterest_url; ?>"><i class="fa fa-pinterest-square"></i></a></li>
                        <?php } ?>                    
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <h3 class="footer-title"><?php echo $this->lang->line('get_in_touch'); ?></h3>
                <div class="footer-contact-info">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="text"><?php echo $settings->address; ?></div>
                </div>
                <div class="footer-contact-info">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="text padding-top"><?php echo $settings->phone; ?></div>
                </div>
                <div class="footer-contact-info">
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <div class="text padding-top"><?php echo $settings->email; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="col-xl-12">
            <div class="copyright"><?php echo $settings->footer; ?></div>
        </div>
    </div>
</footer>