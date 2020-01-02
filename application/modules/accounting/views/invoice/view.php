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
                <?php } */ ?> 
              
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
            <?php $year_quarters = get_year_quarters();?>  
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
                                    <?php echo $this->lang->line('fee_receipt'); ?><?php 
                                        if($invoice->year_quarter){
                                            echo '('.$year_quarters[$invoice->year_quarter].')' .' - ';
                                        }
                                       echo ' Office Copy';
                                    ?>                                    
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
                                <b><?php echo $this->lang->line('fee_receipt'); ?>: #<?php echo $invoice->invoice_number; ?></b>
                                <br>
                                <b><?php
                                 $btn_class = get_paid_status($invoice->payment_status) == "Paid" ? 'success' : 'danger';
                                
                                echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?>:</b>
                                 <span class="btn-<?= $btn_class ?>"><?php echo get_paid_status($invoice->payment_status); ?></span>
                                <br>
                                <b><?php echo $this->lang->line('date'); ?>:</b> <?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?>
                                 <br>
                                <b><?php echo $this->lang->line('academic_year'); ?>:</b> <?php echo $invoice->session_year;?>
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
                                <?php if(!empty($invoicelist)){
                                    $i = 1;
                                    foreach ($invoicelist as $invoiceData) {
                                ?>
                                    <tr>
                                        <td class="border-top"><br/><?php echo $i; ?>
                                            <input name="inv_ids[]" class="invid hiddens" data-amount="<?php echo $invoiceData->net_amount; ?>" <?php echo ($invoiceData->paid_status == 'paid')? 'disabled' : ''; ?>  value="<?php echo $invoiceData->inv_id; ?>" <?php echo ($invoiceData->paid_status == 'paid')? '' : 'checked="checked"'; ?> type="checkbox">
                                        </td>
                                        <td class="border-top"><br/>                                        
                                        <?php 
                                            $btn_class = $invoiceData->paid_status == "paid" ? "success" : "danger";
                                            echo $invoiceData->head.' ['.date('F', mktime(0, 0, 0, $invoiceData->month, 10)).']' .' <span class="btn-'.$btn_class.'">'.get_paid_status($invoiceData->paid_status).'</span>'; 
                                        ?>
                                        </td>
                                        <td class="right-text text-right border-top"><br/><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                            <?php echo $invoiceData->net_amount; ?>
                                        </td>
                                    </tr>
                                <?php $i++; } }?>   
                                <tr><td></td>
                                    <td></td>
                                    <td> 
                                    <input  class="form-control hiddens col-md-7 col-xs-12 paid_amount_text" name="amount"  id="amount" value="" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="input" step="any" autocomplete="off">
                                     <input class="due_amount_text" name="due_amount_text"  id="due_amount_text" value="<?php echo $invoice->net_amount-$invoice->paid_amount; ?>" required="required" type="hidden" step="any" autocomplete="off">
                                </td></tr>                                      
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
                                            <span id="subtotal" class="subtotal"></span><?php echo $invoice->net_amount; //echo $invoice->gross_amount; ?></td>
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
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="paid_amount" class="paid_amount"></span><?php echo $invoice->paid_amount ? $invoice->paid_amount : 0.00; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('due_amount'); ?>:</th>
                                            <td class="border-top"><span class="btn-danger" style="padding: 5px;"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                               <!--span id="due" class="due"></span--> 
                                               <?php echo $invoice->net_amount-$invoice->paid_amount; ?><!--</span>--></td>
                                        </tr>
                                        <?php if($invoice->paid_status == 'paid'){ ?>
                                            <tr>
                                                <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('date'); ?>:</th>
                                                <td class="border-top"><?php echo date($this->config->item('date_format'), strtotime($invoice->paid_date)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                     <div class="row no-print">
                        <div class="col-xs-12">
                            <div class="col-xs-6 col-50"><p>Date .............</p></div>
                            <div class="col-xs-6 col-50"><p>Signature ..................</p></div>
                        </div>
                        <br><br>
                    </div>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            <?php if(strtolower(get_paid_status($invoice->payment_status)) != 'paid'){ ?>
                                <!--a href="<?php echo site_url('accounting/payment/index/'.$invoice->inv_id); ?>"><button class="btn btn-success pull-right hiddens"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button></a-->
                                <button class="btn btn-success pull-right hiddens" type="submit"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button>
                                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
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
                                    <?php echo $this->lang->line('fee_receipt'); ?><?php 
                                        if($invoice->year_quarter){
                                            echo '('.$year_quarters[$invoice->year_quarter].')' .' -';
                                        }
                                        echo ' Student Copy';
                                    ?>                                    
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
                                <b><?php echo $this->lang->line('fee_receipt'); ?>: #<?php echo $invoice->invoice_number; ?></b>                                                     
                                <br>
                                <b><?php
                                 $btn_class = get_paid_status($invoice->payment_status) == "Paid" ? 'success' : 'danger';
                                
                                echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?>:</b>
                                 <span class="btn-<?= $btn_class ?>"><?php echo get_paid_status($invoice->payment_status); ?></span>
                                <br>
                                <b><?php echo $this->lang->line('date'); ?>:</b> <?php echo date($this->config->item('date_format'), strtotime($invoice->created_at)); ?>
                                 <br>
                                <b><?php echo $this->lang->line('academic_year'); ?>:</b> <?php echo $invoice->session_year;?>
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
                                <?php if(!empty($invoicelist)){
                                    $i = 1;
                                    foreach ($invoicelist as $invoiceData) {
                                ?>
                                    <tr>
                                        <td class="border-top"><br/><?php echo $i; ?>
                                            <input name="inv_ids[]" class="invid hiddens" data-amount="<?php echo $invoiceData->net_amount; ?>" <?php echo ($invoiceData->paid_status == 'paid')? 'disabled' : ''; ?>  value="<?php echo $invoiceData->inv_id; ?>" <?php echo ($invoiceData->paid_status == 'paid')? '' : 'checked="checked"'; ?> type="checkbox">
                                        </td>
                                        <td class="border-top"><br/>                                        
                                        <?php 
                                            $btn_class = $invoiceData->paid_status == "paid" ? "success" : "danger";
                                            echo $invoiceData->head.' ['.date('F', mktime(0, 0, 0, $invoiceData->month, 10)).']' .' <span class="btn-'.$btn_class.'">'.get_paid_status($invoiceData->paid_status).'</span>'; 
                                        ?>
                                        </td>
                                        <td class="right-text text-right border-top"><br/><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                            <?php echo $invoiceData->net_amount; ?>
                                        </td>
                                    </tr>
                                <?php $i++; } }?>   
                                <tr><td></td>
                                    <td></td>
                                    <td> 
                                    <input  class="form-control hiddens col-md-7 col-xs-12 paid_amount_text" name="amount"  id="amount" value="" placeholder="<?php echo $this->lang->line('amount'); ?>" required="required" type="input" step="any" autocomplete="off">
                                     <input class="due_amount_text" name="due_amount_text"  id="due_amount_text" value="<?php echo $invoice->net_amount-$invoice->paid_amount; ?>" required="required" type="hidden" step="any" autocomplete="off">
                                </td></tr>                                      
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
                                            <span id="subtotal" class="subtotal"></span><?php echo $invoice->net_amount; //echo $invoice->gross_amount; ?></td>
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
                                            <td class="border-top"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> <span id="paid_amount" class="paid_amount"></span><?php echo $invoice->paid_amount ? $invoice->paid_amount : 0.00; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="border-top"><?php echo $this->lang->line('due_amount'); ?>:</th>
                                            <td class="border-top"><span class="btn-danger" style="padding: 5px;"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>" style="color:#000;"></i> 
                                               <!--span id="due" class="due"></span--> 
                                               <?php echo $invoice->net_amount-$invoice->paid_amount; ?><!--</span>--></td>
                                        </tr>
                                        <?php if($invoice->paid_status == 'paid'){ ?>
                                            <tr>
                                                <th class="border-top"><?php echo $this->lang->line('paid'); ?> <?php echo $this->lang->line('date'); ?>:</th>
                                                <td class="border-top"><?php echo date($this->config->item('date_format'), strtotime($invoice->paid_date)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                     <div class="row no-print">
                        <div class="col-xs-12">
                            <div class="col-xs-6 col-50"><p>Date .............</p></div>
                            <div class="col-xs-6 col-50"><p>Signature ..................</p></div>
                        </div>
                        <br><br>
                    </div>
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            <?php if(strtolower(get_paid_status($invoice->payment_status)) != 'paid'){ ?>
                                <!--a href="<?php echo site_url('accounting/payment/index/'.$invoice->inv_id); ?>"><button class="btn btn-success pull-right hiddens"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button></a-->
                                <button class="btn btn-success pull-right hiddens" type="submit"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('submit'); ?> <?php echo $this->lang->line('payment'); ?></button>
                                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
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

<script type="text/javascript">
$(document).ready(function() {
    $('.btn-success').prop('disabled', true);
    //calculateAmount();    
});
$(".invid").change(function() {    
       // calculateAmount()
});
function calculateAmount(){
    var  tamount = 0;
    var  tpaid_amount = 0;
        $('input.invid:checked').each(function() {
             amount = parseInt($(this).data('amount'));  
             tamount = parseInt(tamount) + parseInt(amount);
             console.log(tamount);
        });
        $('input.invid:unchecked').each(function() {
            paid_amount = parseInt($(this).data('amount'));  
            tpaid_amount = parseInt(tpaid_amount) + parseInt(paid_amount);
            console.log(tpaid_amount);
        });
        $(".subtotal").html(tamount);
        $(".total").html(tamount);
        //$(".paid_amount").text(tpaid_amount);
        $(".due").html(tamount);
        
    }
    $(".paid_amount_text").change(function() { 
        var due_amount = $('.due_amount_text').val();         
        if(parseInt($(this).val()) > parseInt(due_amount)){
            $(this).css({"border-color": "#8A0808", 
             "border-width":"1px", 
             "border-style":"solid"});
            alert('Kindly enter equivalent or less than due amount');
        }else{
            $('.btn-success').prop('disabled', false);
             $(this).css({"border-color": "#ddd", 
             "border-width":"1px", 
             "border-style":"solid"});
        }
    });

</script>
