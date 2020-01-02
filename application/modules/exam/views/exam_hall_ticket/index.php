<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-thumb-tack"></i><small> <?php echo $this->lang->line('exam_hall_ticket'); ?> </small></h3>
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
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($exam_hall_ticket)){ echo 'active'; }?>"><a href="#tab_schedule_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('exam_hall_ticket'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'exam', 'examhallticket')){ ?>
                            <li  class=""><a href="#tab_add_schedule"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('exam_hall_ticket'); ?></a> </li>                          
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_schedule"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('schedule'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_schedule"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('schedule'); ?></a> </li>                          
                        <?php } ?>  
                            <li class="li-class-list">
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_subject_list_by_class(this.value);">
                                    <option value="<?php echo site_url('exam/examhallticket/index/'); ?>">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if($this->session->userdata('role_id') == STUDENT && $this->session->userdata('class_id') == $obj->id){ ?>
                                            <option value="<?php echo site_url('exam/examhallticket/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') != STUDENT){ ?>
                                            <option value="<?php echo site_url('exam/examhallticket/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php } ?> 
                                    
                                    <?php } ?>                                            
                                </select>
                            </li> 
                    </ul>
                    <br/>
                    
                    <div class="tab-content"> 
                        <div  class="tab-pane fade in <?php if(isset($exam_hall_ticket)){ echo 'active'; }?>" id="tab_schedule_list">    
                           <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('sl_no'); ?></th>
                                            <th><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('title'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('name'); ?></th>                                       
                                            <th>Student Id</th>
                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                            <th><?php echo $this->lang->line('action'); ?></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <?php 
                                        //  var_dump($exam_hall_ticket);
                                        $count = 1; if(isset($exam_hall_ticket) && !empty($exam_hall_ticket)){ ?>
                                            <?php foreach($exam_hall_ticket as $obj){ ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $obj->s_exam_name; ?></td>
                                                <td><?php echo $obj->s_class_name." - [".$obj->s_class_numeric_name."]"; ?></td>
                                                <td><?php echo $obj->s_name; ?></td>
                                                <td><?php echo $obj->s_unique_id; ?></td>
                                                <td><?php echo $obj->s_roll_no; ?></td>
                                                <td>
                                                    <?php if(has_permission(VIEW, 'exam', 'examhallticket')){ ?>
                                                        <a  href="<?php echo site_url('exam/examhallticket/exam_hall_ticket_print/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'exam', 'examhallticket')){ ?>
                                                        <a href="<?php echo site_url('exam/examhallticket/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('conirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End first tab -->                  
                        <div  class="tab-pane fade in" id="tab_add_schedule">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('exam/examhallticket/check_fee'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('exam'); ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="exam_id" id="exam_id" required="required">
                                         <option>--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($exams as $exam ){ ?>
                                            <option value="<?php echo $exam->id; ?>" <?php echo isset($post['exam_id']) && $post['exam_id'] == $exam->id ?  'selected="selected"' : ''; ?>><?php echo $exam->title; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id" id="class_id" required="required">
                                            <option>--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('academic/classes/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="payment_status" id="payment_status" required="required">
                                            <option value="paid">paid</option>                                    
                                            <option value="unpaid">unpaid</option>                                    
                                        </select>
                                        <div class="help-block"><?php echo form_error('payment_status'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">  
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="student_id"  id="student_id" required="required" >
                                                                                                                                    
                                         </select>
                                         <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                     </div>
                                </div>                            
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url(); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                <?php 
                                    if(!empty($fee_msg))
                                    {
                                        echo "<h3 class='text-danger text-center'>$fee_msg</h3>";
                                    }
                                ?>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_exam_schedule_instruction'); ?></div>
                                </div>
                            </div>


                        </div>  
                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
         
    function get_schedule_modal(schedule_id){
         
        $('.fn_schedule_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('exam/schedule/get_single_schedule'); ?>",
          data   : {schedule_id : schedule_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_schedule_data').html(response);
             }
          }
       });
    }
</script>


 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <link href="<?php echo VENDOR_URL; ?>timepicker/timepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>timepicker/timepicker.js"></script>
 <script type="text/javascript">
     
  $('#add_exam_date').datepicker();  
  $('#add_start_time').timepicker();
  $('#add_end_time').timepicker();
  
  $('#edit_exam_date').datepicker();
  $('#edit_start_time').timepicker();
  $('#edit_end_time').timepicker();
  
  
    <?php if(isset($edit)){ ?>
        get_subject_by_class('<?php echo $schedule->class_id; ?>', '<?php echo $schedule->subject_id; ?>', true);
    <?php } ?>
        
    <?php if(isset($class_id)){ ?>
        get_subject_by_class('<?php echo $class_id; ?>', '', false);
    <?php } ?>
    
    function get_subject_by_class(class_id, subject_id, is_edit){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : { class_id : class_id,  subject_id : subject_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  //if(is_edit){
                        $('#edit_subject_id').html(response);
                   //}else{
                      //$('#add_subject_id').html(response); 
                   //}
               }
            }
        });                  
        
   }
  
</script>
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true
          });
        });
        
        function get_subject_list_by_class(url){          
           if(url){
               window.location.href = url; 
           }
        }
    $("#add").validate();     
    $("#edit").validate(); 
</script>

<script type="text/javascript">
      $("#class_id").change(function()
        {
        var class_id=$(this).val().toString();
           
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('exam/examhallticket/get_class_by_student'); ?>",
            data   : { class_id: class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#student_id').html(response); 
               }
            }
        }); 
   });
</script>