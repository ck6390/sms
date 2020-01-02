<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $this->lang->line('login'). ' | ' . SMS;  ?></title>
        <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <!-- bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- font-awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">     
        <!-- custom-theme -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
        <style>
            
            .bck-img
            {
               background: #154465;
               height: 400px;
            }
             .section_1
             {
                background-color: #e4e0e0;
                box-shadow: -1px 0px 9px 0px rgba(0,0,0,0.75);
                margin-bottom: 18px;
                border: 1px solid #1b1818;
                transition: all 0.9s ease-in-out; 
            }
             .section_1:hover
             {
               transform: scale(0.9);  

             }
             .img_sec1
             {
                height: 90px;
                width: 90px;
                border-radius: 50%;
                margin-top: 20px;

             }
             .section_1 a
             {
                text-decoration: none!important;
             }
             .login-text
             {
                margin: -25px 0 30px!important;
             }
            
        </style>
    </head>

    <body class="login bck-img">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="form login_form">
                    <section class="login_content">
                         <h1 class="login-text">LOGIN PAGE</h1>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <p class="red"><?php echo $this->session->flashdata('error'); ?></p>
                            <p class="green"><?php echo $this->session->flashdata('success'); ?></p>
                        </div>

                        <div class="row col-row">
                            <div class="col-md-6 ">
                                <a href="<?php echo site_url('welcome/login') ?>"><div class="col-md-12  section_1">
                                <img class="img_sec1" src="<?php echo IMG_URL; ?>super_admin_icon.png" >
                                 <h4>Superadmin</h4>
                              </div></a>
                            </div>
                            <div class="col-md-6 ">
                                <a href="<?php echo site_url('welcome/login') ?>"><div class="col-md-12  section_1">
                                    <img class="img_sec1" src="<?php echo IMG_URL; ?>admin_icon.png" >
                                  <h4>Admin</h4></a>
                                </div>
                            </div>

                             <div class="col-md-6 ">
                                <a href="<?php echo site_url('welcome/login') ?>"><div class="col-md-12  section_1">
                                    <img class="img_sec1" src="<?php echo IMG_URL; ?>accountent.png" >
                                   <h4>Accountant</h4>
                                </div></a>
                            </div>
                             
                            <div class="col-md-6 ">
                                <a href="<?php echo site_url('welcome/login') ?>"><div class="col-md-12  section_1">
                                <img class="img_sec1" src="<?php echo IMG_URL; ?>librarian.jpg" >
                               <h4>Librarian</h4>
                              </div></a>
                            </div>
                        </div>
                        
                        <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <p>©<?php echo date('Y'); ?> All Rights Reserved. Fillip Technologies.</p>
                                </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                              <img src="<?php echo IMG_URL; ?>labrary.jpg" width="150" height="150">
                            </div>
                            <div class="col-md-6">
                                <img src="<?php echo IMG_URL; ?>labrary.jpg" width="150" height="150">
                            </div>
                        </div> -->
                        <!-- <?php echo form_open(site_url('auth/login'), array('name' => 'login', 'id' => 'login'), ''); ?>
                            <h1><?php echo $this->lang->line('login'); ?></h1>
                            <div class="form-group">
                                <label>User Id - admin@admin.com</label>
                                <input type="text" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>">
                                <?php echo form_error('email', '<span class="label label-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Password - Admin_123</label>
                                <input type="password" name="password" class="form-control" id="inputSuccess2" placeholder="<?php echo $this->lang->line('password'); ?>">
                                <?php echo form_error('password', '<span class="label label-danger">', '</span>'); ?>
                            </div>

                            <div class="col-xs-12">
                                <input type="submit" name="submit" value="<?php echo $this->lang->line('login'); ?>" class="btn btn-default"/>
                            </div>
                     
                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Forgot Password?
                                    <a href="#signup" class="to_register"> Click Here! </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><img src="<?php echo IMG_URL; ?>logo.png" alt="logo" class="img-circle img-thumbnail" title="Fillip Technologies" width="100px" /></h1>
                                    <p>©<?php echo date('Y'); ?> All Rights Reserved. Fillip Technologies.</p>
                                </div>
                            </div>
                        <?php echo form_close(); ?> -->
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
