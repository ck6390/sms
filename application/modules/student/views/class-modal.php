<div class="modal fade" id="class_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Class</h4>
            </div>            
            <div class="modal-body">
                <div id="error"></div>
                 <?php echo form_open_multipart(site_url('guardian/add'), array('name' => 'add', 'id' => 'addclass', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <input type="hidden" name="teacher_id" id="teacher_id" value="0" readonly="true">
                                <div class="row">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="add_name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numeric_name"><?php echo $this->lang->line('numeric'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="numeric_name"  id="add_numeric_name" value="<?php echo isset($post['numeric_name']) ?  $post['numeric_name'] : ''; ?>" placeholder="<?php echo $this->lang->line('numeric'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="number">
                                            <div class="help-block"><?php echo form_error('numeric_name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="add_note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('note'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="#" class="btn btn-primary" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="button" onclick="add_class()" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
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
    function add_class(){
            $.ajax({       
            type   : "POST",
            dataType: "json",
            url    : "<?php echo site_url('academic/classes/add'); ?>",
            data :   $("#addclass").serialize(),               
            async  : true,
            success: function(response){ 
                if(response.error){
                    $("#error").html(response.error);
                }else{
                    get_class(response.class_id,response.section_id);
                    $("#error").html(response.success);
                    $('#class_modal').modal('hide');
                }
            }
        });  
        }

</script>