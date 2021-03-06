<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=6.5in;width=6.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.table-bordered{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;}.table{width: 100%;max-width: 100%;margin-bottom: 20px;}.table > thead:first-child > tr:first-child > th {border-top: 0px;}.table-bordered > thead > tr > th {border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image: initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.center{text-align:center}.col-40{width:40%;float:left;}.col-10{width:5%;float:left;padding-left:35%}.col-30{width:25%;float:left;line-height:28px}.clearfix{clear:both;}@page{margin:10;padding:0px;}.col-80{width:80%;float:left;}.right-text{text-align:right;}.col-33{width:33.33%;float:left;}.left-text{text-align:left;}.col-60{width:60%;float:left;}.border-top{border-top:.5px solid #ccc;}.btn-success{color: #26B99A !important;}.btn-danger{color: #ac2925 !important;}.col-50{width:48%;float:left; padding-right:1%}.invoice-col,.table,p{font-size:10px;}.margin-left{margin-left:1%;}.border-left{border-left:.5px solid #ddd;}.border-right{border-right:.5px dashed #000;}.text-justify{text-align:justify}.col-35{width:35%;float:left;}.ml-4{margin-left:5%;}.col-55{width:55%;float:left;}.col-45{width:40%;float:left;}.col-70{width:75%;float:left;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<style type="text/css">
    .btn-success {
        background: #26B99A;
        border: 1px solid #169F85;
    }
    .btn-danger{
        padding: 2px;
    }
</style>
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
            <div class="x_content quick-link no-print">
               <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
               <?php /*if(has_permission(VIEW, 'accounting', 'discount')){ ?>
                    <a href="<?php echo site_url('accounting/discount/index'); ?>"><?php echo $this->lang->line('discount'); ?></a>                  
                <?php }*/ ?> 
              
               <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                  | <a href="<?php echo site_url('accounting/feetype/index'); ?>"><?php echo $this->lang->line('fee_type'); ?></a>                  
                <?php } ?> 
                
                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                   
                   <?php if($this->session->userdata('role_id') == STUDENT || $this->session->userdata('role_id') == GUARDIAN){ ?>
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
            <div class="x_content" id="dvContainer">
                <div class="col-50 border-right">
                <section class="content invoice profile_img text-left">
                <!-- title row -->
					<div class="row invoice-info">
                            <div class="col-sm-3 invoice-header  invoice-col col-30">
                                <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                <?php } else{ ?>
                                   <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                <?php } ?>
                            </div>
                            <div class="col-sm-9 invoice-col col-70">
                                <h1 style="margin-bottom:2px !important;"><?php echo $this->gsms_setting->school_name; ?></h1>
                                <?php echo $this->gsms_setting->address; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $this->gsms_setting->phone; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('email'); ?>:</strong> <?php echo $this->gsms_setting->email; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">                         
                            <div class="col-md-12 center text-center" >
                                <h6 style="margin-top:10px;">
                                    <?php echo $this->lang->line('fee_receipt'); ?> - Office Copy
                                </h6>
                            </div>
                           
                        </div>
                        <!-- info row -->
                        <div class="clearfix"></div>
                        <div class="row invoice-info">
                            <!-- /.col -->
                            <div class="col-sm-8 invoice-col col-60">
                                <strong><?php echo $this->lang->line('student'); ?>:</strong>
                                <?php echo $invoice->name; ?><br/>
                                <strong>Address:</strong> <?php echo $invoice->present_address; ?>
                                <br><strong><?php echo $this->lang->line('class'); ?>:</strong> <?php echo $invoice->class_name; ?>
                                <br><strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $invoice->phone; ?>
                                <br><strong><?php echo $this->lang->line('admission_no'); ?>:</strong> <?php echo $invoice->admission_no; ?>                             
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col col-33">
                                 <b><?php echo $this->lang->line('fee_receipt'); ?>: #<?php echo $invoice->custom_invoice_id; ?></b>                                                     
                                <br>
                                <b><?php
                                 $btn_class = get_paid_status($invoice->paid_status) == "Paid" ? 'success' : 'danger';
                                
                                echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?>:</b>
                                 <span class="btn-<?= $btn_class ?>"><?php echo get_paid_status($invoice->paid_status); ?></span>
                                <br>
                                <b><?php echo $this->lang->line('date'); ?>:</b> <?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?>
                            </div>
                            <!-- /.col -->
                        </div>
                </section>
                <div class="clearfix"></div> <br/>
                <section class="content invoice border-top">
                    <!-- Table row -->
                    <?php echo form_open(site_url('accounting/payment/index/'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                    <div class="row">
                        <div class="col-xs-12 table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="left-text" class="col-33"><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th class="left-text" class="col-33"><?php echo $this->lang->line('fee_type'); ?></th>
                                        <th class="text-right right-text" class="col-33"><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                <tr>
                                    <td  style="width:15%"><?php echo 1; ?></td>
                                    <td  style="width:60%"> <?php echo $invoice->head; ?></td>
                                    <td><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <?php echo $invoice->net_amount; ?></td>
                                </tr>                                         
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="clearfix"></div>
                    <div class="row border-top"><br/>
                        <!-- accepted payments column -->
                         <div class="col-xs-7 col-55">
                            <p class="text-justify"><?php echo '<strong>NOTE :</strong> '.$invoice->note; ?></p>
                            <!--<p class="lead"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?>:</p>-->
                            <!--img src="<?php echo IMG_URL; ?>visa.png" alt="Visa">
                            <img src="<?php echo IMG_URL; ?>mastercard.png" alt="Mastercard">
                            <img src="<?php echo IMG_URL; ?>american-express.png" alt="American Express">
                            <img src="<?php echo IMG_URL; ?>paypal.png" alt="Paypal"-->                         
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4 col-45 col-md-offset-1 ml-4">
                            <div class="table-responsive">
                                <table class="table text-right right-text">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%"><?php echo $this->lang->line('subtotal'); ?>:</th>
                                            <td><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i>
                                            <span id="subtotal" class="subtotal"></span><?php echo $invoice->gross_amount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('discount'); ?></th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <?php  echo $invoice->inv_discount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('total'); ?>:</th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="total" class="total"></span><?php echo $invoice->net_amount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('amount'); ?>:</th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="paid_amount" class="paid_amount"></span><?php echo $paid_amount ? $paid_amount : 0.00; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('due_amount'); ?>:</th>
                                            <td class="border-top"><span class="btn-danger" style="padding: 5px;"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                               <span id="due" class="due"></span> 
                                               <?php echo $invoice->net_amount-$paid_amount; ?></span></td>
                                        </tr>
                                        <?php if($invoice->paid_status == 'paid'){ ?>
                                            <tr>
                                                <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('date'); ?>:</th>
                                                <td class="border-top"><?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            <?php if(strtolower(get_paid_status($invoice->paid_status)) != 'paid'){ ?>
                                <button class="btn btn-success pull-right hiddens" type="submit"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
             </section>
            </div>
<!---Student------>
            <div class="col-50 hidden margin-left">
                <section class="content invoice profile_img text-left">
                         <!-- title row -->
                  <div class="row invoice-info">
                            <div class="col-sm-3 invoice-header  invoice-col col-30">
                                <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                <?php } else{ ?>
                                   <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                <?php } ?>
                            </div>
                            <div class="col-sm-9 invoice-col col-70">
                                <h1 style="margin-bottom:2px !important;"><?php echo $this->gsms_setting->school_name; ?></h1>
                                <?php echo $this->gsms_setting->address; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $this->gsms_setting->phone; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('email'); ?>:</strong> <?php echo $this->gsms_setting->email; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">                         
                            <div class="col-md-12 center text-center" >
                                <h6 style="margin-top:10px;">
                                    <?php echo $this->lang->line('fee_receipt'); ?> - Student Copy
                                </h6>
                            </div>
                           
                        </div>
                        <!-- info row -->
                        <div class="clearfix"></div>
                        <div class="row invoice-info">
                            <!-- /.col -->
                            <div class="col-sm-8 invoice-col col-60">
                                <strong><?php echo $this->lang->line('student'); ?>:</strong>
                                <?php echo $invoice->name; ?><br/>
                                <strong>Address:</strong> <?php echo $invoice->present_address; ?>
                                <br><strong><?php echo $this->lang->line('class'); ?>:</strong> <?php echo $invoice->class_name; ?>
                                <br><strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $invoice->phone; ?>
                                <br><strong><?php echo $this->lang->line('admission_no'); ?>:</strong> <?php echo $invoice->admission_no; ?>                             
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col col-33">
                                 <b><?php echo $this->lang->line('fee_receipt'); ?>: #<?php echo $invoice->custom_invoice_id; ?></b>                                                     
                                <br>
                                <b><?php
                                 $btn_class = get_paid_status($invoice->paid_status) == "Paid" ? 'success' : 'danger';
                                
                                echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?>:</b>
                                 <span class="btn-<?= $btn_class ?>"><?php echo get_paid_status($invoice->paid_status); ?></span>
                                <br>
                                <b><?php echo $this->lang->line('date'); ?>:</b> <?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?>
                            </div>
                            <!-- /.col -->
                        </div>                     
                </section>
                <div class="clearfix"></div> <br/>
                <section class="content invoice border-top">
                    <!-- Table row -->
                    <?php echo form_open(site_url('accounting/payment/index/'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                    <div class="row">
                        <div class="col-xs-12 table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="left-text" class="col-33"><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th class="left-text" class="col-33"><?php echo $this->lang->line('fee_type'); ?></th>
                                        <th class="text-right right-text" class="col-33"><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                <tr>
                                    <td  style="width:15%"><?php echo 1; ?></td>
                                    <td  style="width:60%"> <?php echo $invoice->head; ?></td>
                                    <td><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <?php echo $invoice->net_amount; ?></td>
                                </tr>                                         
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="clearfix"></div>
                    <div class="row border-top"><br/>
                        <!-- accepted payments column -->
                         <div class="col-xs-7 col-55">
                            <p class="text-justify"><?php echo '<strong>NOTE :</strong> '.$invoice->note; ?></p>
                            <!--<p class="lead"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?>:</p>-->
                            <!--img src="<?php echo IMG_URL; ?>visa.png" alt="Visa">
                            <img src="<?php echo IMG_URL; ?>mastercard.png" alt="Mastercard">
                            <img src="<?php echo IMG_URL; ?>american-express.png" alt="American Express">
                            <img src="<?php echo IMG_URL; ?>paypal.png" alt="Paypal"-->                         
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4 col-45 col-md-offset-1 ml-4">
                            <div class="table-responsive">
                                <table class="table text-right right-text">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%"><?php echo $this->lang->line('subtotal'); ?>:</th>
                                            <td><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i>
                                            <span id="subtotal" class="subtotal"></span><?php echo $invoice->gross_amount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('discount'); ?></th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <?php  echo $invoice->inv_discount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('total'); ?>:</th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="total" class="total"></span><?php echo $invoice->net_amount; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('amount'); ?>:</th>
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="paid_amount" class="paid_amount"></span><?php echo $paid_amount ? $paid_amount : 0.00; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('due_amount'); ?>:</th>
                                            <td class="border-top"><span class="btn-danger" style="padding: 5px;"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                               <span id="due" class="due"></span> 
                                               <?php echo $invoice->net_amount-$paid_amount; ?></span></td>
                                        </tr>
                                        <?php if($invoice->paid_status == 'paid'){ ?>
                                            <tr>
                                                <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('date'); ?>:</th>
                                                <td class="border-top"><?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            <?php if(strtolower(get_paid_status($invoice->paid_status)) != 'paid'){ ?>
                                <button class="btn btn-success pull-right hiddens" type="submit"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
             </section>
            </div>
            
            </div>
        </div>
    </div>
</div>