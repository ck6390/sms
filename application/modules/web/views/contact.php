<section class="page-title-area">
    <div class="container">       
            <?php $this->load->view('layout/message'); ?>       
    </div>
</section>
<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"><h1 class="page-title"><?php echo $this->lang->line('contact_us'); ?></h1></div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div id="map" style="height: 400px; margin-bottom: 30px;"></div>
                <script>
                    function myMap() {
                        var myCenter = new google.maps.LatLng(<?php echo $settings->school_geocode; ?>);
                        var mapCanvas = document.getElementById("map");
                        var mapOptions = {center: myCenter, zoom: 16};
                        var map = new google.maps.Map(mapCanvas, mapOptions);
                        var marker = new google.maps.Marker({position: myCenter});
                        marker.setMap(map);
                        //infowindow.open(map, marker);
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwNfbMeqVjiM6GstU-IfuyXvg0R1F2UaY&callback=myMap"></script>
            </div>
        </div>
    </div>
</section>

<section class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="contact-form">
                    <form action="<?php echo site_url('contact'); ?>" method="post" name="contact" id="contact">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name" class="col-form-label"><?php echo $this->lang->line('first_name'); ?></label>
                                <input type="text" class="form-control" id="first_name" placeholder="<?php echo $this->lang->line('first_name'); ?>" name="first_name" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name" class="col-form-label"><?php echo $this->lang->line('last_name'); ?></label>
                                <input type="text" class="form-control" id="last_name" placeholder="<?php echo $this->lang->line('last_name'); ?>" name="last_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label"><?php echo $this->lang->line('email'); ?></label>
                                <input type="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line('email'); ?>" name="email" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="col-form-label"><?php echo $this->lang->line('phone'); ?></label>
                                <input type="text" class="form-control" id="phone" placeholder="<?php echo $this->lang->line('phone'); ?>" name="phone">
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="comment"><?php echo $this->lang->line('comment'); ?></label>
                                <textarea class="form-control" id="comment" rows="5" name="comment" required="required" placeholder="<?php echo $this->lang->line('comment'); ?>"></textarea>
                            </div>                           
                        </div>                           
                        <button type="submit" class="btn btn-primary" style="margin-left: 16px;"><?php echo $this->lang->line('submit'); ?></button>
                        
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <section class="right-pane">
                    <h2 class="widget-title"><?php echo $this->lang->line('get_in_touch'); ?></h2> 

                    <div class="col-md-12 col-sm-12">
                        <ul>
                            <li>
                                <p><strong><?php echo $this->lang->line('address'); ?>: </strong><?php echo $settings->address; ?></p>
                            </li>
                            <li>
                                <p><strong><?php echo $this->lang->line('email'); ?>: </strong><?php echo $settings->email; ?></p>
                            </li>
                            <li>
                                <p><strong><?php echo $this->lang->line('phone'); ?>: </strong><span><?php echo $settings->phone; ?></span></p>
                            </li>
                            <li>
                                <p><strong><?php echo $this->lang->line('school_fax'); ?>: </strong><?php echo $settings->school_fax; ?></p>
                            </li>
                        </ul>
                    </div> 
                </section>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $('#contact').validate();
</script>