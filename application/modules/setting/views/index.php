<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears "></i><small> <?php echo $this->lang->line('general'); ?> <?php echo $this->lang->line('setting'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'setting', 'setting')){ ?>
                    <a href="<?php echo site_url('setting'); ?>"><?php echo $this->lang->line('general'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'setting', 'payment')){ ?>
                   | <a href="<?php echo site_url('setting/payment'); ?>"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'setting', 'sms')){ ?>
                   | <a href="<?php echo site_url('setting/sms'); ?>"><?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></a>                    
                <?php } ?>
               <!--  <?php if(has_permission(VIEW, 'frontend', 'frontend')){ ?>
                   | <a href="<?php echo site_url('frontend/index'); ?>"><?php echo $this->lang->line('manage_frontend'); ?> </a>                    
                <?php } ?> -->
            </div>
            
            
             <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                     <ul  class="nav nav-tabs bordered">                     
                        <li  class="active"><a href="#tab_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo $this->lang->line('general'); ?> <?php echo $this->lang->line('setting'); ?></a> </li> 
                     </ul>
                     <br/>
                     <div class="tab-content">
                         <div class="tab-pane fade in active"id="tab_setting">
                            <div class="x_content"> 
                                <?php $action = isset($setting) ? 'edit' : 'add'; ?>
                                <?php echo form_open_multipart(site_url('setting/'. $action), array('name' => 'setting', 'id' => 'setting', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <input type="hidden" value="<?php echo isset($setting) ? $setting->id : ''; ?>" name="id" />
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="affiliation_number"><?php echo $this->lang->line('school_code'); ?>/Affiliation Number </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="affiliation_number" value="<?php echo isset($setting) ? $setting->affiliation_number : ''; ?>"  placeholder="<?php echo $this->lang->line('affiliation_number'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('affiliation_number'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_name"><?php echo $this->lang->line('school'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="school_name" value="<?php echo isset($setting) ? $setting->school_name : ''; ?>"  placeholder="<?php echo $this->lang->line('school'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('school_name'); ?></div>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="school_ownerschool_owner">School Owner <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="school_owner" value="<?php echo isset($setting) ? $setting->school_owner : ''; ?>"  placeholder="School Owner" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('school_owner'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="phone" value="<?php echo isset($setting) ? $setting->phone : ''; ?>"  placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('phone'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Alternate Number <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="alternate_number" value="<?php echo isset($setting) ? $setting->alternate_number : ''; ?>"  placeholder="<?php echo $this->lang->line('alternate_number'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('alternate_number'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax_number"><?php echo $this->lang->line('fax_number'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="fax_number" value="<?php echo isset($setting) ? $setting->fax_number : ''; ?>"  placeholder="<?php echo $this->lang->line('fax_number'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('fax_number'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email" value="<?php echo isset($setting) ? $setting->email : ''; ?>"  placeholder="<?php echo $this->lang->line('email'); ?>" required="required" type="email">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency"><?php echo $this->lang->line('currency'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12 text-uppercase"  name="currency" value="<?php echo isset($setting) ? $setting->currency : ''; ?>"  placeholder="<?php echo $this->lang->line('currency'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('currency'); ?></div>
                                    </div>
                                </div>                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo $this->lang->line('logo'); ?> <?php if(!$setting->school_logo){ ?> <span class="required">*</span> <?php } ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <?php if($setting->school_logo){ ?>
                                            <img src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$setting->school_logo; ?>" alt="" width="70" /><br/><br/>
                                             <input name="logo_prev" value="<?php echo isset($setting) ? $setting->school_logo : ''; ?>"  type="hidden">
                                        <?php } else { ?>
                                         <img src="<?php echo IMG_URL; ?>na.png" alt="" width="70" />
                                         <?php } ?>
                                        <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>

                                            <input  class="form-control col-md-7 col-xs-12"  name="logo" id="logo" <?php if(!$setting->school_logo){ ?> required="required" <?php } ?> type="file">
                                        </div>
                                        <div class="help-block"><?php echo form_error('logo'); ?></div>
                                    </div>
                                </div>     
                                 <?php $months = get_months(); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_start_month"><?php echo $this->lang->line('session_start_month'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="session_start_month" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($months as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if(isset($setting) && $setting->session_start_month == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('session_start_month'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_end_month"><?php echo $this->lang->line('session_end_month'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="session_end_month" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($months as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if(isset($setting) && $setting->session_end_month == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('session_end_month'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="running_year"><?php echo $this->lang->line('running_year'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="running_year" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($years as $obj){ ?>
                                                <option value="<?php echo $obj->session_year; ?>" <?php if(isset($setting) && $setting->running_year == $obj->session_year){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('running_year'); ?></div>
                                    </div>
                                </div>                       
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"><?php echo $this->lang->line('address'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="address" value="<?php echo isset($setting) ? $setting->address : ''; ?>"  placeholder="<?php echo $this->lang->line('address'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('address'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="city" value="<?php echo isset($setting) ? $setting->city : ''; ?>"  placeholder="City" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('city'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <select class="form-control" name="state_id" id="state_id">
                                            <option value="">===Select State===</option>  
                                            <?php foreach($states as $state) { ?>                                  
                                            <option value="<?= $state->id;?>" <?= $setting->state_id == $state->id ? 'Selected':''?>> <?= $state->state_name; ?></option>
                                            <?php } ?>
                                        </select>    
                                        <div class="help-block"><?php echo form_error('state_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dist_id">District<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">  
                                    <?php if($state->id){ ?>
                                       <select class="form-control" id="dist_id" name="dist_id">
                                            <option value="">===Select District===</option>
                                            <?php 
                                                foreach ($districts as $district) {
                                                    if($setting->state_id == $district->state_id) {                                     
                                            ?>
                                                <option value="<?= $district->id;?>" <?= $district->id == $setting->dist_id ? 'Selected':''?> >
                                                 <?= $district->district_name; ?>
                                                </option>
                                            <?php } } ?>
                                        </select>  
                                    <?php } else { ?> 
                                        <select class="form-control" id="dist_id" name="dist_id"></select>
                                    <?php } ?>
                                        <div class="help-block"><?php echo form_error('dist_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Pin Code<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="pin_code" value="<?php echo isset($setting) ? $setting->pin_code : ''; ?>"  placeholder="Pin Code" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('pin_code'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="country" value="<?php echo isset($setting) ? $setting->country : ''; ?>"  placeholder="Country" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('country'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_default_sms">Default SMS Sender<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $services = get_sms_gateways(); ?>
                                       <select class="form-control" required="" name="is_default_sms" id="is_default_sms">
                                           <option value="">--<?php echo $this->lang->line('select'); ?>--</option>  
                                            <?php foreach($services AS $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>" <?= $key == $setting->is_default_sms ? 'selected' : '' ?> ><?php echo $value; ?></option>  
                                            <?php } ?>
                                       </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Admission Start Date<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="admission_start" value="<?php echo isset($setting) ? $setting->admission_start : ''; ?>"  placeholder="Admission Start" required="required" type="date">
                                        <div class="help-block"><?php echo form_error('admission_start'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Admission End Date<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="admission_end" value="<?php echo isset($setting) ? $setting->admission_end : ''; ?>"  placeholder="Admission End" required="required" type="date">
                                        <div class="help-block"><?php echo form_error('admission_end'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $action == 'add' ? $this->lang->line('submit') : $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>  
                        </div>  
                     </div>
                </div>
             </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#setting").validate();  

</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        //Get District on change drop box
        var site_url="http://192.168.2.50/chandan/sms/"
        $("#state_id").change(function()
        {
            var selecetedCategory=$(this).val().toString();
            $.ajax({
                url:site_url + "index.php/setting/get_dist",
                datatype:'json',
                data:{SelecetedCategory:selecetedCategory},             
                type:"POST",
                success: function(data){
                    $("#dist_id").html(data);
                    },
                    error:function(data){
                        alert("error");
                    }          
            });
        });   
        
    });
</script>