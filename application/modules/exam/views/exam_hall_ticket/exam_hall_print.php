<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=6.5in;width=6.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.center{text-align:center!important}.col-40{width:35%;float:left;}.col-10{width:10%;float:left;padding-left:20%}.col-30{width:24%;float:left;}.clearfix{clear:both;}@page{margin:50;padding:0px;}.col-80{width:80%;float:left;}.right-text{text-align:right;}.col-33{width:33.33%;float:left;}.left-text{text-align:left;}.col-60{width:60%;float:left;}.border-top{border-top:2px solid #ddd;}.btn-success{color: #26B99A !important;}.btn-danger{color: #ac2925 !important;}.col-50{width:48%;float:left; padding-right:1%}.invoice-col,.table{font-size:10px;}.margin-left{margin-left:1%;}.border-left{border-left:.5px solid black;}.border-right{border-right:1px solid black;}.col-100{width:100%;float:left;}.border-all{border: 1px solid black;}.border-bottom{  border-bottom: 1px solid balck;}table {border-collapse: collapse; width:100%;margin-top:10px;}table tr, th, td {border: 1px solid  black;padding:5px;font-size:15px;}h3{font-size:22px;}.p-size{font-size:15px;margin-bottom: 2px;}tr-border{border-bottom:2px solid black;}.hall-ticket{border-radius: 20px 20px;background-color:#3D3F94;color: #fff;padding: 5px 0px 5px 0px;}hr{margin: 5px 0px 4px 0px;border-top:1px solid #000;margin-left:2px;} .sign{width:90px;}.rules{width:120px;}.examiner-sign{float:right;margin-top: 60px;}.principal-sign{margin-top: 60px;}.li-size{font-size:12px;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<style type="text/css">
    .btn-success {
        background: #26B99A;
        border: 1px solid #169F85;
    }
    .btn-danger{
        padding: 2px;
    }
    .border-top
    {
        border-top: 1px solid #ddd;
    }
    .border-bottom
    {
        border-bottom: 1px solid #ddd;
    }
    .border-all
    {
        border: 1px solid #ddd;
    }
    .border-right
    {
        border-right: 1px solid #ddd;
    }
	.hall-ticket
    {
        border-radius: 20px 20px;
		background-color:#3D3F94;
        color: #fff;
        padding: 5px 0px 5px 0px;
    }
    .examiner-sign
    {
        float: right;
        margin-top: 40px;
        margin-bottom: 2px;
    }
    .principal-sign
    {
        margin-top: 40px;
        margin-bottom: 2px;
    }
    table
     {
        /*table-layout: fixed;*/
		margin-top:10px;
    }
    hr{
        margin: 5px 0px 10px 0px;
        border-top:1px solid #000;
    }


</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_invoice'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'exam', 'grade')){ ?>
                    <a href="<?php echo site_url('exam/grade/'); ?>"><?php echo $this->lang->line('exam_grade'); ?></a>
                <?php } ?> 
                <?php if(has_permission(VIEW, 'exam', 'exam')){ ?>
                   | <a href="<?php echo site_url('exam/index'); ?>"><?php echo $this->lang->line('exam_term'); ?></a>
                <?php } ?> 
                <?php if(has_permission(VIEW, 'exam', 'schedule')){ ?>
                   | <a href="<?php echo site_url('exam/schedule/index'); ?>"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('schedule'); ?></a>
                <?php } ?> 
                <?php if(has_permission(VIEW, 'exam', 'examhallticket')){ ?>
                   | <a href="<?php echo site_url('exam/examhallticket/view/'); ?>"><?php echo $this->lang->line('exam_hall_ticket'); ?></a>
                <?php } ?> 
                <?php if(has_permission(VIEW, 'exam', 'suggestion')){ ?>
                   | <a href="<?php echo site_url('exam/suggestion/index'); ?>"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('suggestion'); ?> </a>
                <?php } ?> 
                <?php if(has_permission(VIEW, 'exam', 'attendance')){ ?>
                   | <a href="<?php echo site_url('exam/attendance/'); ?>"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('attendance'); ?></a>                    
                <?php } ?> 
            </div>
            <div class="x_content" id="dvContainer">
                
                <section class="content invoice profile_img text-left">
                    <div class="container">
                         <!-- title row -->
                        <div class="row invoice-info">                            
                            <div class="col-sm-12 invoice-header  invoice-col col-100">
                                <div class="col-xs-2 text-right col-30 center margin-left col-md-offset-1">
                                    <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />    
                                                                   
                                    <?php } else{ ?>
                                       <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                    <?php } ?>
                                   
                                </div>
                                <div class="col-xs-6 col-60 ">
                                    <h3 class="text-center">
                                        <span class="border-bottom"><?php echo $this->gsms_setting->school_name; ?></span>
                                        <br/><small><?php echo $this->gsms_setting->address; ?></small>
                                    </h3>
                                </div> 
                                <div class="clearfix"></div>
                                <hr class="col-md-12 mx-auto"/>  
                                <div class="clearfix"></div>
                                <div class="col-sm-6 invoice-header invoice-col col-60">
                                    <p id="" class="text-center center hall-ticket"><font size="4px;">Exam Hall Ticket - <?= ucfirst($exam_hall_tickets->s_exam_name) ?> - (<?= $exam_hall_tickets->s_session_year ?>)</font></p>
                                    <div class="clearfix"></div>
                                    <p class="margin-left p-size"> <strong><?php echo $this->lang->line('student')." ".$this->lang->line('name'); ?> : </strong>
                                    <?php echo $exam_hall_tickets->s_name; ?>
                                    </p>
                                    <p class="margin-left p-size"><strong>Student Id : </strong> 
                                        <?php echo $exam_hall_tickets->s_unique_id; ?>
                                    </p> 
                                    <p class="margin-left p-size"><strong>Roll No. : </strong> 
                                        <?php echo $exam_hall_tickets->s_roll_no; ?>
                                    </p> 
                                    <p class="margin-left p-size"><strong><?php echo $this->lang->line('class'); ?> : </strong> 
                                        <?php echo $exam_hall_tickets->s_class_name; ?>
                                    </p>
                                </div>
                                <div class="col-md-2 col-md-offset-4 col-40 right-text">
                                    <?php if (!empty($exam_hall_tickets->photo)) { ?>
                                     <img src="<?php echo UPLOAD_PATH; ?>/student-photo/<?php echo $exam_hall_tickets->photo; ?>" alt="" style="width: 120px;height: 120px;"/>
                                     <br/>
                                       <?php if (!empty($exam_hall_tickets->signature)) { ?>
                                     <img src="<?php echo UPLOAD_PATH; ?>/student-signature/<?php echo $exam_hall_tickets->signature; ?>" alt="" style="width: 120px;height: 30px;"/>
                                   <?php } } else { ?>
                                         <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" style="width: 150px;height: 150px;"/>
                                    <?php } ?> 
                                </div>
                            </div>

                                                 
                        </div>
                        <!-- info row -->                        
                    </div>
                </section>
                <div class="clearfix"></div>
                <section class="content invoice">
                    <!-- Table row -->
                   
                    <div class="row">
                        <div class="col-xs-12 table">
                            <table class="table table-striped border-all">
                                <thead>                                    
                                    <tr>
                                        <th class="left-text border-right"><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th class="left-text border-right">Exam Date</th>
                                        <th class="left-text border-right">Subjects</th>
                                        <th colspan="2" class="left-text border-right">Time</th>
                                        <!-- <th class="left-text">Room No.</th> -->                                        
                                    </tr>
                                </thead>
                                <tbody>   
                                        <?php 
                                            $exam_date = explode(",", $exam_hall_tickets->s_exam_date);
                                            $subject_name = explode(",", $exam_hall_tickets->s_subject_name);
                                            $start_time = explode(",", $exam_hall_tickets->s_start_time);
                                            $end_time = explode(",", $exam_hall_tickets->s_end_time);
                                            $room_no = explode(",", $exam_hall_tickets->s_room_no);
                                          // echo count($exam_date);
                                            for($i=0; $i< count($exam_date); $i++){                                            
                                        ?>

                                        <tr class="border-bottom">
                                            <td class="border-right"><?php echo $i+1; ?></td>
                                            <td class="border-right"><?= date($this->config->item('date_format'),strtotime($exam_date[$i])); ?></td>
                                            <td class="border-right"><?= $subject_name[$i]; ?></td>
                                            <td colspan="2" class="border-right"><?= $start_time[$i]." - ".$end_time[$i]; ?></td>
                                            <!-- <td><?= $room_no[$i];?></td> -->
                                        </tr> 
                                    <?php } ?>               
                                </tbody>  
                            </table>
                            <div class="col-md-2 text-center">
                                <p class="p-size"><strong>Rules & Regulation</strong></p>
                                <hr class="rules">                               
                            </div>
                            <div class="col-md-12">
                                <ul class="list-unstyled">
									<li class="li-size">1.	Students have to seat on the proper place according to their roll no.Pasted on the desk.</li>
									<li class="li-size">2.	In your answersheet  information on every first page must be filled properly.</li>
									<li class="li-size">3.	Your admit card must be visible on your desk during the entire Exam.</li>
									<li class="li-size">4.	The subject teacher will provide information about the question paper of the respective subject.</li>
									<li class="li-size">5.	You may work on your exam paper until the time allotted for the examination expires.</li>
									<li class="li-size">6.	Any student found of misconduct will be expelled from the examination hall.</li>                                    
                                </ul>
                            </div>
                            <div class="col-md-2 text-center  col-30 principal-sign">
                                <p class="p-size">Principal's Signature</p>
                                <hr class="sign">
                            </div> 
                            <div class="col-md-2 text-center col-30 examiner-sign">
                                <p class="p-size">Exam Co-ordinator</p>
                                <hr class="sign">
                            </div>                                   
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="clearfix"></div>
                 
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>                           
                        </div>
                    </div>
             </section>
            </div>
           
            </div>
        </div>
    </div>
</div>
