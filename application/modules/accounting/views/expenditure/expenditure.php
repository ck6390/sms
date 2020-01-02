<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=6.5in;width=6.5in;');
            printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none !important}.table-bordered{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;}.table{width: 100%;max-width: 100%;margin-bottom: 20px;}.table > thead:first-child > tr:first-child > th {border-top: 0px;}.table-bordered > thead > tr > th {border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image: initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(221, 221, 221);border-image:initial;line-height: 1.42857;vertical-align: top;padding: 8px;}.center{text-align:center}.col-40{width:40%;float:left;}.col-10{width:5%;float:left;padding-left:35%}.col-30{width:25%;float:left;line-height:28px}.clearfix{clear:both;}@page{margin:10;padding:0px;}.col-80{width:80%;float:left;}.right-text{text-align:right;}.col-33{width:33.33%;float:left;}.left-text{text-align:left;}.col-60{width:60%;float:left;}.border-top{border-top:.5px solid #ccc;}.btn-success{color: #26B99A !important;}.btn-danger{color: #ac2925 !important;}.col-50{width:48%;float:left; padding-right:1%}.invoice-col,.table,p{font-size:10px;}.margin-left{margin-left:1%;}.border-left{border-left:.5px solid #ddd;}.border-right{border-right:.5px dashed #000;}.text-justify{text-align:justify}.col-35{width:35%;float:left;}.ml-4{margin-left:5%;}.col-55{width:55%;float:left;}.col-45{width:40%;float:left;}.col-70{width:75%;float:left;}.mt-neg-40{margin-top:-80px;clear:both;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_expenditure'); ?></small></h3>
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

<div class="x_content" id="dvContainer">
<div class="col-90 ml-4">
 <!-- title row -->
    <div class="row invoice-info">
         <div class="col-sm-3 invoice-header  invoice-col col-30 text-right right-text">
                            <?php if($this->session->userdata('school_logo')){?>               
                                    <img class="img-thumbnail img-circle logo" src="<?php echo $this->config->item('upload_url'); ?><?php echo 'assets/logo/'.$this->session->userdata('school_logo'); ?>" alt="" width="80" />
                                <?php } else{ ?>
                                   <img src="<?php echo IMG_URL; ?>na.png" class="img-thumbnail img-circle logo" width="80px">
                                <?php } ?>
                            </div>
                            <div class="col-sm-9 invoice-col col-70">
                                <h1 style="margin-bottom:2px !important;">&nbsp;<?php echo $this->gsms_setting->school_name; ?></h1>
                                <?php echo "&nbsp;&nbsp;".$this->gsms_setting->address; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('phone'); ?>:</strong> <?php echo $this->gsms_setting->phone; ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $this->lang->line('email'); ?>:</strong> <?php echo $this->gsms_setting->email; ?>
                            </div>
        <!--div class="col-sm-4 invoice-header  invoice-col col-33"><h1 class="hidden">Office Copy</h1></div-->
        
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12 invoice-header  invoice-col text-center col-100 center mt-neg-40">
            <h3><?php echo 'Payment/Debit Voucher';?></h3>
        </div>
    </div>
<!-- info row -->   
<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td><?php echo 'Voucher No.'; ?></td>
            <td colspan="2"><?php echo $expenditure->id; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('expenditure_head'); ?></td>
            <td colspan="2"><?php echo $expenditure->head; ?></td>
        </tr>
        <tr>
            <td><?php echo 'Being Amount Paid To'; ?></td>
            <td colspan="2"><?php echo $expenditure->payee; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('method'); ?></td>
            <td colspan="2"><?php echo $this->lang->line($expenditure->expenditure_via); ?></td>
        </tr>
        <!-- <tr>
            <td><?php echo $this->lang->line('transaction'); ?></td>
            <td colspan="2"><?php echo $expenditure->transaction; ?></td>
        </tr> -->
        <tr>
            <td><?php echo $this->lang->line('amount'); ?></td>
            <td colspan="2"><?php echo $expenditure->amount; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('amount'); ?> In Word</td>
            <td colspan="2" style="text-transform: capitalize;"><?php echo get_indian_currency($expenditure->amount); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('date'); ?></td>
            <td colspan="2"><?php echo date($this->config->item('date_format'), strtotime($expenditure->date)); ?></td>
        </tr>
        <tr>
            <td><?php echo 'Voucher'; ?> <?php echo $this->lang->line('date'); ?></td>
            <td colspan="2"><?php echo date($this->config->item('date_format'), strtotime($expenditure->created_at)); ?></td>
        </tr> 
        <tr>
            <td><?php echo $this->lang->line('remark'); ?></td>
            <td colspan="2"><?php echo $expenditure->note; ?></td>
        </tr>
        <tr style="height: 80px;">
            <td style="vertical-align: bottom;"><?php echo 'Received By'; ?></td>
            <td style="vertical-align: bottom;"><?php echo 'Prepared By'; ?></td>
            <td style="vertical-align: bottom;"><?php echo 'Authorized signatory'; ?></td>
        </tr> 
    </tbody>
</table>
</div>


</div>
<button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>

</div></div></div>
