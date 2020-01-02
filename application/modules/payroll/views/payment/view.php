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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>"></i><small> <?php echo $this->lang->line('manage_payment'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
               <?php if(has_permission(VIEW, 'payroll', 'grade')){ ?>
                    <a href="<?php echo site_url('payroll/grade/index'); ?>"><?php echo $this->lang->line('salary_grade'); ?></a>                   
                <?php } ?>              
                <?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>
                  | <a href="<?php echo site_url('payroll/payment/index'); ?>"><?php echo $this->lang->line('salary'); ?> <?php echo $this->lang->line('payment'); ?></a>                  
                <?php } ?> 
                <?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
                  | <a href="<?php echo site_url('payroll/history/index'); ?>"><?php echo $this->lang->line('payroll'); ?> <?php echo $this->lang->line('history'); ?></a>                  
                <?php } ?> 
                
            </div>
            
            <div class="x_content" id="dvContainer">
                <div class="" data-example-id="togglable-tabs">       

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

                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_payment_list" >
                            <div class="x_content">
                                <table class="table table-striped table-bordered dt-responsive" style="margin-bottom:0px;" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>
                                                    <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('id'); ?>
                                                </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('name'); ?>
                                                </strong>
                                            </td>
                                            <td><strong><?php echo $this->lang->line('month'); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $payment->unique_id; ?></td>
                                            <td><?php echo $payment->name; ?></td>
                                            <td><?php echo date('M ,Y', strtotime($payment->salary_month)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tbody>
                                    
                                    <tr>
                                        <td><?php echo $this->lang->line('grade_name'); ?></td>
                                        <td><?php echo $payment->grade_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('salary_type'); ?></td>
                                        <td><?php echo $this->lang->line(strtolower($payment->salary_type)); ?></td>
                                    </tr>
                                    
                                    
                                    <?php if(strtolower($payment->salary_type) == 'monthly'){ ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('basic_salary'); ?> </td>
                                            <td><?php echo $payment->basic_salary; ?></td>
                                        </tr>      
                                    <?php } ?>
                                    
                                             
                                    <tr>
                                        <td><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?></td>
                                        <td><?php echo $payment->total_deduction; ?></td>
                                    </tr>        
                                    <tr>
                                        <td><?php echo $this->lang->line('gross_salary'); ?></td>
                                        <td><?php echo $payment->gross_salary; ?></td>
                                    </tr>               
                                    <tr>
                                        <td><?php echo $this->lang->line('net_salary'); ?></td>
                                        <td><?php echo $payment->net_salary; ?></td>
                                    </tr>               
                                    <tr>
                                        <td><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?></td>
                                        <td><?php echo $this->lang->line($payment->payment_method); ?></td>
                                    </tr>
                                    <tr>
                                        <?php $monthnumber = date('m', strtotime($payment->salary_month));?>
                                        <td>Total Days ( <?php echo $month." - ".$year; ?> )</td>
                                        <td><?php echo $day_in_month = cal_days_in_month(CAL_GREGORIAN,$monthnumber,$year) ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Salary / Days</td>
                                        <td>
                                            <?php 

                                                $salary_per_days = $payment->basic_salary / $day_in_month; 
                                                echo $day_salary = number_format((float)$salary_per_days, 2, '.', '');
                                            ?>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>Working Hours / Days</td>
                                        <td> 
                                            <?php 
                                                $in_time = new DateTime(current($employees)->in_time);
                                                $out_time = new DateTime(current($employees)->out_time);
                                                $interval = $in_time->diff($out_time);

                                                echo $working_hrs = $interval->format('%hh %im');
                                            ?>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>Salary Hours / Days</td>
                                        <td>
                                            <?php 
                                                $decimal_time = number_format((float)$working_hrs, 2, '.', ''); 
                                                $salary_per_hrs = $salary_per_days / $decimal_time ; 
                                                echo $singleDaySalary = number_format((float)$salary_per_hrs, 2, '.', '');
                                            ?>
                                        </td> 
                                    </tr>
                                    
                                    <?php if ($payment->payment_method == 'cheque') { ?>
                                    
                                        <tr>
                                            <td><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?></td>
                                            <td><?php echo $payment->bank_name; ?></td>
                                        </tr>               
                                        <tr>
                                            <td><?php echo $this->lang->line('cheque'); ?></td>
                                            <td><?php echo $payment->cheque_no; ?></td>
                                        </tr>               
                                    <?php } ?> 
                                    
                                    <tr>
                                        <td><?php echo $this->lang->line('note'); ?></td>
                                        <td><?php echo $payment->note; ?></td>
                                    </tr>               
                                </tbody>
                            </table>




                            <table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="8" class="text-center"><strong>Salary Sheet (Datewise)</strong> </th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><strong>Days</strong></th>
                                        <th><strong>In Time</strong></th>
                                        <th><strong>Out Time</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Total Late IN/early OUT</strong></th>
                                        <th><strong>Total Working Hours</strong></th>
                                        <th><strong>Salary Per Day</strong></th>
                                        <th><strong>Deducted</strong></th>
                                        <th><strong>Day Salary</strong></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                        <?php 
                                          $holidays = get_holidays();
                                          $month_start_date =  $payment->salary_month; 
                                          $all_sun = ""; 
                                          for($i = 1; $i<=$days; $i++ ){ 
                                            $get_sun = date("D", strtotime($month_start_date.'+'.($i-1).'days'));
                                            if($get_sun == "Sun"){
                                                $all_sun[$i]=$get_sun;
                                                
                                            }else{
                                                $all_sun[$i]= "";
                                            }
                                        ?>
                                        <?php }  ?>

                                        <?php 
                                        if ($payment_to == 'employee') {
                                            $attendance = @get_employee_monthly_attendance(current($employees)->id, $academic_year_id, $month_number ,$days); 
                                        }else{
                                             $attendance = @get_teacher_monthly_attendance(current($employees)->id, $academic_year_id, $month_number ,$days); 
                                        }

                                        ?>
                                        <?php if(!empty($attendance)){ ?>
                                                <?php if(!empty($attendance->attendance_data)){ 
                                                $attendance_data = json_decode($attendance->attendance_data);
                                                //echo "<PRe>";
                                                //print_r($attendance_data);
                                                //die;
                                                ?>
                                        <?php foreach($attendance_data AS $key ){ ?>
                                            <tr>
                                            <td><?php echo date('d-m-Y', strtotime($key->attendance_date)); //echo $key->day;?></td>
                                            <?php if($key->attendance != "P"){?>       
                                                <td colspan="5"  class="text-center">
                                                    <b> 
                                                    <?php
                                                        foreach($holidays as $val){
                                                            $begin = new DateTime($val->date_from);
                                                            $end = new DateTime($val->date_to);
                                                            $end = $end->modify( '+1 day' ); 

                                                            $interval_h = new DateInterval('P1D');
                                                            $daterange = new DatePeriod($begin, $interval_h ,$end);

                                                            foreach($daterange as $date){
                                                                if(strtotime($date->format("Y-m-d")) == strtotime($key->attendance_date)){
                                                                    echo $today_holiday = "<b class='btn-warning btn btn-xs' title=".$val->title.">H</b>";
                                                                } 
                                                            }
                                                        }  
                                                    ?>
                                                       <?php if(@$all_sun[$key->day]){ 
                                                            echo '<span><strong> Weekend Holiday - Sunday</strong></span>';
                                                        }else{
                                                             echo '<span><strong> Absent</strong></span>';
                                                        }
                                                        ?>
                                                         
                                                    </b>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                    <?php if($key->attendance == "P"){
                                                    echo '<small>'.$key->attendance_time.'</small>';
                                                    }else{
                                                        echo "--";
                                                    }?>
                                                 </td>
                                                <td><?php if($key->attendance == "P"){
                                                    echo '<small>'.@$key->out_time.'</small>';
                                                   }else{
                                                    echo "--";
                                                   } ?>
                                                </td>
                                                <td>

                                                    <?php 
                                                    if($key->attendance == "P"){
                                                    $dailyInTime = new DateTime($key->attendance_time);
                                                    $lateInTimeDiff = $in_time->diff($dailyInTime);

                                                    if($dailyInTime < $in_time ){

                                                        echo $lateInTime = '<span class="text-success"><strong>'.$lateInTimeDiff->format('%hh %im').' Before</strong></span>';
                                                    }else{

                                                        echo $lateInTime = '<span class="text-success"><strong>'.$lateInTimeDiff->format('%h:%i').' Hour Late</strong></span>';
                                                    }
                                                }else{
                                                    echo "--";
                                                }
                                                ?>                                                
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($key->attendance == "P"){
                                                        if($dailyInTime > $in_time ){
                                                            $deducted_whrs = ceil($lateInTimeDiff->format('%h.%i'));
                                                         if($deducted_whrs !=0){

                                                            echo $deducted_whrs." Hour";
                                                         }
                                                        }    
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($key->attendance == "P"){
                                                        if($dailyInTime > $in_time ){
                                                            echo round($interval->format('%h.%i'))-$deducted_whrs."  Hour ";
                                                        }else{
                                                            echo round($interval->format('%h.%i'))."  Hour ";
                                                        }
                                                    }
                                                    ?>  
                                                </td>
                                        <?php }?>
                                            <td>
                                                <?php echo $day_salary; ?>
                                            </td>
                                            <td>
                                                <span class="text-danger"><strong>
                                                    <?php
                                                    if($key->attendance == "P"){
                                                        if($dailyInTime > $in_time ){
                                                            $deductSalary = $deducted_whrs*$singleDaySalary;

                                                            if($deductSalary !=0){
                                                                echo $deductSalary;
                                                            }
                                                        }
                                                    }elseif(($key->attendance == "A" || $key->attendance == "") && empty(@$all_sun[$key->day]))
                                                    {
                                                        echo $day_salary;
                                                    }
                                                    ?>
                                                </strong></span>
                                            </td>
                                            <td class="day_salary">
                                                <?php 
                                                if($key->attendance == "P" || !empty(@$all_sun[$key->day])){
                                                    if(@$dailyInTime > $in_time && empty(@$all_sun[$key->day])){
                                                        echo $day_salary-$deductSalary;
                                                    }else{
                                                        echo $day_salary;
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>     
                                         <?php } ?>
                                            <?php } }?>
                                    
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="text-align:right">Total</th>
                                    <th id="salary"></th>
                            </tfoot>
                            </table>

                            <table class="table table-striped table-bordered table-hover ">
                            <thead>
                                <th colspan="5" class="text-center">Extra Payouts</th>
                            </thead>
                            <thead>
                                <th>Date</th>
                                <th>Work For (EMP ID)</th>
                                <th>Type of Work</th>
                                <th>Remark</th>
                                <th>Amount</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total Extra Pay</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Other Allowance</th>
                                    <th class="allowance"><?php echo $payment->total_allowance; ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4"  class="text-right">Gross Salary</th>
                                    <th id="gross" class="gross"></th>
                                </tr>
                                <tr>
                                    <th colspan="5" id="in_word" class=" text-center"></th>
                                </tr>
                            </tfoot>
                        </table>

                            </div>
                        </div>
                               
                        <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default hiddens" type="button" id="btnPrint"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var sum = 0;
    // iterate through each td based on class and add the values
    $(".day_salary").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0 && value.trim() != '') {
            sum = parseFloat(value) + parseFloat(sum);
        }
    });
    sum = sum.toFixed(2);
    $('#salary').text(sum); 
    var salary = $(this).find("#salary").text(); 
    var allowance = $(this).find(".allowance").text();  
    var gross_salary = parseFloat(salary) + parseFloat(allowance);
    $('.gross').text(gross_salary); 
    //var salary = $(this).find("#salary").text();
    /*var allowance = $(this).find(".allowance").text();  
    var gross_salary = parseFloat(salary) + parseFloat(allowance);
    $('.gross').text(gross_salary); */
    //$('.in_word').text(gross_salary); 
});
</script>