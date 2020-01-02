<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo $this->lang->line('manage_user'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'administrator', 'year')){ ?>
                    <a href="<?php echo site_url('administrator/year'); ?>"><?php echo $this->lang->line('academic_year'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'role')){ ?>
                   | <a href="<?php echo site_url('administrator/role'); ?>"><?php echo $this->lang->line('user_role'); ?></a>
                <?php } ?>
                <!-- <?php if(has_permission(VIEW, 'administrator', 'permission')){ ?>
                   | <a href="<?php echo site_url('administrator/permission'); ?>"><?php echo $this->lang->line('role_permission'); ?></a>                   
                <?php } ?> -->
                <?php if(has_permission(VIEW, 'administrator', 'user')){ ?>
                   | <a href="<?php echo site_url('administrator/user'); ?>"><?php echo $this->lang->line('manage_user'); ?></a>                
                <?php } ?>
                <?php if(has_permission(EDIT, 'administrator', 'password')){ ?>
                   | <a href="<?php echo site_url('administrator/password'); ?>"><?php echo $this->lang->line('reset_password'); ?></a>                   
                <?php } ?>
                <?php if(has_permission(EDIT, 'administrator', 'email')){ ?>
                   | <a href="<?php echo site_url('administrator/email'); ?>"><?php echo $this->lang->line('reset_email'); ?></a>                   
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'backup')){ ?>
                   | <a href="<?php echo site_url('administrator/backup'); ?>"><?php echo $this->lang->line('backup'); ?> <?php echo $this->lang->line('database'); ?></a>                  
                <?php } ?>
                <?php if(has_permission(EDIT, 'administrator', 'emailtemplate')){ ?>
                   | <a href="<?php echo site_url('administrator/emailtemplate'); ?>"><?php echo $this->lang->line('email'); ?> <?php echo $this->lang->line('template'); ?></a>                   
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'smstemplate')){ ?>
                   | <a href="<?php echo site_url('administrator/smstemplate'); ?>"><?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('template'); ?></a>                  
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'activitylog')){ ?>
                   | <a href="<?php echo site_url('administrator/activitylog'); ?>"><?php echo $this->lang->line('activity_log'); ?></a>                  
                <?php } ?>
            </div>
            
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('administrator/user'), array('name' => 'user', 'id' => 'user', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('type'); ?> <span class="required"> *</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value, '', '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                <?php foreach($roles as $obj ){ ?>
                                <option value="<?php echo $obj->id.",".$obj->name; ?>" <?php if(isset($role_id) && $role_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?>                                            
                            </select>
                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 display" style="display:<?php if(isset($class_id)){ echo 'block';} ?>">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user('', this.value,'');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                <?php foreach($classes as $obj ){ ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('user'); ?></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
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
            
             <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_user_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> <?php echo $this->lang->line('user'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>                                                                    
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('created'); ?></th>                                            
                                        <th><?php echo $this->lang->line('login'); ?> <?php echo $this->lang->line('status'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($users) && !empty($users)) {
                                        ?>
                                        <?php foreach ($users as $obj ) { ?>
                                            <?php                                         
                                            $path = '';
                                            if($get_role_by_id->name == "Student"){ $path = 'student'; }
                                            elseif($get_role_by_id->name == "Guardian"){ $path = 'guardian'; }
                                            elseif($get_role_by_id->name == "Teacher"){ $path = 'teacher'; }
                                            else{ $path = 'employee'; }
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <?php if ($obj->photo != '') { ?>                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?>/<?php echo $path; ?>-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                    <?php } else { ?>
                                                        <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="60" /> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $this->config->item('country_code').$obj->phone; ?></td>
                                                <td><?php echo $obj->email; ?></td>   
                                                <td><?php echo date('M j, Y', strtotime($obj->created_at)); ?></td>   
                                                <td>
                                                    <?php if($path == 'employee') { $path = 'hrm/employee';} ?>
                                                    
                                                    <?php if(has_permission(EDIT, 'administrator', 'user')){ ?>
                                                        <?php if($obj->login_status){ ?>
                                                            <a class="btn btn-success btn-xs">  <i class="fa fa-check"> <?php echo $this->lang->line('login'); ?> <?php echo $this->lang->line('active'); ?></i></a>
                                                            <a class="btn btn-danger btn-xs fn_update_status" id="<?php echo $obj->user_id; ?>" itemid="0"><i class="fa fa-ban"> <?php echo $this->lang->line('in_activate_now'); ?></i></a>
                                                        <?php }else{ ?>
                                                            <a class="btn btn-danger btn-xs" ><i class="fa fa-ban"> <?php echo $this->lang->line('login'); ?> <?php echo $this->lang->line('in_active'); ?></i></a>
                                                            <a class="btn btn-success btn-xs fn_update_status"  id="<?php echo $obj->user_id; ?>" itemid="1"><i class="fa fa-check"> <?php echo $this->lang->line('activate_now'); ?></i></a>
                                                        <?php } ?>                                                        
                                                        <a href="<?php echo site_url($path.'/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"> <?php echo $this->lang->line('edit'); ?></i></a>
                                                    <?php } ?> 
                                                    <?php if(has_permission(VIEW, 'administrator', 'user')){ ?>    
                                                        <a href="<?php echo site_url($path.'/view/'.$obj->id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-eye"> <?php echo $this->lang->line('view'); ?></i></a>
                                                    <?php } ?> 
                                                </td>   
                                            </tr>
                                        <?php } ?>
                                    <?php } ?> 

                                </tbody>
                            </table>   

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('manage_user_instruction'); ?></div>
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
    <?php if(isset($role_id)){ ?>
      get_user_by_role('<?php echo $role_id;  ?>', '<?php echo $class_id; ?>', '<?php echo $user_id; ?>');
    <?php } ?>
    function get_user_by_role(role_id, class_id, user_id){       
       var role = role_id.split(",");
       //alert(role[1]);
       if(role[1] == "Student"){
           $('.display').show();
           $('#class_id').attr("required");
           $('#user_id').html('<option value="">--<?php echo $this->lang->line('select'); ?>--</option>'); 
           if(class_id !='' ){
                get_user(role_id, class_id, user_id);
           }
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').removeAttr("required");
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
   $('.fn_update_status').click(function(){
   
       var user_id = $(this).attr('id');    
       var status = $(this).attr('itemid');    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/update_user_status'); ?>",
            data   : { user_id:user_id,  status : status },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   toastr.success('Success'); 
                   location.reload();
               }
            }
        }); 
   });
    
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
        
     $("#user").validate();    
</script> 