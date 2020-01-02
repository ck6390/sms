<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Licence Activate | <?php echo SMS;  ?></title>
        <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <!-- Bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">     
        <!-- Custom Theme Style -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
    </head>

    <body class="login">     

        <div class="login_wrapper">
            <section>
                <center>
                   
                </center>
            </section>
            <div class="form login_form">
                <section><h1 class="text-center">Licence Activate</h1></section>    
                <section class="col-md-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <p class="red"><?php echo $this->session->flashdata('error'); ?></p>
                        <p class="green"><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                    <?php echo form_open(site_url('verify'), array('name' => 'verify', 'id' => 'verify','class' => 'form-horizontal'), ''); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label class="" for="email">Email Id</label>                       
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Id">
                        <?php echo form_error('email', '<span class="label label-danger">', '</span>'); ?>
                    </div>                                       
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label class="" for="email">Contact Number</label>                       
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Contact Number">
                        <?php echo form_error('phone', '<span class="label label-danger">', '</span>'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label class="" for="email">Licence Key</label>                       
                        <input type="text" class="form-control" id="licence" name="licence" placeholder="Licence Key">
                        <?php echo form_error('licence', '<span class="label label-danger">', '</span>'); ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="submit" name="submit" value="Activate Now" class="btn btn-primary"/>
                    </div>                    
                    <div class="clearfix"></div>                        
                    <?php echo form_close(); ?>
                </section>
            </div>
        </div>
    </body>
</html>
