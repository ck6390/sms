<!DOCTYPE html>
<html>
<head>      

        <title><?php echo $this->lang->line('generate'); ?> <?php echo $this->lang->line('certificate'); ?></title>
        <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />        
         <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Limelight" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Prosto+One" rel="stylesheet">         
        <!-- Bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">       
        <!-- Custom Theme Style -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
        <script src="<?php echo JS_URL; ?>jquery-1.11.2.min.js"></script>
        <script>
          $(document).ready(function(){
                $("#btnPrint").click(function () {
                    var divContents = $("#dvContainer").html();
                    var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
                    printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.certificate{background: url("<?php echo UPLOAD_PATH; ?>certificate/<?php echo $certificate->background; ?>") no-repeat !important;min-height: 550px;padding: 10%;width: 82%;margin-left: auto;margin-right: auto;background-size: 100% 100% !important;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;text-align: center;}.margin-top{margin-top: 25%;}.left-text{text-align:left;}.right-text{text-align:right;}@page{size: 210mm 191mm;margin:0;padding:0px;} </style>');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                });
            });
       </script>
        <style>
            body {background: #fff;}
            @page { margin: 0; }   
            @media print {
                .certificate {                   
                    background: url("<?php echo UPLOAD_PATH; ?>certificate/<?php echo $certificate->background; ?>") no-repeat !important;    
                    min-height: 550px;
                    padding: 10%;
                    width: 100%;
                    margin-left: auto;
                    margin-right: auto;
                    background-size: 100% 100% !important;
                   -webkit-print-color-adjust: exact !important; 
                    color-adjust: exact !important; 
                    text-align: center;
                }              
            } 
   
            .certificate {
                min-height: 550px;
                margin-left: auto;
                margin-right: auto;
                padding: 80px 120px;
                background: url("<?php echo UPLOAD_PATH; ?>certificate/<?php echo $certificate->background; ?>") no-repeat;    
                background-size: 100% 100%;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                text-align: center;
            } 
            .margin-top
            {
                margin-top: 12%;
            }            

    </style>
    </head>

    <body>
        <div class="x_content" id="dvContainer">
             <div class="row">
                 <div class="col-sm-12">                 
                    <div class="certificate">

                        <div class="certificate-top">
                            <h2 class="top-heading-title"><?php echo $certificate->top_title; ?></h2>
                           <div class="row">
                                <span class="sub-title-img">
                                    <?php if($this->session->userdata('school_logo')){?>               
                                        <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                        
                                    <?php } else{ ?>
                                       <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                    <?php } ?>
                                </span> 
                           </div>
                        </div>

                        <div class="name-ection">
                            <div class="row" >
                                <div class="col-sm-12" style="text-align:center;">
                                    <div class="name-text"><?php echo $certificate->name; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="main-text-block">
                            <p class="main-text">
                                <?php echo $certificate->main_text; ?>
                            </p>
                        </div>
                        <div class="footer-section margin-top">
                            <div class="row" >
                                <div class="col-sm-4 <?php if($certificate->footer_left){ echo 'text-left left-text'; } ?>"><?php echo $certificate->footer_left; ?></div>
                                <div class="col-sm-4 <?php if($certificate->footer_middle){ echo 'text-center'; } ?>"><?php echo $certificate->footer_middle; ?></div>
                                <div class="col-sm-4 <?php if($certificate->footer_right){ echo 'text-right right-text'; } ?>"><?php echo $certificate->footer_right; ?></div>
                            </div>
                        </div>
                    </div>                 
                 </div>
             </div>

            <!-- this row will not appear when printing -->
            <center class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-default hiddens" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                </div>
            </center>
        </div>
    </body>
</html>