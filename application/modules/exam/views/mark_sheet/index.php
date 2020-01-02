 <script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none!important}.address{margin-top:-35px;}.logo{margin-left:-435px;}.table-bordered{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);font-size:11px;border-image:initial;}.table{width: 100%;max-width: 100%;margin-bottom:20px;}.table > thead:first-child > tr:first-child > th {border-top: 0px;}.table-bordered > thead > tr > td {border-width: 1px;border-style: solid;margin-top:10px;border-color: rgb(0, 0, 0);border-image: initial;line-height: 1.42857;vertical-align: top;padding: 3px;}.bcolor{background-color:#e5e5e5;}.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image:initial;line-height: 1.42857;vertical-align: top;padding: 2px;}.bcolor{background-color:#e5e5e5;}.center{text-align:center}.col-40{width:40%;float:left;}.col-10{width:10%;float:left;padding-left:35%;}.col-90{width:55%;float:left;}.col-30{width:25%;float:left;line-height:28px}.clearfix{clear:both;}@page{margin:42px;padding:10px;}.table-bordered > thead > tr > td {border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image: initial;line-height: 1.42857;vertical-align: top;padding:2px;}.watermark{background: url(http://192.168.2.50/chandan/Ganga_live/assets/logs/SGI.png);background-size: 3% 3%;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<style type="text/css">
.signature {
    height: 60px;
    text-align: center;
    vertical-align: bottom !important;
}
.issuedate {
    height: 40px;
    vertical-align: bottom !important;
    padding-bottom: 4px;
}
.table-bordered tbody tr td
{
    border: 1px solid #1d1717c9 !important;
}
.table-bordered thead tr td
{
    border: 1px solid #1d1717c9 !important;
}
.watermark{
    background: url(http://192.168.2.50/chandan/Ganga_live/assets/logs/SGI.png);
    background-size: 3% 3%;
}
.innerwatermark{
    background: url(http://192.168.2.50/chandan/Ganga_live/assets/logs/SGI.png);
    background-size: 9% 9%;
}
.bcolor{
    background-color: #e5e5e5;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('mark_sheet'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link no-print">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'exam', 'mark')){ ?>
                    <a href="<?php echo site_url('exam/mark'); ?>"><?php echo $this->lang->line('manage_mark'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'examresult')){ ?>
                   | <a href="<?php echo site_url('exam/examresult'); ?>"><?php echo $this->lang->line('exam_term'); ?> <?php echo $this->lang->line('result'); ?></a>                 
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'finalresult')){ ?>
                   | <a href="<?php echo site_url('exam/finalresult'); ?>"><?php echo $this->lang->line('exam_final_result'); ?></a>                 
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'meritlist')){ ?>
                   | <a href="<?php echo site_url('exam/meritlist'); ?>"><?php echo $this->lang->line('merit_list'); ?></a>                 
                <?php } ?>   
                <?php if(has_permission(VIEW, 'exam', 'marksheet')){ ?>
                   | <a href="<?php echo site_url('exam/marksheet'); ?>"><?php echo $this->lang->line('mark_sheet'); ?></a>
                <?php } ?>
                 <?php if(has_permission(VIEW, 'exam', 'resultcard')){ ?>
                   | <a href="<?php echo site_url('exam/resultcard'); ?>"><?php echo $this->lang->line('result_card'); ?></a>
                <?php } ?>   
                <?php if(has_permission(VIEW, 'exam', 'mail')){ ?>
                   | <a href="<?php echo site_url('exam/mail'); ?>"><?php echo $this->lang->line('mark_send_by_email'); ?></a>                    
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'text')){ ?>
                   | <a href="<?php echo site_url('exam/text'); ?>"><?php echo $this->lang->line('mark_send_by_sms'); ?></a>                  
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'resultemail')){ ?>
                   | <a href="<?php echo site_url('exam/resultemail/index'); ?>"> <?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('email'); ?></a>                    
                <?php } ?>
                <?php if(has_permission(VIEW, 'exam', 'resultsms')){ ?>
                   | <a href="<?php echo site_url('exam/resultsms/index'); ?>"> <?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('sms'); ?></a>                  
                <?php } ?>
            </div>

            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('exam/marksheet/index'), array('name' => 'marksheet', 'id' => 'marksheet', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">                    
                   
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('academic_year'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required" onchange="get_exam_by_academic_year(this.value)">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('exam'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="exam_id" id="exam_id"  required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($exams as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($exam_id) && $exam_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                        </div>
                    </div>
                    
                    <?php if($this->session->userdata('role_id') != STUDENT ){ ?>    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class(this.value,'');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id" required="required" onchange="get_student_by_section(this.value,'');">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('student'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="student_id" id="student_id" required="required">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('student_id'); ?></div>
                        </div>
                    </div>
                    <?php } ?>    
                   
                
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

           <?php  if (isset($student) && !empty($student)) { ?>
        <div id="dvContainer">
            <div class="x_content">             
                <div class="row">
                    <div class="col-sm-12 layout-box col-100">
                        <p class="school">
                            <div class="center">
                                <div class="col-xs-12 col-100">
                                    <?php if($this->session->userdata('school_logo')){?>               
                                        <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" style="float:left;margin:-10px 20px; 15px 0px;"/>
                                        
                                    <?php } else{ ?>
                                       <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="180px" style="float:left;margin-left:20px;">
                                    <?php } ?>                               
                                
                                        <p class="sname"><span style="margin-top:0px;font-size:40px;"><?php echo $this->gsms_setting->school_name; ?></span><br/><b><?php echo $this->gsms_setting->address; ?></b></p>
                                </div>
                             </div>                            
                        </p>
                    </div>
                </div> 
                <div class="clearfix"></div>
            </div>
             
            
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap tableclass watermark" cellspacing="0" width="100%" style="border">
                    <thead>
                        <tr>
                            <td colspan="3" class="bcolor" style="text-align: center; font-size:20px;">
                                <strong>REPORT CARD</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:15px;">
                                <b><?php echo $this->lang->line('name'); ?> :- 
                                <?php echo $student->name; ?></b>
                            </td>
                            <td style="font-size:15px;">
                                <b><?php echo $this->lang->line('class'); ?> :- 
                                <?php echo $student->class_name; ?></b>
                            </td>
                            <td style="font-size:15px;">
                                <b><?php echo $this->lang->line('exam'); ?> :-
                                <?php echo $exam->title; ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:15px;">
                                <b><?php echo $this->lang->line('admission_no'); ?> :- 
                                <?php echo $student->admission_no; ?></b>
                            </td>
                            <td style="font-size:15px;"><b><?php echo $_SESSION['running_year'];?></b></td>
                            <td style="font-size:15px;"><b>MARKS OBTAINED</b></td>
                        </tr>

                        <tr>
                            <td style="font-size:18px;"><b><?php echo $this->lang->line('subject'); ?></b></th>
                            <td style="text-align:center;font-size: 18px;"><b>Full Marks</b></th>
                            <td style="text-align:center;font-size: 18px;"><b>
                                <?php echo $this->lang->line('obtain');?> 
                                <?php echo $this->lang->line('mark').'s';?></b>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="fn_mark">   
                        <?php
                        $count = 1;
                        if (isset($subjects) && !empty($subjects)) {
                            $total_marks = 0;
                            $obtain_total_marks = 0;
                            ?>
                            <?php foreach ($subjects as $obj) { ?>
                            <?php  $attendance = get_exam_attendance($obj->student_id, $this->academic_year_id, $obj->exam_id, $obj->class_id, $obj->section_id, $obj->subject_id);
                            ?>

                            <?php $lh = get_lowet_height_mark($exam_id, $class_id, $section_id, $obj->subject_id ); ?>
                            <?php $position = get_position_in_subject($exam_id, $class_id, $section_id, $obj->subject_id , $obj->obtain_total_mark); 
                                $total_marks = $obj->exam_total_mark + $total_marks;
                                $obtain_total_marks = $obj->obtain_total_mark + $obtain_total_marks;
                                if(!empty($obj->remark)){
                                    $remark = $obj->remark;
                                }
                                if($obj->subject_type != 'co-curricular' && $obj->subject != ''){
                                ?>
                                <tr>
                                    <td style="font-size:13px;"><b><?php echo ucfirst($obj->subject); ?></b></td>
                                    <td style="text-align:center;font-size:13px;"><b><?php echo $obj->exam_total_mark; ?></b></td>
                                    <td style="text-align:center;font-size:13px;"><b>
                                        <?php echo ($attendance == 1)?$obj->obtain_total_mark : 'A'; ?></b>
                                    </td>            
                                </tr>
                            <?php } } ?>
                        <?php }else{ ?>
                                <tr>
                                    <td colspan="17" align="center" style="font-size:15px;"><?php echo $this->lang->line('no_data_found'); ?></td>
                                </tr>
                        <?php } ?>
                        <tr>
                            <td style="font-size:15px;" ><b>Teamwise Total / Grand Total</b></td>
                            <td style="text-align:center;font-size:15px;"><b><?php echo !empty($total_marks)?$total_marks: '';?></b></td>
                            <td style="text-align:center;font-size:15px;"><b><?php echo !empty($obtain_total_marks)?$obtain_total_marks:'';?></b></td>
                        </tr>
                        <tr>
                            <td style="font-size:15px;"><b>Attendance Percentage</b></td>
                            <td style="text-align: center;font-size: 15px;"><b><?php echo @$remark;?></b></td>
                            <td></td>
                        </tr>
                        <?php 
                        if (isset($subjects) && !empty($subjects)) {?>
                        <tr>
                                <td colspan="3" style="font-size: 15px;background-color:#e5e5e5;">
                                    <strong>Co-Curricular Activity/Personal or Social Qualities</strong> 
                                </td>
                            </tr>
                        <?php  $grades = get_grades();
                            foreach ($subjects as $obj_curricular) { 
                                if($obj_curricular->subject_type == 'co-curricular'){
                        ?>
                                <tr>
                                    <td><b><?php echo ucfirst($obj_curricular->subject); ?></b></td>
                                    <td style="text-align: center;"><b><?php echo @$grades[$obj_curricular->grade_id]; ?></b></td>
                                    <td></td>
                                </tr>
                             <?php
                                } 
                            }
                        }
                        ?>
                            <tr>
                                <td colspan="3" class="bcolor" style="background-color:#e5e5e5;font-size:15px;">
                                    <strong>Evaluation in Regards to Co-Curricular Activities , Interest, Personal, Characteristics</strong> 
                                </td>
                            </tr>
                            <tr >
                                <td colspan="3">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive innerwatermark" cellspacing="0" width="100%" style="margin:0px;">
                                        <tr>
                                            <td width="10px;" style="text-align:center;"><b>Grade</b></td>
                                            <td colspan="2"><b>Performance Level</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;"><b>A</b></td>
                                            <td colspan="2"><b>Very Good</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;"><b>B</b></td>
                                            <td colspan="2"><b>Good</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;"><b>C</b></td>
                                            <td colspan="2"><b>Satisfactory</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;"><b>D</b></td>
                                            <td colspan="2"><b>Fair</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;"><b>E</b></td>
                                            <td colspan="2"><b>Poor</b></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            

                       


                        <tr>
                            <td colspan="3"><b>Class Teacher's Remarks:-</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="height: 20px;"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="height: 20px;"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="height: 20px;"></td>
                        </tr>

                        <tr>
                            <td style="height: 40px; text-align: center; vertical-align: bottom;padding-bottom:0px;">
                                <b>Parents's Signature</b>
                            </td>
                            <td style="height: 40px; text-align: center; vertical-align: bottom;padding-bottom:0px;">
                                <b>Teacher's Signature</b>
                            </td>
                            <td style="height: 40px; text-align: center; vertical-align: bottom;padding-bottom:0px;">
                                <b>Principal's Signature</b>
                            </td>
                        </tr>
                        <tr>
                            <!-- <td style="height: 15px; vertical-align: bottom; padding-bottom: 2px;" colspan="2"> -->
                                <!-- Promotion:-
                            </td> -->
                            <td colspan="3" style="height: 15px; vertical-align: bottom; padding-bottom: 2px;">
                                Issue Date :-
                            </td>
                        </tr>
                    </tbody>
                </table>             
            </div> 
            <?php } ?>

            <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default hiddens" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                </div>
            </div>
        </div>
            <div class="col-md-12 col-sm-12 col-xs-12 no-print">
                <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('mark_sheet_instruction'); ?></div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">     
  
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>
    
    function get_section_by_class(class_id, section_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });         
    }
 
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_student_by_section('<?php echo $section_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_section(section_id, student_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {section_id: section_id, student_id: student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });         
    }
    
    <?php if(isset($academic_year_id) && isset($exam_id)){ ?>
        get_exam_by_academic_year('<?php echo $academic_year_id; ?>', '<?php echo $exam_id; ?>');
    <?php } ?>
    
    function get_exam_by_academic_year(academic_year_id, exam_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_academic_year'); ?>",
            data   : {academic_year_id: academic_year_id, exam_id: exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#exam_id').html(response);
               }
            }
        });         
    }
 
  $("#marksheet").validate(); 
</script>