<div class="container">
    <div class="col-md-1">
        <div class="w3-agile-logo">
            <div class=" head-wl">
                <div class="headder-w3">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $settings->logo; ?>" alt="" class="img-responsive" width="120px"/></a>
                </div>                       
            </div>
        </div>
    </div>
                <!-- header -->
    <div class="col-md-11">   
        <div class="row">
            <div class=" tele">                       
                <p><i class="fa fa-envelope"></i> <?php echo $settings->email; ?> | 
                   <i class="fa fa-phone"></i> <?php echo "+91-".$settings->phone; ?>
                </p>
            </div>                       
        </div>
        <br/>
        <div class="row">
            <div class="header-w3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light nav-bg">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav navbar-right menu-list">
                            <li class="active"><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                            <li><a href="<?php echo site_url('admission'); ?>"><?php echo $this->lang->line('admission'); ?></a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('announcement'); ?> <i class="fa fa-angle-down"></i></a>                                       
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('news'); ?>"><?php echo $this->lang->line('news'); ?></a></li>
                                    <li><a href="<?php echo site_url('notice'); ?>"><?php echo $this->lang->line('notice'); ?></a></li>
                                    <li><a href="<?php echo site_url('holiday'); ?>"><?php echo $this->lang->line('holiday'); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo site_url('events'); ?>"><?php echo $this->lang->line('event'); ?></a></li>
                            <li><a href="<?php echo site_url('galleries'); ?>"><?php echo $this->lang->line('gallery'); ?></a></li>
                            <li><a href="<?php echo site_url('teachers'); ?>"><?php echo $this->lang->line('teacher'); ?></a></li>
                            <li><a href="<?php echo site_url('staff'); ?>"><?php echo $this->lang->line('staff'); ?></a></li>
                            <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('contact_us'); ?></a></li>
                             <?php if (logged_in_user_id()) { ?>       
                            <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
                            
                            <li><a href="<?php echo site_url('auth/logout'); ?>"><?php echo $this->lang->line('logout'); ?></a></li>
                            <?php }else{ ?>
                            <li><a href="<?php echo site_url('login'); ?>" target="_new"><?php echo $this->lang->line('login'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>