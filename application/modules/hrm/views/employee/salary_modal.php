<div class="modal fade" id="salary_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Salary Grade</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url('payroll/grade/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="grade_name"><?php echo $this->lang->line('grade_name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="grade_name"  id="add_grade_name" value="<?php echo isset($post['grade_name']) ?  $post['grade_name'] : ''; ?>" placeholder="<?php echo $this->lang->line('grade_name'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('grade_name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="basic_salary"><?php echo $this->lang->line('basic_salary'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="basic_salary"  id="add_basic_salary" value="<?php echo isset($post['basic_salary']) ?  $post['basic_salary'] : ''; ?>" placeholder="<?php echo $this->lang->line('basic_salary'); ?>" required="required" type="number">
                                            <div class="help-block"><?php echo form_error('basic_salary'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="house_rent"><?php echo $this->lang->line('house_rent'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="house_rent"  id="add_house_rent" value="<?php echo isset($post['house_rent']) ?  $post['house_rent'] : ''; ?>" placeholder="<?php echo $this->lang->line('house_rent'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('house_rent'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="transport"><?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('allowance'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="transport"  id="add_transport" value="<?php echo isset($post['transport']) ?  $post['transport'] : ''; ?>" placeholder="<?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('allowance'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('transport'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="medical"><?php echo $this->lang->line('medical'); ?> <?php echo $this->lang->line('allowance'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="medical"  id="add_medical" value="<?php echo isset($post['medical']) ?  $post['medical'] : ''; ?>" placeholder="<?php echo $this->lang->line('medical'); ?> <?php echo $this->lang->line('allowance'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('medical'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="over_time_hourly_rate"><?php echo $this->lang->line('over_time_hourly_rate'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="over_time_hourly_rate"  id="add_over_time_hourly_rate" value="<?php echo isset($post['over_time_hourly_rate']) ?  $post['over_time_hourly_rate'] : ''; ?>" placeholder="<?php echo $this->lang->line('over_time_hourly_rate'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('over_time_hourly_rate'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="provident_fund"><?php echo $this->lang->line('provident_fund'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="provident_fund"  id="add_provident_fund" value="<?php echo isset($post['provident_fund']) ?  $post['provident_fund'] : ''; ?>" placeholder="<?php echo $this->lang->line('provident_fund'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('provident_fund'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="hourly_rate"><?php echo $this->lang->line('hourly_rate'); ?> <!--span class="required">*</span--></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="hourly_rate"  id="add_hourly_rate" value="<?php echo isset($post['hourly_rate']) ?  $post['hourly_rate'] : ''; ?>" placeholder="<?php echo $this->lang->line('hourly_rate'); ?>" type="number">
                                            <div class="help-block"><?php echo form_error('hourly_rate'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="total_allowance"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('allowance'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="total_allowance"  id="add_total_allowance" value="<?php echo isset($post['total_allowance']) ?  $post['total_allowance'] : ''; ?>" placeholder="<?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('allowance'); ?>" type="number" readonly="readonly">
                                            <div class="help-block"><?php echo form_error('total_allowance'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="total_deduction"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="total_deduction"  id="add_total_deduction" value="<?php echo isset($post['total_deduction']) ?  $post['total_deduction'] : ''; ?>" placeholder="<?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?>" type="number" readonly="readonly">
                                            <div class="help-block"><?php echo form_error('total_deduction'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gross_salary"><?php echo $this->lang->line('gross_salary'); ?>  </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="gross_salary"  id="add_gross_salary" value="<?php echo isset($post['gross_salary']) ?  $post['gross_salary'] : ''; ?>" placeholder="<?php echo $this->lang->line('gross_salary'); ?>" type="number" readonly="readonly">
                                            <div class="help-block"><?php echo form_error('gross_salary'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="net_salary"><?php echo $this->lang->line('net_salary'); ?>  </label>
                                            <input  class="form-control col-md-7 col-xs-12 fn_add_claculate"  name="net_salary"  id="add_net_salary" value="<?php echo isset($post['net_salary']) ?  $post['net_salary'] : ''; ?>" placeholder="<?php echo $this->lang->line('net_salary'); ?>" type="number" readonly="readonly">
                                            <div class="help-block"><?php echo form_error('net_salary'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="note"><?php echo $this->lang->line('note'); ?>  </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('note'); ?></div>
                                        </div>
                                    </div>
                                </div>
                         
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('payroll/grade/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
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
    $("#add").validate();    
    
    $('.fn_add_claculate').on('keyup', function(){
        
        var basic_salary = $('#add_basic_salary').val() ? parseFloat($('#add_basic_salary').val()) : 0;
        var house_rent = $('#add_house_rent').val() ? parseFloat($('#add_house_rent').val()) : 0;
        var transport = $('#add_transport').val() ? parseFloat($('#add_transport').val()): 0;
        var medical = $('#add_medical').val() ? parseFloat($('#add_medical').val()) : 0;
        var provident_fund = $('#add_provident_fund').val() ? parseFloat($('#add_provident_fund').val()) : 0;
        
       $('#add_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#add_total_allowance').val() ? parseFloat($('#add_total_allowance').val()) : 0;
        
        $('#add_total_deduction').val(provident_fund);
        var total_deduction = $('#add_total_deduction').val() ? parseFloat($('#add_total_deduction').val()) : 0;
        
        $('#add_gross_salary').val(basic_salary+total_allowance);
        $('#add_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });
    
    $('.fn_edit_claculate').on('keyup', function(){
        
        var basic_salary = $('#edit_basic_salary').val() ? parseFloat($('#edit_basic_salary').val()) : 0;
        var house_rent = $('#edit_house_rent').val() ? parseFloat($('#edit_house_rent').val()) : 0;
        var transport = $('#edit_transport').val() ? parseFloat($('#edit_transport').val()): 0;
        var medical = $('#edit_medical').val() ? parseFloat($('#edit_medical').val()) : 0;
        var provident_fund = $('#edit_provident_fund').val() ? parseFloat($('#edit_provident_fund').val()) : 0;
        
       $('#edit_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#edit_total_allowance').val() ? parseFloat($('#edit_total_allowance').val()) : 0;
        
        $('#edit_total_deduction').val(provident_fund);
        var total_deduction = $('#edit_total_deduction').val() ? parseFloat($('#edit_total_deduction').val()) : 0;
        
        $('#edit_gross_salary').val(basic_salary+total_allowance);
        $('#edit_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });
</script>