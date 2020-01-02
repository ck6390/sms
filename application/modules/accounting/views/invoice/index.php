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
               <?php /*if(has_permission(VIEW, 'accounting', 'discount')){ ?>
                    <a href="<?php echo site_url('accounting/discount/index'); ?>"><?php echo $this->lang->line('discount'); ?></a>                  
                <?php }*/ ?> 
              
               <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                  | <a href="<?php echo site_url('accounting/feetype/index'); ?>"><?php echo $this->lang->line('fee_type'); ?></a>                  
                <?php } ?> 
                
                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                   
                   <?php if($this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 3){ ?>
                        | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo $this->lang->line('due_invoice'); ?></a>                    
                   <?php }else{ ?>
                        | <a href="<?php echo site_url('accounting/invoice/add'); ?>"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('collection'); ?></a>
                        | <a href="<?php echo site_url('accounting/invoice/index'); ?>"><?php echo $this->lang->line('manage_invoice'); ?></a>
                        | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo $this->lang->line('due_invoice'); ?></a>                    
                    <?php } ?> 
                <?php } ?> 
                  
                <?php if(has_permission(VIEW, 'accounting', 'duefeeemail')){ ?>
                   | <a href="<?php echo site_url('accounting/duefeeemail/index'); ?>"><?php echo $this->lang->line('due_fee'); ?> <?php echo $this->lang->line('email'); ?></a>                  
                <?php } ?>
                 <?php if(has_permission(VIEW, 'accounting', 'duefeesms')){ ?>
                   | <a href="<?php echo site_url('accounting/duefeesms/index'); ?>"><?php echo $this->lang->line('due_fee'); ?> <?php echo $this->lang->line('sms'); ?></a>                  
                <?php } ?>         
                        
                 <?php if(has_permission(VIEW, 'accounting', 'incomehead')){ ?>
                  | <a href="<?php echo site_url('accounting/incomehead/index'); ?>"><?php echo $this->lang->line('income_head'); ?></a>                  
                <?php } ?> 
                 <?php if(has_permission(VIEW, 'accounting', 'income')){ ?>
                   | <a href="<?php echo site_url('accounting/income/index'); ?>"><?php echo $this->lang->line('income'); ?></a>                     
                <?php } ?>  
                <?php if(has_permission(VIEW, 'accounting', 'exphead')){ ?>
                   | <a href="<?php echo site_url('accounting/exphead/index'); ?>"><?php echo $this->lang->line('expenditure_head'); ?></a>                  
                <?php } ?> 
                <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
                   | <a href="<?php echo site_url('accounting/expenditure/index'); ?>"><?php echo $this->lang->line('expenditure'); ?></a>                  
                <?php } ?> 
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_invoice_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <li  class="<?php if(isset($single)){ echo 'active'; }?>"><a href="#tab_single_invoice"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('create'); ?> <?php echo $this->lang->line('invoice'); ?></a> </li>                          
                        <li  class="<?php if(isset($bulk)){ echo 'active'; }?>"><a href="#tab_bulk_invoice"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('create'); ?> <?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('invoice'); ?></a> </li>                          
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_invoice"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('invoice'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <?php $year_quarters = get_year_quarters();?>  
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_invoice_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                        <th><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('number'); ?></th>
                                        <th><?php echo $this->lang->line('student'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?></th>
                                        <th><?php echo $this->lang->line('month'); ?></th>
                                        <th><?php echo $this->lang->line('year_quarter'); ?></th>
                                        <th><?php echo $this->lang->line('gross_amount'); ?></th>
                                        <!--th><?php //echo $this->lang->line('discount'); ?></th-->
                                        <th><?php echo $this->lang->line('net_amount'); ?></th>
                                        <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                                        <?php foreach($invoices as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->student_admission_no; ?></td>
                                            <td><?php echo $obj->custom_invoice_id; ?></td>
                                            <td><?php echo $obj->student_name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->head; ?></td>
                                            <td>
                                                <?php //echo $obj->month; 
                                                    @$monthArr = (explode(",",$obj->month));
                                                    $i=0;
                                                    foreach ($monthArr as $month) {  
                                                        if(!empty($month) && is_numeric($month)){
                                                            if($i != 0){
                                                                echo ', ';
                                                            }
                                                            echo date('F', mktime(0, 0, 0, $month, 10));
                                                        }
                                                        $i++;
                                                    }
                                                ?>                                                
                                            </td>
                                            <td><?php echo (!empty($obj->year_quarter))? $year_quarters[$obj->year_quarter]: ''; ?></td>
                                            <td><?php echo $obj->gross_amount; ?></td>
                                            <!--td><?php //echo $obj->discount; ?></td-->
                                            <td><?php echo $obj->net_amount; ?></td>
                                            <td><?php echo get_paid_status($obj->status); ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                                    <a href="<?php echo site_url('accounting/invoice/view/'.$obj->custom_invoice_id); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?> 
                                                <?php if(has_permission(DELETE, 'accounting', 'invoice')){ ?>
                                                    <?php if($obj->paid_status == 'unpaid'){ ?>
                                                        <a href="<?php echo site_url('accounting/invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
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

                        <div  class="tab-pane fade in <?php if(isset($single)){ echo 'active'; }?>" id="tab_single_invoice">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('accounting/invoice/add'), array('name' => 'single', 'id' => 'single', 'class'=>'form-horizontal form-label-left'), ''); ?>

                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4">
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="get_student_by_class(this.value, '', 'add');" >
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                        <?php foreach($classes as $obj ){ ?>
                                                        <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                                        <?php } ?>                                            
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id" required="required"  id="add_student_id">
                                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('year_quarter'); ?> <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select  class="form-control col-md-7 col-xs-12 quick-field"  name="year_quarter" required="required" id="add_year_quarter">
                                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                    <?php foreach ($year_quarters  as $key_q=>$year_quarter) {?>    
                                                        <option value="<?php echo $key_q; ?>" <?php echo isset($post['year_quarter']) && $post['year_quarter'] == $key_q ?  'selected="selected"' : ''; ?>><?php echo $year_quarter; ?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                    <div class="help-block"><?php echo form_error('year_quarter'); ?></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            Months
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php $monthsArray = get_months(); ?>
                                                    <?php $get_month_quarter = get_month_quarter(); ?>
                                                    <?php foreach($monthsArray as $key=>$months ){ ?>
                                                        <li style="list-style-type: none;">
                                                        <input  name="month[]" class="month <?php echo $get_month_quarter[$key]?>" value="<?php echo date('m',strtotime($key))?>" <?php echo $this->lang->line('month'); ?>" required="required" type="checkbox"> <?php echo $months; ?>                                                        
                                                        </li>
                                                    <?php } ?> 
                                                     <div class="help-block"><?php echo form_error('month'); ?></div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                             Fee Type
                                            <ul id=fee_type>
                                                    <?php foreach($income_heads as $obj ){ ?>
                                                    <li style="list-style-type: none;">
                                                    <input  name="income_head_id[]" class="income_head <?php echo strtolower($obj->title);?>" data-amount="<?php echo $obj->fee_amount; ?>" value="<?php echo isset($obj->id) ?  $obj->id : ''; ?>" <?php echo $this->lang->line('amount'); ?>" required="required" type="checkbox"> <?php echo $obj->title; ?>
                                                    ( <i class="fa fa-inr" style="color:#000;"></i> <?php echo $obj->fee_amount; ?>)
                                                    </li>
                                                    <?php } ?> 
                                            </ul>
                                        </div>
                                 </div>                          
                               
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12" readonly="readonly"  name="amount1"  id="add_amount" value="<?php echo isset($post['totalamount']) ?  $post['totalamount'] : ''; ?>" placeholder="<?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?>" required="required" type="text">

                                        <input class="form-control col-md-7 col-xs-12" readonly="readonly"  name="totalamount"  id="totalamount" value="<?php echo isset($post['totalamount']) ?  $post['totalamount'] : '0'; ?>" placeholder="<?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?>" type="hidden">
                                        <!-- Start for hidden filed because comment below fields -->
                                        <input name="is_applicable_discount"  id="is_applicable_discount" value="no" type="hidden">
                                        <input name="paid_status"  id="paid_status" value="unpaid" type="hidden">
                                        <!-- Start for hidden filed because comment below fields -->
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>                                
                                         
                                
                                <!-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_applicable_discount"><?php echo $this->lang->line('is_applicable_discount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="is_applicable_discount" id="is_applicable_discount" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="1"><?php echo $this->lang->line('yes'); ?></option>                                           
                                            <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('is_applicable_discount'); ?></div>
                                    </div>
                                </div> -->
                                
                                <!-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('status'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="paid_status" id="paid_status" required="required"  onchange="check_paid_status(this.value,'single');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="paid"><?php echo $this->lang->line('paid'); ?></option>                                           
                                            <option value="unpaid"><?php echo $this->lang->line('unpaid'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('paid_status'); ?></div>
                                    </div>
                                </div> -->
                                
                                <!-- For cheque Start-->
                                <!-- <div class="display fn_single_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12"  name="payment_method"  id="single_payment_method" onchange="check_payment_method(this.value, 'single');">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $payments = get_payment_methods(); ?>
                                                <?php foreach($payments as $key=>$value ){ ?>                                              
                                                    <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['payment_method'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                    <?php } ?>  
                                                <?php } ?>                                            
                                            </select>
                                        <div class="help-block"><?php echo form_error('payment_method'); ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <!-- For cheque Start-->
                                <!-- <div class="display fn_single_cheque" style="<?php if(isset($post) && $post['payment_method'] == 'cheque'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name"><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bank_name"  id="single_bank_name" value="" placeholder="<?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cheque_no"><?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="cheque_no"  id="single_cheque_no" value="" placeholder="<?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('cheque_no'); ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- For cheque End-->
                                
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
                                        <input type="hidden" value="single" name="type" />
                                        <a href="<?php echo site_url('accounting/invoice/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <div  class="tab-pane fade in <?php if(isset($bulk)){ echo 'active'; }?>" id="tab_bulk_invoice">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('accounting/invoice/bulk'), array('name' => 'bulk', 'id' => 'bulk', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="bulk_class_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id?"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="income_head_id" id="income_head_id" required="required" onchange="get_student_and_fee_amount(this.value);">
                                        <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($income_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->title; ?></option>
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="student_container">
                                            
                                        </div>
                                        <div class="help-block fn_check_button display">
                                            <button id="check_all" type="button" class="btn btn-success"><?php echo $this->lang->line('check_all'); ?></button>
                                            <button id="uncheck_all" type="button" class="btn btn-success"><?php echo $this->lang->line('uncheck_all'); ?></button>
                                        </div>
                                    </div>
                                </div>
                                                                                         
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_applicable_discount?"><?php echo $this->lang->line('is_applicable_discount'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="is_applicable_discount" id="is_applicable_discount" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="1"><?php echo $this->lang->line('yes'); ?></option>                                           
                                            <option value="0"><?php echo $this->lang->line('no'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('is_applicable_discount'); ?></div>
                                    </div>
                                </div>
                                                                                     
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_month"><?php echo $this->lang->line('month'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="month"  id="add_bulk_month" value="<?php echo isset($post['month']) ?  $post['month'] : ''; ?>" placeholder="<?php echo $this->lang->line('month'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('month'); ?></div>
                                    </div>
                                </div> 
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('status'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="paid_status" id="paid_status" required="required"  onchange="check_paid_status(this.value,'bulk');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="paid"><?php echo $this->lang->line('paid'); ?></option>                                           
                                            <option value="unpaid"><?php echo $this->lang->line('unpaid'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('paid_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_bulk_paid_status" style="<?php if(isset($post) && $post['paid_status'] == 'paid'){ echo 'display:block;';} ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12"  name="payment_method"  id="bulk_payment_method" onchange="check_payment_method(this.value, 'bulk');">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                                <?php $payments = get_payment_methods(); ?>
                                                <?php foreach($payments as $key=>$value ){ ?>                                              
                                                    <?php if(!in_array($key, array('paypal', 'payumoney', 'ccavenue', 'paytm'))){ ?>
                                                        <option value="<?php echo $key; ?>" <?php if(isset($post) && $post['payment_method'] == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                    <?php } ?>  
                                                <?php } ?>                                            
                                            </select>
                                        <div class="help-block"><?php echo form_error('payment_method'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- For cheque Start-->
                                <div class="display fn_bulk_cheque" style="<?php if(isset($post) && $post['payment_method'] == 'cheque'){ echo 'display:block;';} ?>">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name"><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bank_name"  id="bulk_bank_name" value="" placeholder="<?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bank_name'); ?></div>
                                        </div>
                                    </div> 
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cheque_no"><?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="cheque_no"  id="bulk_cheque_no" value="" placeholder="<?php echo $this->lang->line('cheque'); ?> <?php echo $this->lang->line('number'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('cheque_no'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- For cheque End-->
                                
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
                                        <input type="hidden" value="bulk" name="type" />
                                        <a href="<?php echo site_url('accounting/invoice/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_tag">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('accounting/invoice/edit/'.$invoice->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required" onchange="get_student_by_class(this.value, '','');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($invoice->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="edit_student_id" required="required" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="income_head_id"><?php echo $this->lang->line('income_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="income_head_id"  id="income_head_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($income_heads as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($invoice->income_head_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('income_head_id'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo $this->lang->line('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($invoice->amount) ?  $invoice->amount : $post['amount']; ?>" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="number">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"><?php echo $this->lang->line('discount'); ?>(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="discount"  id="discount" value="<?php echo isset($invoice->discount) ?  $invoice->discount : $post['discount']; ?>" placeholder="<?php echo $this->lang->line('discount'); ?>" type="number">
                                        <div class="help-block"><?php echo form_error('discount'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($invoice->note) ?  $invoice->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($invoice) ? $invoice->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('accounting/invoice'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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
  <!-- bootstrap-datetimepicker -->
 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
<script type="text/javascript"> 
    $("#add_single_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
    $("#add_bulk_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
    $("#edit_month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    
        function check_paid_status(paid_status, type) {

            if (paid_status == "paid") {                
                $('.fn_'+type+'_paid_status').show(); 
                $('#'+type+'_payment_method').prop('required', true);                
                
            } else{               
                $('.fn_'+type+'_paid_status').hide();  
                $('#'+type+'_payment_method').prop('required', false);               
            } 
        }
        
        function check_payment_method(payment_method, type) {

            if (payment_method == "cheque") {
                
                $('.fn_'+type+'_cheque').show();                
                $('#'+type+'_bank_name').prop('required', true);
                $('#'+type+'_cheque_no').prop('required', true);                
                
            } else{
               
                $('.fn_'+type+'_cheque').hide();  
                $('#'+type+'_bank_name').prop('required', false);
                $('#'+type+'_cheque_no').prop('required', false);               
            } 
        }
        
    
    <?php if(isset($edit)){ ?>
        get_student_by_class('<?php echo $invoice->class_id; ?>', '<?php echo $invoice->student_id; ?>', 'bulk');
    <?php } ?>
    
    function get_student_by_class(class_id, student_id, type){       
        
        $("select#"+type+"_student_id").prop('selectedIndex', 0);
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_class'); ?>",
            data   : { class_id : class_id , student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                    $('#'+type+'_student_id').html(response);
                    if($('#add_year_quarter').val() != ''){
                        get_fee_amount('add');
                        selectMonth();
                    }
               }
            }
        });                  
        
   }
   
   /*function get_fee_amount(income_head_id, type){
   
       if(!income_head_id) {
           $('#'+type+'_amount').val('');
           return false;
       }
       
       var class_id = $('#'+type+'_class_id').val();
       var student_id = $('#'+type+'_student_id').val();
   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_fee_amount'); ?>",
            data   : { class_id : class_id , student_id : student_id, income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('#'+type+'_amount').val(response);
               }
            }
        });
   }*/

   function get_fee_amount(type){
       
       var class_id = $('#'+type+'_class_id').val();
       var student_id = $('#'+type+'_student_id').val();
       //var year_quarter = $('#'+type+'year_quarter').val();
       var year_quarter = $('#add_year_quarter').val();
        $.ajax({       
            type   : "POST",
            //url    : "<?php //echo site_url('accounting/invoice/get_fee_amount_by_class'); ?>",
            url    : "<?php echo site_url('accounting/invoice/get_fee_amount_by_class_year_quarter'); ?>",
            data   : { class_id : class_id , student_id : student_id, year_quarter : year_quarter},
            async  : false,
            dataType: 'json',
            success: function(response){
            var html = '';                                                
               if(response.message != 'Please select class')
               {  
                $.each(response, function(index, el) {
                    html += '<li style="list-style-type: none;"><input  name="income_head_id[]" class="income_head '+el.title+' '+el.fee_mode+'" data-amount="'+el.fee_amount+'" value="'+el.id+'" <?php echo $this->lang->line('amount'); ?>" required="required" type="checkbox"> '+el.title+' <span>( <i class="fa fa-inr" style="color:#000;"></i> '+el.fee_amount+')</span></li>';
                    });
                    console.log(response);          
                    $('#fee_type').html(html);
                    $("#totalamount").val('');
                    $("#add_amount").val('');
                    $('input.month').prop('checked',false);
               }else{
                    $('#fee_type').html('<li style="list-style-type: none;">Please create some fee type for this class and year quarter </li>'); 
               }
            }
        });
   }
   
   
   function get_student_and_fee_amount(income_head_id){
   
        if(!income_head_id) {
           $('#student_container').html('');
           $('.fn_check_button').hide();
           return false;
        }
       
        var class_id = $('#bulk_class_id').val();
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/invoice/get_student_and_fee_amount'); ?>",
            data   : { class_id : class_id , income_head_id : income_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                    
                    $('#student_container').html(response);
                    $('.fn_check_button').show();
               }
            }
        });
   }
   
   $('#check_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', true);;
   });
   $('#uncheck_all').on('click', function(){
        $('#student_container').children().find('input[type="checkbox"]').prop('checked', false);;
   });
   

 </script>
 <!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
            $('#fee_type').html('<li style="list-style-type: none;">Please select class first</li>');
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
        
    $("#single").validate();     
    $("#bulk").validate(); 
    $("#edit").validate(); 
    
/*$(".income_head").change(function() {
    calculateAmount();
});*/
$(document).on("click",".income_head",function(){ 
    calculateAmount();
});

$(".month").change(function() {
    calculateAmount();
});
    
function calculateAmount(){
    var checked_boxes = $('input.month:checked').length;
    var  tamount = 0;
    var  annual_tamount = 0;
    $('input.income_head:checked').each(function() {
         //var amount = parseInt($(this).data('amount'));  
         var amount = parseInt($(this).attr('data-amount'));  
         console.log(amount);
         tamount = parseInt(tamount) + parseInt(amount);
    });
    $('input.income_head.2:checked').each(function() { 
         var annual_amount = parseInt($(this).attr('data-amount'));
         annual_tamount = parseInt(annual_tamount) + parseInt(annual_amount);  
    });
    $('input.income_head.3:checked').each(function() { 
         var annual_amount = parseInt($(this).attr('data-amount'));
         annual_tamount = parseInt(annual_tamount) + parseInt(annual_amount);  
    });
    tamount = (tamount - annual_tamount);
    var totalamount = tamount * checked_boxes;
    totalamount = parseInt(totalamount) + parseInt(annual_tamount);
    $("#totalamount").val(totalamount);
    $("#add_amount").val(totalamount);
    console.log(checked_boxes);
}
//$("#add_student_id").change(function() {
$(document).on("change","#add_student_id",function(){ 
    var student_id = $(this).val();
        if(student_id == 'all'){
            $('.Transport').attr('data-amount', '0');
            $('.Transport').next().html('( Charges will apply as per Transport Route per student)');
            $('.2').closest('li').show();
        }else{
            $.ajax({       
                type   : "GET",
                url    : "<?php echo site_url('accounting/invoice/get_transport_fee/'); ?>"+student_id,             
                async  : false,
                dataType: 'json',
                success: function(response){                                                   
                   if(response)
                   {     
                        console.log(response);
                        if(response.transport_fee){
                            $('.Transport').attr('data-amount', response.transport_fee.stop_fare);
                            $('.Transport').next().html('( <i class="fa fa-inr" style="color:#000;"></i> '+response.transport_fee.stop_fare+')');
                        }else{
                            $('.Transport').attr('data-amount', '0');
                            $('.Transport').next().html('(This student is not taking Transport services)');
                        }
                        if(response.hostel){
                            console.log(response.hostel.cost);
                        }
                        if(response.annual_fee){
                            /*console.log(response.annual_fee);
                            $('.2').closest('li').hide();
                            $.each(response.annual_fee, function(idx, obj) {
                                console.log(obj.title);
                                var cname = obj.title.split(" ", 1);
                                $('.'+cname).closest('li').show();
                            });*/
                            //console.log(response.annual_fee.title);
                        }
                    $("#totalamount").val('');
                    $("#add_amount").val('');
                    $('input.month').prop('checked',false);
                    $('input.income_head').prop('checked',false);
                   }
                }
            });
        }
});
$(document).on("change","#add_year_quarter",function(){ 
     get_fee_amount('add');
     selectMonth();
});
function selectMonth(){
    var month_select = $('#add_year_quarter option:selected').text();
     $('.month').prop('checked', false);
     $('.'+month_select).prop('checked', true);
}
</script>