<!DOCTYPE html>
<html lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo $title_for_layout; ?></title>
    <!--meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />

    <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
    <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="<?php echo CSS_URL; ?>style.css" rel='stylesheet' type='text/css' media="all">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>flexslider.css" type="text/css" media="screen" />
    <!-- For-News-CSS -->

    <link href="<?php echo CSS_URL; ?>main.css" rel="stylesheet" />
    <!-- For-Portfolio-CSS -->
    <link href="http://fonts.googleapis.com/css?family=Asap+Condensed:400,500,600,700" rel="stylesheet">
    <!--//style sheet end here-->
      <!-- jQuery -->
        <script src="<?php echo JS_URL; ?>modernizr-2.6.2.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery-1.11.2.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
</head>

    <body>
        
        <!--?php $this->load->view('layout/header'); ?-->   

        
        <!-- page content -->
        
        <?php echo $content_for_layout; ?>
        <!-- /page content -->
        
        <!-- footer content -->
        <?php $this->load->view('layout/footer'); ?>   
        <!-- /footer content -->

        <!-- Bootstrap -->
        <script src="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.js"></script>    

        <!--   Start   -->
        
        <script src="<?php echo JS_URL; ?>jquery.zoomslider.min.js"></script>        
        <script src="<?php echo JS_URL; ?>jquery.colorbox-min.js"></script>
        <!-- dataTable with buttons end -->
    
        <!-- Custom Theme Scripts -->
        <script src="<?php echo JS_URL; ?>front-custom.js"></script>   

        <script type="text/javascript">

            jQuery.extend(jQuery.validator.messages, {
                required: "<?php echo $this->lang->line('required_field'); ?>",
                email: "<?php echo $this->lang->line('enter_valid_email'); ?>",
                url: "<?php echo $this->lang->line('enter_valid_url'); ?>",
                date: "<?php echo $this->lang->line('enter_valid_date'); ?>",
                number: "<?php echo $this->lang->line('enter_valid_number'); ?>",
                digits: "<?php echo $this->lang->line('enter_only_digit'); ?>",
                equalTo: "<?php echo $this->lang->line('enter_same_value_again'); ?>",
                remote: "<?php echo $this->lang->line('pls_fix_this'); ?>",
                dateISO: "Please enter a valid date (ISO).",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
        </script>
        <script defer src="<?php echo JS_URL; ?>jquery.flexslider.js"></script>
        <script type="text/javascript">
            $(function() {

            });
            $(window).load(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider) {
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
        <!-- FlexSlider -->

        <!-- Portfolio -->
        <script src="<?php echo JS_URL; ?>/main.js"></script>
        <!-- //Portfolio -->
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="<?php echo JS_URL; ?>move-top.js"></script>
        <script type="text/javascript" src="<?php echo JS_URL; ?>easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event) {
                    event.preventDefault();
                    $('html,body').animate({
                        scrollTop: $(this.hash).offset().top
                    }, 1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->

        <!-- for-bottom-to-top smooth scrolling -->
        <script type="text/javascript">
            $(document).ready(function() {

                $().UItoTop({
                    easingType: 'easeOutQuart'
                });
            });
            $('.carousel').find('.item').first().addClass('active');
            //Menu fixed
            //Menu scroll after fix top
            $(document).on("scroll", function(){
                        if
                      ($(document).scrollTop() > 150){
                          $(".nav-bg").addClass("shrink");
                            //updateSliderMargin();
                        }
                        else
                        {
                            $(".nav-bg").removeClass("shrink");
                            //updateSliderMargin();
                        }
                    });
            /* Navbar close */
          $('#close').click(function(){
            $(this).next('button').slideToggle('500');
            $(this).find('i').toggleClass('fa fa-navicon fa fa-times orange')
        });
        </script>

    </body>
</html>