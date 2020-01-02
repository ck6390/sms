<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-user-md"></i><small> <?php echo $this->lang->line('manage_employee'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'hrm', 'designation')){ ?>
                    <a href="<?php echo site_url('hrm/designation'); ?>"><?php echo $this->lang->line('manage_designation'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>
                   | <a href="<?php echo site_url('hrm/employee'); ?>"><?php echo $this->lang->line('manage_employee'); ?></a>
                <?php } ?>
                 
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_employee_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('list'); ?></a> </li>

                        <li class=""><a href="#tab_teacher_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'hrm', 'employee')){ ?>
                        <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?>
                        
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?> 
                            
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?>   
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade" id="tab_teacher_list">
                             <div class="x_content table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th>Attendance Id</th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('join_date'); ?></th>
                                        <th>Unique Id</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  
                                   // $teacher = $this->teacher->teacher_model->get_teacher_list();
                                    $count = 1; if(isset($teachers) && !empty($teachers)){ ?>
                                        <?php foreach($teachers as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo '2'.$obj->id; ?></td>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/teacher-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $this->config->item('country_code').$obj->phone; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($obj->joining_date)); ?></td>
                                            <td><?php echo $obj->unique_id; ?></td>
                                            <td>
												<?php echo $obj->status==1 ? anchor("teacher/deactivate/".$obj->id."/".base64_encode($obj->email), '<span class="btn btn-danger btn-xs">In-active</span>') : anchor("teacher/activate/". $obj->id."/".base64_encode($obj->email), '<span class="btn btn-primary btn-xs">Activate</span>');?>
                                                <?php if(has_permission(EDIT, 'teacher', 'teacher')){ ?>
                                                    <a href="<?php echo site_url('teacher/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i>  </a>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'teacher', 'teacher')){ ?>
                                                    <a  onclick="get_teacher_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-teacher-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'teacher', 'teacher')){ ?>
                                                    <a href="<?php echo site_url('teacher/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_employee_list" >
                            <div class="x_content table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th>Attendance Id</th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('designation'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('join_date'); ?></th>
                                        <th>Unique Id</th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($employees) && !empty($employees)){ ?>
                                        <?php foreach($employees as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo '3'.$obj->id; ?></td>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->designation; ?></td>
                                            <td><?php echo $this->config->item('country_code').$obj->phone; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td><?php echo $obj->joining_date; ?></td>
                                            <td><?php echo $obj->unique_id ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'hrm', 'employee')){ ?> 
                                                    <a href="<?php echo site_url('hrm/employee/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> </a>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>
                                                    <a  onclick="get_employee_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-employee-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'hrm', 'employee')){ ?> 
                                                    <?php if($obj->id != 1){ ?> 
                                                        <a href="<?php echo site_url('hrm/employee/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>  </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_employee">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('hrm/employee/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo $this->lang->line('national_id'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($post['national_id']) ?  $post['national_id'] : ''; ?>" placeholder="<?php echo $this->lang->line('national_id'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="designation_id"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="designation_id" id="designation_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php foreach($designations as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            </select>
                                             <a href="<?php echo site_url('hrm/designation/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('designation_id'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
                                        </div>
                                    </div>
                                    
                                <div class="clearfix"></div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gender"><?php echo $this->lang->line('gender'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="blood_group"><?php echo $this->lang->line('blood_group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="religion"><?php echo $this->lang->line('religion'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($post['religion']) ?  $post['religion'] : ''; ?>" placeholder="<?php echo $this->lang->line('religion'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                        </div>
                                    </div>
                                    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>                                                      
                                                             
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('academic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="password"><?php echo $this->lang->line('password'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo $this->lang->line('password'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('password'); ?></div>
                                        </div>
                                    </div>  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_grade_id"><?php echo $this->lang->line('salary_grade'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="salary_grade_id" id="salary_grade_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>" ><?php echo $obj->grade_name."-[".$obj->net_salary."]"; ?></option>
                                                <?php } ?>           
                                            </select>
                                            <a href="#" data-toggle="modal" data-target="#salary_modal" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                        </div>
                                    </div>  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_type"><?php echo $this->lang->line('salary_type'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="salary_type" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <option value="monthly"><?php echo $this->lang->line('monthly'); ?></option>                                           
                                                <option value="hourly"><?php echo $this->lang->line('hourly'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                        </div>
                                    </div>    
                                    <div class="clearfix"></div>                                
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo $this->lang->line('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php foreach($roles as $obj){ 
                                                     if($obj->name!="Student" && $obj->name!="Teacher" && $obj->name!="Guardian"){
                                                ?>
                                                 
                                                    <option value="<?php echo $obj->id.",".$obj->name; ?>"><?php echo $obj->name; ?></option>
                                                <?php } } ?>
                                            </select>
                                            <a href="<?php echo site_url('administrator/role/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="joining_date"><?php echo $this->lang->line('join_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="add_joining_date" value="<?php echo isset($post['joining_date']) ?  $post['joining_date'] : ''; ?>" placeholder="<?php echo $this->lang->line('join_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="resume"><?php echo $this->lang->line('resume'); ?> </label>                                           
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                            <div class="help-block"><?php echo form_error('resume'); ?></div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('in_time'); ?> <span class="required">*</span> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="in_time"  id="in_time" value="<?php echo isset($employee->in_time) ?  $employee->in_time : '10:00 AM'; ?>" placeholder="<?php echo $this->lang->line('in_time'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('in_time'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('out_time'); ?> <span class="required">*</span> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="out_time"  id="out_time" value="<?php echo isset($employee->out_time) ?  $employee->out_time : '05:00 PM'; ?>" placeholder="<?php echo $this->lang->line('out_time'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('out_time'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="is_view_on_web"><?php echo $this->lang->line('is_view_on_web'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="is_view_on_web" id="is_view_on_web">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <option value="1"><?php echo $this->lang->line('yes'); ?></option>                                           
                                                <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('is_view_on_web'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('facebook_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="facebook_url"  id="facebook_url" value="<?php echo isset($post['facebook_url']) ?  $post['facebook_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('facebook_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('facebook_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="linkedin_url"><?php echo $this->lang->line('linkedin_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="linkedin_url"  id="linkedin_url" value="<?php echo isset($post['linkedin_url']) ?  $post['linkedin_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('linkedin_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('linkedin_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="twitter_url"><?php echo $this->lang->line('twitter_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="twitter_url"  id="twitter_url" value="<?php echo isset($post['twitter_url']) ?  $post['twitter_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('twitter_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('twitter_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="google_plus_url"><?php echo $this->lang->line('google_plus_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="google_plus_url"  id="google_plus_url" value="<?php echo isset($post['google_plus_url']) ?  $post['google_plus_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('google_plus_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('google_plus_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="instagram_url"><?php echo $this->lang->line('instagram_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="instagram_url"  id="instagram_url" value="<?php echo isset($post['instagram_url']) ?  $post['instagram_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('instagram_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('instagram_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="youtube_url"><?php echo $this->lang->line('youtube_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="youtube_url"  id="youtube_url" value="<?php echo isset($post['youtube_url']) ?  $post['youtube_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('youtube_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('youtube_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="pinterest_url"><?php echo $this->lang->line('pinterest_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="pinterest_url"  id="pinterest_url" value="<?php echo isset($post['pinterest_url']) ?  $post['pinterest_url'] : ''; ?>" placeholder="<?php echo $this->lang->line('pinterest_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('pinterest_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo $this->lang->line('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('photo'); ?> </label>                                           
                                                <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" value="" placeholder="email" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_employee_instruction'); ?></div>
                                </div>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>                        
                        <div class="tab-pane fade in active" id="tab_edit_employee">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('hrm/employee/edit/'. $employee->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                 
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($employee->name) ?  $employee->name : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo $this->lang->line('national_id'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($employee->national_id) ?  $employee->national_id : ''; ?>" placeholder="<?php echo $this->lang->line('national_id'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="designation_id"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="designation_id" id="designation_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php foreach($designations as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($employee->designation_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            </select>  
                                            <a href="<?php echo site_url('hrm/designation/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('designation_id'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($employee->phone) ?  $employee->phone : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
                                        </div>
                                    </div>                                    
                                    <div class="clearfix"></div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gender"><?php echo $this->lang->line('gender'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($employee->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="blood_group"><?php echo $this->lang->line('blood_group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($employee->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="religion"><?php echo $this->lang->line('religion'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($employee->religion) ?  $employee->religion : ''; ?>" placeholder="<?php echo $this->lang->line('religion'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($employee->dob) ?  date('d-m-Y', strtotime($employee->dob)) : ''; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                        </div>
                                    </div>
                                    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($employee->present_address) ?  $employee->present_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($employee->permanent_address) ?  $employee->permanent_address : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>                                                      
                                                             
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('academic'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  readonly="readonly"  id="email" value="<?php echo isset($employee->email) ?  $employee->email : $post['email']; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="password"><?php echo $this->lang->line('password'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo $this->lang->line('password'); ?>"  type="text">
                                            <div class="help-block"><?php echo form_error('password'); ?></div>
                                        </div>
                                    </div>   
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_grade_id"><?php echo $this->lang->line('salary_grade'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="salary_grade_id" id="salary_grade_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>" <?php if($employee->salary_grade_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->grade_name."-[".$obj->net_salary."]"; ?></option>
                                                <?php } ?>           
                                            </select>
                                            <a href="#" data-toggle="modal" data-target="#salary_modal" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                        </div>
                                    </div>  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_type"><?php echo $this->lang->line('salary_type'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="salary_type" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <option value="monthly" <?php if($employee->salary_type == 'monthly'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('monthly'); ?></option>                                           
                                                <option value="hourly" <?php if($employee->salary_type == 'hourly'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('hourly'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="clearfix"></div>                              
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo $this->lang->line('role') ; ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php foreach($roles as $obj){ 
                                                    if($obj->name!="Student" && $obj->name!="Teacher" && $obj->name!="Guardian"){
                                                    ?>
                                                    
                                                    <option value="<?php echo $obj->id.",".$obj->name; ?>" <?php if($employee->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } } ?>                                              
                                            </select>
                                            <a href="<?php echo site_url('administrator/role/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="joining_date"><?php echo $this->lang->line('join_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="edit_joining_date" value="<?php echo isset($employee->joining_date) ?  date('d-m-Y', strtotime($employee->joining_date)) : $post['joining_date']; ?>" placeholder="<?php echo $this->lang->line('join_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="resume"><?php echo $this->lang->line('resume'); ?> </label>                                           
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                            <div class="help-block"><?php echo form_error('resume'); ?></div>
                                        </div>
                                    </div>  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <input type="hidden" name="prev_resume" id="prev_resume" value="<?php echo $employee->resume; ?>" />
                                             <?php if($employee->resume){ ?>
                                             <a href="<?php echo UPLOAD_PATH; ?>/employee-resume/<?php echo $employee->resume; ?>"><?php echo $employee->resume; ?></a> <br/>
                                             <?php } ?>                                     
                                            
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('in_time'); ?> <span class="required">*</span> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="in_time"  id="in_time" value="<?php echo isset($employee->in_time) ?  $employee->in_time : '10:00 AM'; ?>" placeholder="<?php echo $this->lang->line('in_time'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('in_time'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('out_time'); ?> <span class="required">*</span> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="out_time"  id="out_time" value="<?php echo isset($employee->out_time) ?  $employee->out_time : '05:00 PM'; ?>" placeholder="<?php echo $this->lang->line('out_time'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('out_time'); ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="is_view_on_web"><?php echo $this->lang->line('is_view_on_web'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="is_view_on_web" id="is_view_on_web">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                                <option value="1" <?php if($employee->is_view_on_web == 1){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>                                           
                                                <option value="0" <?php if($employee->is_view_on_web == 0){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('is_view_on_web'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo $this->lang->line('facebook_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="facebook_url"  id="facebook_url" value="<?php echo isset($employee->facebook_url) ?  $employee->facebook_url : ''; ?>" placeholder="<?php echo $this->lang->line('facebook_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('facebook_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="linkedin_url"><?php echo $this->lang->line('linkedin_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="linkedin_url"  id="linkedin_url" value="<?php echo isset($employee->linkedin_url) ?  $employee->linkedin_url : ''; ?>" placeholder="<?php echo $this->lang->line('linkedin_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('linkedin_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="twitter_url"><?php echo $this->lang->line('twitter_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="twitter_url"  id="twitter_url" value="<?php echo isset($employee->twitter_url) ?  $employee->twitter_url : ''; ?>" placeholder="<?php echo $this->lang->line('twitter_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('twitter_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="google_plus_url"><?php echo $this->lang->line('google_plus_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="google_plus_url"  id="google_plus_url" value="<?php echo isset($employee->google_plus_url) ?  $employee->google_plus_url : ''; ?>" placeholder="<?php echo $this->lang->line('google_plus_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('google_plus_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="instagram_url"><?php echo $this->lang->line('instagram_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="instagram_url"  id="instagram_url" value="<?php echo isset($employee->instagram_url) ?  $employee->instagram_url : ''; ?>" placeholder="<?php echo $this->lang->line('instagram_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('instagram_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="youtube_url"><?php echo $this->lang->line('youtube_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="youtube_url"  id="youtube_url" value="<?php echo isset($employee->youtube_url) ?  $employee->youtube_url : ''; ?>" placeholder="<?php echo $this->lang->line('youtube_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('youtube_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="pinterest_url"><?php echo $this->lang->line('pinterest_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="pinterest_url"  id="pinterest_url" value="<?php echo isset($employee->pinterest_url) ?  $employee->pinterest_url : ''; ?>" placeholder="<?php echo $this->lang->line('pinterest_url'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('pinterest_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo $this->lang->line('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($employee->other_info) ?  $employee->other_info : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('photo'); ?> </label>                                           
                                                <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" value="" placeholder="email" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $employee->photo; ?>" />
                                            <?php if($employee->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $employee->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="id" value="<?php echo $employee->id; ?>" />
                                        <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>                          
                        <?php } ?>                 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-employee-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_employee_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_employee_modal(employee_id){
         
        $('.fn_employee_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('hrm/employee/get_single_employee'); ?>",
          data   : {employee_id : employee_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_employee_data').html(response);
             }
          }
       });
    }
</script>
  
<div class="modal fade bs-teacher-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_teacher_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_teacher_modal(teacher_id){
         
        $('.fn_teacher_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('teacher/get_single_teacher'); ?>",
          data   : {teacher_id : teacher_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_teacher_data').html(response);
             }
          }
       });
    }
</script>
<script type="text/javascript" src="https://jdewit.github.io/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" />

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
<!-- datatable with buttons -->
 <script type="text/javascript">
     
    $('#add_dob').datepicker();
    $('#add_joining_date').datepicker();
    $('#edit_dob').datepicker();
    $('#edit_joining_date').datepicker();
  
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
        
    $("#add").validate();     
    $("#edit").validate();

    $('#in_time').timepicker();
    $('#out_time').timepicker();

</script>

<!-----Modal For add gaurdian---->
<?php include 'salary_modal.php'; ?>