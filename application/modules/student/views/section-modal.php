<div class="modal fade" id="section_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Class</h4>
            </div>            
            <div class="modal-body">
                <div id="section_message"></div>
                 <?php echo form_open(site_url('academic/section/add'), array('name' => 'addsection', 'id' => 'addsection', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <input type="hidden" name="teacher_id" id="teacher_id" value="0" readonly="true">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('section'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('section'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 select2 quick-field"  name="class_id"  id="section_class_id" required="required" >
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('academic/section'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="button" onclick="add_section()" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
            </div>
           
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    function add_section(){
            $.ajax({       
            type   : "POST",
            dataType: "json",
            url    : "<?php echo site_url('academic/section/add'); ?>",
            data :   $("#addsection").serialize(),               
            async  : true,
            success: function(response){ 
                if(response.error){
                    $("#section_message").html(response.error);
                }else{
                    get_class(response.class_id,response.section_id);
                    $("#section_message").html(response.success);
                    $('#section_modal').modal('hide');
                }
            }
        });  
    }

</script>