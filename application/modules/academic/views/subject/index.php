<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-folder-open"></i><small> <?php echo $this->lang->line('manage_subject'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_subject_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'academic', 'subject')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_subject"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('subject'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_subject"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('subject'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_subject"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('subject'); ?></a> </li>                          
                        <?php } ?>
                            <li class="li-class-list">
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_subject_by_class(this.value);">
                                    <?php if($this->session->userdata('role_id') != STUDENT){ ?>
                                        <option value="<?php echo site_url('academic/subject/index/'); ?>">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php } ?> 
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if($this->session->userdata('role_id') == STUDENT && $this->session->userdata('class_id') == $obj->id){ ?>
                                            <option value="<?php echo site_url('academic/subject/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') != STUDENT){ ?>
                                            <option value="<?php echo site_url('academic/subject/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php } ?>                                            
                                    <?php } ?>                                            
                                </select>
                            </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_subject_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('code'); ?></th>
                                        <!--<th><?php echo $this->lang->line('pass_mark'); ?></th>
                                        <th><?php echo $this->lang->line('full_mark'); ?></th>-->
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('teacher'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($subjects) && !empty($subjects)){ ?>
                                        <?php foreach($subjects as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->name; ?></td>
                                            <td><?php echo $obj->code; ?></td>
                                            <!--<td><?php echo $obj->pass_mark; ?></td>
                                            <td><?php echo $obj->full_mark; ?></td>-->
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->teacher; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'academic', 'subject')){ ?>
                                                    <a href="<?php echo site_url('academic/subject/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'academic', 'subject')){ ?>
                                                    <a  onclick="get_subject_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-subject-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'academic', 'subject')){ ?>
                                                    <a href="<?php echo site_url('academic/subject/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_subject">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('academic/subject/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('code'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="code"  id="code" value="<?php echo isset($post['code']) ?  $post['code'] : ''; ?>" placeholder="<?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('code'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('code'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author"><?php echo $this->lang->line('author'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="author"  id="author" value="<?php echo isset($post['author']) ?  $post['author'] : ''; ?>" placeholder="<?php echo $this->lang->line('author'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('author'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"><?php echo $this->lang->line('type'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="type" id="type" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php $types = get_subject_type(); ?>
                                            <?php foreach($types as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php echo isset($post['type']) && $post['type'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('type'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="class_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('academic/classes/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="teacher_id"><?php echo $this->lang->line('teacher'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="teacher_id"  id="teacher_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($teachers as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['teacher_id']) && $post['teacher_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('teacher/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('teacher_id'); ?></div>
                                    </div>
                                </div>
                                
                                <!--<div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pass_mark"><?php echo $this->lang->line('pass_mark'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="pass_mark"  id="pass_mark" value="<?php echo isset($post['pass_mark']) ?  $post['pass_mark'] : ''; ?>" placeholder="<?php echo $this->lang->line('pass_mark'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('pass_mark'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="full_mark"><?php echo $this->lang->line('full_mark'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="full_mark"  id="full_mark" value="<?php echo isset($post['full_mark']) ?  $post['full_mark'] : ''; ?>" placeholder="<?php echo $this->lang->line('full_mark'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('full_mark'); ?></div>
                                    </div>
                                </div>-->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12  textarea-4column"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('academic/subject/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_subject">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('academic/subject/edit/'.$subject->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($subject->name) ?  $subject->name : $post['name']; ?>" placeholder="<?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('code'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="code"  id="code" value="<?php echo isset($subject->code) ?  $subject->code : $post['code']; ?>" placeholder="<?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('code'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('code'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author"><?php echo $this->lang->line('author'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="author"  id="author" value="<?php echo isset($subject->author) ?  $subject->author : $post['author']; ?>" placeholder="<?php echo $this->lang->line('author'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('author'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"><?php echo $this->lang->line('type'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="type" id="type" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php $types = get_subject_type(); ?>
                                            <?php foreach($types as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($subject->type == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('type'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="class_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($subject->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('academic/classes/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="teacher_id"><?php echo $this->lang->line('teacher'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="teacher_id"  id="teacher_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($teachers as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($subject->teacher_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <a href="<?php echo site_url('teacher/add'); ?>" class="btn btn-success btn-md quick-add">+</a>
                                        <div class="help-block"><?php echo form_error('teacher_id'); ?></div>
                                    </div>
                                </div>
                               <!--<div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pass_mark"><?php echo $this->lang->line('pass_mark'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="pass_mark"  id="pass_mark" value="<?php echo isset($subject->pass_mark) ?  $subject->pass_mark : $post['pass_mark']; ?>" placeholder="<?php echo $this->lang->line('pass_mark'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('pass_mark'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="full_mark"><?php echo $this->lang->line('full_mark'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="full_mark"  id="full_mark" value="<?php echo isset($subject->full_mark) ?  $subject->full_mark : $post['full_mark']; ?>" placeholder="<?php echo $this->lang->line('full_mark'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('full_mark'); ?></div>
                                    </div>
                                </div>-->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($subject->note) ?  $subject->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($subject) ? $subject->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('academic/subject/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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

<div class="modal fade bs-subject-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('subject'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_subject_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_subject_modal(subject_id){
         
        $('.fn_subject_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('academic/subject/get_single_subject'); ?>",
          data   : {subject_id : subject_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_subject_data').html(response);
             }
          }
       });
    }
</script>

<!-- datatable with buttons -->
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
        
       function get_subject_by_class(url){          
           if(url){
               window.location.href = url; 
           }
       }
       
    $("#add").validate();     
    $("#edit").validate();     
</script>

