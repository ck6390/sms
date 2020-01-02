 <script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.table-bordered{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;}.table{width: 100%;max-width: 100%;margin-bottom: 20px;}.table > thead:first-child > tr:first-child > th {border-top: 0px;}.table-bordered > thead > tr > th {border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image: initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.text-center{text-align:center}.col-40{width40%;float:left;}.col-10{width:10%;float:left;padding-left:35%}.clearfix{clear:both;}@page{margin:10;padding:0px;} </style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> <?php echo $this->lang->line('manage'); ?> <?php echo $this->lang->line('merit_list'); ?></small></h3>
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
                <?php echo form_open_multipart(site_url('exam/meritlist/index'), array('name' => 'result', 'id' => 'result', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">  
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('academic_year'); ?> <span class="red">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" required="required" id="academic_year_id">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('academic_year_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
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
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>                    
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <div id="dvContainer">
            <div class="x_content">             
                <div class="row">                                                      
                    <div class="col-sm-4  col-sm-offset-4 layout-box">
                        <p>
                            <div class="print-center">
                                <div class="col-xs-4 col-10">
                                <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                    
                                <?php } else{ ?>
                                   <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                <?php } ?>                                
                                </div>                            
                                <div class="col-xs-8 col-40">
                                    <h4><?php echo $this->gsms_setting->school_name; ?></h4>
                                    <p><?php echo $this->gsms_setting->address; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <h4 class="head-title ptint-title text-center"><small><b> <?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('merit_list'); ?> </b></small></h4>                
                            <?php if(isset($academic_year)){ ?>
                            <div class="text-center"><?php echo $this->lang->line('academic_year'); ?>: <?php echo $academic_year; ?></div>
                            <?php } ?>
                            <div class="text-center">
                            <?php if(isset($class)){ ?>
                            <?php echo $this->lang->line('class'); ?>: <?php echo $class; ?>
                            <?php } ?>
                            <?php if(isset($section)){ ?>
                            , <?php echo $this->lang->line('section'); ?>: <?php echo $section; ?>
                            <?php } ?>
                            </div>
                         </p>
                    </div>
                </div>            
            </div>
            
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped_ table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                            <th><?php echo $this->lang->line('name'); ?></th>
                            <th><?php echo $this->lang->line('photo'); ?></th>                            
                            <th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('subject'); ?></th>                                            
                            <th><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('mark'); ?></th>                                            
                            <th><?php echo $this->lang->line('obtain'); ?> <?php echo $this->lang->line('mark'); ?></th> 
                            <th ><?php echo $this->lang->line('percentage'); ?></th> 
                            <th> <?php echo $this->lang->line('average_grade_point'); ?></th>                                            
                            <th><?php echo $this->lang->line('grade'); ?></th>                                            
                            <th><?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('status'); ?></th>                                            
                            <th ><?php echo $this->lang->line('position_in_section'); ?></th>                                            
                            <th ><?php echo $this->lang->line('position_in_class'); ?></th>   
                            <th><?php echo $this->lang->line('remark'); ?></th>  
                        </tr>
                    </thead>
                     <tbody>   
                            <?php 

                            $count = 1; if(isset($examresult) && !empty($examresult)){ ?>
                                <?php foreach($examresult as $obj){ ?>
                                <?php $class_position = get_position_student_position($academic_year_id, $class_id, $obj->student_id); ?>    
                                <?php $section_position = get_position_student_position($academic_year_id, $class_id,$obj->student_id, $obj->section_id); ?> 
                                <tr>
                                    <td><?php echo $obj->roll_no; ?></td>
                                    <td><?php echo $obj->student; ?></td>
                                    <td>
                                        <?php if ($obj->photo != '') { ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/student-photo/<?php echo $obj->photo; ?>" alt="" width="45" /> 
                                        <?php } else { ?>
                                            <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="45" /> 
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo $obj->id; ?>"  name="students[]" />       
                                    </td>  
                                    <td><?php echo $obj->total_subject; ?></td>
                                    <td><?php echo $obj->total_mark; ?></td>
                                    <td><?php echo $obj->total_obtain_mark; ?></td>
                                    <td><?php echo $obj->total_mark > 0 ? number_format(@$obj->total_obtain_mark/$obj->total_mark*100, 2) : 0; ?>%</td> 
                                    <td><?php echo $obj->avg_grade_point; ?></td>
                                    <td><?php echo $obj->grade; ?></td>
                                    <td><?php echo $this->lang->line($obj->result_status); ?></td>
                                    <td><?php echo $section_position; ?></td> 
                                    <td><?php echo $class_position; ?></td> 
                                    <td><?php echo $obj->remark; ?></td>
                                </tr>
                                <?php } ?>                                        
                            <?php }else{ ?>
                                <tr><td colspan="13" class="text-center"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                            <?php } ?>
                        </tbody>
                </table>                
            </div>  
            
            <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <!-- <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <!-?php echo $this->lang->line('print'); ?></button> -->
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
    $("#result").validate(); 
 
</script>



