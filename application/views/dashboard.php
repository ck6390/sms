<!--Upload file into Github-->
<div class="container">
  <div class="content-wrapper border-bottom white-bg page-heading">
  <div class="row">
    <div class="col-lg-2 col-md-4">
      <div class="dashboard-summery-one mg-b-20"  style="background-color:#00a65a;text-align:center;border-radius:5px;">
        <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
          <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:14px;letter-spacing:2px;" ><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('student'); ?> </b>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3" style="color:#ffff;padding-left:20px;">
            <img src="<?=base_url();?>assets/dashboard/student.png" class="new-icon">
          </div>
          <div class="col-sm-9 col-md-9 col-lg-9">   
            <div class="item-number"><span class="counter" data-num="150000"><?php echo $total_student ? $total_student : 0; ?></span>
            </div>
            <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
          </div>
          </div>
        </div>
      </div>
   
  <div class="col-lg-2 col-md-4">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#d9534f;text-align:center; border-radius:5px;">
          <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
             <div class="col-sm-12 col-md-12 col-lg-12  item-title" style="padding-bottom:5px;">
              <b style="font-size:14px;letter-spacing:2px;"> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('teacher'); ?></b>
            </div>
              <div class="col-sm-3 col-md-3 col-lg-3"style="color:#ffff;padding-left:20px;">
                <img src="<?=base_url();?>assets/dashboard/teacher.png" class="new-icon">
              </div>
              <div class="col-sm-9 col-lg-9 col-md-9">
                <div class="item-number">
                  <span class="counter" data-num="150000"><b><?php echo $total_teacher ? $total_teacher : 0; ?> </b>
                  </span>
                </div>
                <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
              </div>
          </div>
      </div>
    </div>
  <div class="col-lg-2 col-md-4">
    <div class="dashboard-summery-one mg-b-20 bg-primary"  style="text-align:center; border-radius:5px;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:14px;letter-spacing:2px;"> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('guardian'); ?></b>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3" style="color:#ffff;padding-left: 20px;">
          <img src="<?=base_url();?>assets/dashboard/guardians.png" class="new-icon">
        </div>
          <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="item-number">
              <span class="counter" data-num="150000"><b><?php echo $total_guardian ? $total_guardian : 0; ?></b></span>
            </div>
            <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
          </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-2 col-md-4">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#1C5D5D;;text-align:center; border-radius:5px;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:14px; letter-spacing:2px;"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('employee'); ?></b>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3"style="color:#ffff;padding-left: 20px;">
          <img src="<?=base_url();?>assets/dashboard/worker.png" class="new-icon">
        </div>
        <div class="col-md-9 col-sm-9 col-lg-9">
          <div class="item-number">
            <span class="counter" data-num="150000"><b><?php echo $total_employee ? $total_employee :0; ?></b></span>
          </div>
          <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-md-4">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#AE1438;;text-align:center; border-radius:5px;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:14px;letter-spacing:2px;"><?php echo $this->lang->line('total'); ?> Collection</b>
        </div>
          <div class="col-sm-3  col-md-3 col-lg-3" style="color:#ffff;padding-left: 20px;">
            <img src="<?=base_url();?>assets/dashboard/collection.png" class="new-icon">
          </div>
          <div class="col-sm-9 col-lg-9 col-md-9">
            <div class="item-number">
              <span class="counter" data-num="150000"><b><i class="fa fa-rupee"></i>&nbsp;<?php echo $total_income ? $total_income : '0.00'; ?></b></span>
            </div>
            <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
          </div>
        </div>
      </div>
    </div>
    
  <div class="col-lg-2 col-md-4">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#218F76;text-align:center; border-radius:5px;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:14px;letter-spacing:2px;"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('expenditure'); ?></b>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3" style="color:#ffff;padding-left: 20px;">
          <img src="<?=base_url();?>assets/dashboard/collection.png" class="new-icon">
        </div>
          <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="item-number">
              <span class="counter" data-num="150000"><b><i class="fa fa-rupee"></i>&nbsp;<?php echo $total_expenditure? $total_expenditure : '0.00'; ?></b></span>
            </div>
            <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- </div> 
</div> -->
<!--testing/-->
<!-----top header---->
<!-- <div class="container">
<div class="content-wrapper border-bottom white-bg page-heading"> -->

<div class="row"style="padding-top:20px;">
    <div class="col-md-8 col-sm-8 col-xs-12 ">       
        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
            <div class="row" >
            <?php if($this->session->userdata('user_type') == "School"){  ?>
            <div class="col-lg-3 col-md-3">
                <div class="dashboard-summery-one mg-b-20"  style="background-color:#ec971f;text-align:center;border-radius:5px;">
                    <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
                        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
                        <a href="<?php echo site_url('attendance/student'); ?>" style="color:white;">
                        <b style="font-size:12px;letter-spacing:1px;" >Student Attandance</b>
                        </a>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3" style="color:#ffff;padding-left:20px;">
                          <img src="<?=base_url();?>assets/dashboard/student.png" class="new-icon">
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-9">   
                          <div class="item-number"><span class="counter" data-num="150000"> 
                        <?php 
                            $today = date('Y-m-d');
                            $result = $this->db->query("SELECT * FROM student_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                            echo $result->num_rows();
                        ?>
                            
                        </span>
                          </div>
                          <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ;    ?></b></span>
                        </div>
                    </div>
                </div>
            </div>
   
  <div class="col-lg-3 col-md-3">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#1C5D5D;text-align:center; border-radius:5px;">
          <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
             <div class="col-sm-12 col-md-12 col-lg-12  item-title" style="padding-bottom:5px;">
            <a href="<?php echo site_url('attendance/teacher'); ?>" style="color:white;">
              <b style="font-size:12px;letter-spacing:1px;"> Teacher Attandance</b>
            </a>
            </div>
              <div class="col-sm-3 col-md-3 col-lg-3"style="color:#ffff;padding-left:20px;">
                <img src="<?=base_url();?>assets/dashboard/teacher.png" class="new-icon">
              </div>
              <div class="col-sm-9 col-lg-9 col-md-9">
                <div class="item-number">
                  <span class="counter" data-num="150000"><b>
                    <?php 
                        $today = date('Y-m-d');
                        $result = $this->db->query("SELECT * FROM teacher_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                        echo $result->num_rows();
                    ?>
                        
                    </b>
                  </span>
                </div>
                <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
              </div>
          </div>
      </div>
    </div>
  <div class="col-lg-3 col-md-3">
    <div class="dashboard-summery-one mg-b-20"  style="text-align:center; border-radius:5px;background-color:#AE1438;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
        <a href="<?php echo site_url('attendance/employee'); ?>" style="color:white;">
          <b style="font-size:12px;letter-spacing:1px;"> Employee Attandance </b>
        </a>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3" style="color:#ffff;padding-left: 20px;">
          <img src="<?=base_url();?>assets/dashboard/worker.png" class="new-icon">
        </div>
          <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="item-number">
                <span class="counter" data-num="150000">
                    <b>
                    <?php 
                        $today = date('Y-m-d');
                        $result = $this->db->query("SELECT * FROM employee_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                        echo $result->num_rows();
                    ?>
                    </b>
                 </span>
            </div>
            <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
          </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-3 col-md-3">
    <div class="dashboard-summery-one mg-b-20"  style="background-color:#218F76;;text-align:center; border-radius:5px;">
      <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
        <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
          <b style="font-size:12px; letter-spacing:1px;">Due Payment</b>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3"style="color:#ffff;padding-left: 20px;">
          <img src="<?=base_url();?>assets/dashboard/collection.png" class="new-icon">
        </div>
        <div class="col-md-9 col-sm-9 col-lg-9">
          <div class="item-number">
            <span class="counter" data-num="150000"><b><?= $total_dues? $total_dues : '0.00'; ?></b></span>
          </div>
          <span><b><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></b></span>
        </div>
      </div>
    </div>
  </div>
  
               <!--  <div class="col-md-3">
                    <a href="<?php echo site_url('attendance/student'); ?>" class="btn btn-lg btn-info btn-block"><small>
                       Student <br/>Attandance<br/> Today -  <span class="badge">
                        <?php 
                            $today = date('Y-m-d');
                            $result = $this->db->query("SELECT * FROM student_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                            echo $result->num_rows();
                        ?></span><br/>
                       </small></a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo site_url('attendance/teacher'); ?>" class="btn btn-lg btn-success btn-block"><small>Teacher <br/>Attandance<br/>Today -  <span class="badge">
                        <?php 
                            $today = date('Y-m-d');
                            $result = $this->db->query("SELECT * FROM teacher_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                            echo $result->num_rows();
                        ?></span></small></a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo site_url('attendance/employee'); ?>" class="btn btn-lg btn-primary btn-block"><small>Employee <br/>Attandance<br/>Today -  <span class="badge">
                        <?php 
                            $today = date('Y-m-d');
                            $result = $this->db->query("SELECT * FROM employee_attendances WHERE attendance_data LIKE '%\"attendance\":\"P\",\"attendance_date\":\"{$today}\"%'");
                            echo $result->num_rows();
                        ?></span></small></a>
                </div>
            <?php } if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
                <div class="col-md-3">
                    <a href="<?php echo site_url('accounting/invoice/due'); ?>" class="btn btn-lg btn-danger btn-block"><small>
                        Due <br/>Payment<br/>
                    Today -  <span class="badge"><?= $total_dues? $total_dues : '0.00'; ?></span>
                    </small></a>
                </div>
            <?php } if($this->session->userdata('user_type') == "School"){?> -->
                <!-- <div class="col-md-3">
                    <a href="<?php echo site_url('accounting/invoice/index'); ?>" class="btn btn-lg btn-warning btn-block">Manage <br/>Invoice</a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo site_url('accounting/invoice/add'); ?>" class="btn btn-lg btn-danger btn-block">Fee <br/>Collection</a>
                </div> 
                <div class="col-md-3">
                    <a href="<?php echo site_url('accounting/expenditure'); ?>" class="btn btn-lg btn-info btn-block">Manage <br/>Expenditure</a>
                </div>
                <div class="col-md-3">
                    <a href="<?php echo site_url('accounting/income'); ?>" class="btn btn-lg btn-primary btn-block">Manage <br/>Income</a>
                </div>   -->  
            <?php }?>            
               

                


                </div>                

                    

        </div>   
 <div class="col-md-4 col-sm-4 col-xs-12 no-padding">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
               
            <div class="dashboard-summery-one mg-b-20"  style="background-color:#d9534f;text-align:center;      border-radius:5px;">
              <div class="row align-items-center" style="padding-top:5px; padding-bottom:5px;color:#ffff;">
               <!--  <div class="col-sm-12 col-md-12 col-lg-12 item-title"style="padding-bottom:5px;">
                   <b style="font-size:14px; letter-spacing:2px;">SMS Balance</b>
                </div> -->
                <div class="col-md-3 col-sm-3 col-lg-3"style="color:#ffff;padding-left: 20px;">
                    <img src="<?=base_url();?>assets/dashboard/sms(2).png" class="new-icon" style="padding-top: 12px;">
                </div>
                <div class="col-md-9 col-sm-9 col-lg-9">
                    <div class="item-number">
                    <b> 
                        <div class="x_content">
                            <?php 
                                $val = @json_decode(check_sms(),true);
                                echo "<h3>Available SMS - ".@$val[0]['routeBalance']."</h3>";
                            ?>
                        </div>
                    </b>
                    </div>
                </div>
              </div>
            </div>

            </div>
        </div>
    </div>    
</div>
</div>
</div>
<!---/top header-->
<!-- top tiles -->
<!-- 

<div class="row tile_count">

     <?php 
     //echo $this->session->userdata('role_id');
     if(has_permission(VIEW, 'student', 'student')){    
        if($this->session->userdata('role_id') != "3")
        {
        ?>

    <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

        <div class="stats-count-inner">

            <span class="count_top"><i class="fa fa-group"></i> 

                <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('student'); ?>                

            </span>

            <div class="count"><?php echo $total_student ? $total_student : 0; ?></div>

            <span class="count_bottom">

                <?php if($this->session->userdata('role_id') == STUDENT){ ?>

                    <?php echo $this->lang->line('class'); ?> <?php echo $class_name; ?><br/>

                <?php } ?>

                <?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?>

            </span>

        </div>

    </div>

     <?php }} if($this->session->userdata('user_type') == "School"){?>

     <?php if(has_permission(VIEW, 'guardian', 'guardian') && $this->session->userdata('role_id') != STUDENT){ ?>

    <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

        <div class="stats-count-inner">

            <span class="count_top"><i class="fa fa-paw"></i> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('guardian'); ?></span>

            <div class="count"><?php echo $total_guardian ? $total_guardian : 0; ?></div>

            <span class="count_bottom"><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></span>

        </div>

    </div>

     <?php } ?>

    <?php if(has_permission(VIEW, 'teacher', 'teacher')){ ?>

    <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

        <div class="stats-count-inner">

            <span class="count_top"><i class="fa fa-users"></i> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('teacher'); ?></span>

            <div class="count"><?php echo $total_teacher ? $total_teacher : 0; ?></div>

            <span class="count_bottom"><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></span>

        </div>

    </div>

    <?php } ?>

    <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>

    <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

        <div class="stats-count-inner">

            <span class="count_top"><i class="fa fa-users"></i> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('employee'); ?></span>

            <div class="count"><?php echo $total_employee ? $total_employee :0; ?></div>

            <span class="count_bottom"><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></span>

        </div>

    </div>

    <?php } ?>

    <?php if(has_permission(VIEW, 'accounting', 'income')){ ?>

        <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

            <div class="stats-count-inner">

                <span class="count_top"><strong class="green"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>"></i></strong> <?php echo $this->lang->line('total'); ?> Collection</span>

                <div class="count green"style="color: white;"><?php echo $total_income ? $total_income : '0.00'; ?></div>

                <span class="count_bottom"><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></span>

            </div>

        </div>

     <?php } ?>

    <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>

    <div class="col-md-2 col-sm-4 col-xs-12 tile_stats_count">

        <div class="stats-count-inner">

            <span class="count_top"> <strong class="red"><i class="fa fa-<?php echo $this->gsms_setting->currency; ?>"></i></strong> <?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('expenditure'); ?></span>

            <div class="count red" style="color: white;"><?php echo $total_expenditure? $total_expenditure : '0.00'; ?></div>

            <span class="count_bottom"><?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></span>

        </div>

    </div>

     <?php } } ?>

    
 -->
<!-- </div> -->

<!-- /top tiles -->
<!-- testing -->
<!-- /testing -->
<div class="container">

<div class="content-wrapper border-bottom white-bg page-heading">
   <section class="content">
        <div class="row"> 
        <div><h5><img src="<?=base_url();?>assets/dashboard/hr.png" style="height:20px; width:20px;">&nbsp;
          <strong>Human Resource</strong></h5></div>          
           <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#AE1438;">
                      <div class="row">
                          <div class="col-xs-3" style="color:white;">
                              <img src="<?=base_url();?>assets/dashboard/reading.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div style="color:white;">Student &nbsp;
                           
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/student/index"style="color:#AE1438;">
                      <div class="panel-footer p-3">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>
         
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading bg-primary">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/teacher.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Teacher &nbsp;
                             
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/teacher" >
                      <div class="panel-footer  bg-white text-primary">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 

             

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading "style="background-color:#a97d1e;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/account.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Guardian &nbsp;
                              
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/guardian/index/">
                      <div class="panel-footer  bg-white"style="color:#a97d1e;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#1C5D5D;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                               <img src="<?=base_url();?>assets/dashboard/employee.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Employee &nbsp;
                              
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/hrm/employee">
                      <div class="panel-footer bg-white"style="color:#1C5D5D;">
                          <span class="pull-left" >View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>      
       </div>
      </div>
   <!--  </div> -->
    </section>
    <section>
   <!--   <div class="container"> -->
     <div class="row"> 
        <div><h5><img src="<?=base_url();?>assets/dashboard/exam.png" style="height:20px; width:20px;">&nbsp;<strong>Academic information</strong></h5></div>       
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#d63031;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/class.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Class &nbsp;
                              
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/academic/classes/index" >
                      <div class="panel-footer bg-white"style="color:#d63031;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading p-3" style="background-color:#6ab04c;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                               <img src="<?=base_url();?>assets/dashboard/class.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Section &nbsp;
                              
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/academic/section/index" >
                      <div class="panel-footer  bg-white"style="color:#6ab04c;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#308977;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                               <img src="<?=base_url();?>assets/dashboard/book.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Subject &nbsp;
                                            
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/academic/subject/index/" >
                      <div class="panel-footer  bg-white"style="color:#308977;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading  "style="background-color:#B33771;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                               <img src="<?=base_url();?>assets/dashboard/class.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Class Routine &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/academic/routine" >
                      <div class="panel-footer  bg-white"style="color:#B33771;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
          </div>
     <!-- </div> -->
        </section>
        <section>
           <!-- <div class="container"> -->
        <div class="row">
            <div><h5><img src="<?=base_url();?>assets/dashboard/rupe.png" style="height:20px; width:20px;">&nbsp;<strong>Accounting</strong></h5></div>         
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading "style="background-color:#3867d6;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                               <img src="<?=base_url();?>assets/dashboard/rupee.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Fee Collection &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/accounting/invoice/add" >
                      <div class="panel-footer bg-white"style="color:#3867d6">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#FD7272;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/due.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Fee Due &nbsp;
                             
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/accounting/invoice/due" >
                      <div class="panel-footer  bg-white"style="color:#FD7272;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading p-3" style="background-color:#1BCA9B;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/income1.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Income &nbsp;
                             
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/accounting/income">
                      <div class="panel-footer  bg-white"style="color:#1BCA9B">
                          <span class="pull-left" >View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading  "style="background-color:#6D214F;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/rupee.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Expenditure &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/accounting/expenditure">
                      <div class="panel-footer  bg-white"style="color:#6D214F;">
                          <span class="pull-left" >View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
          </div>
         <!-- </div>  -->
        </section>

        <section>
      <!-- <div class="container">  -->
        <div class="row">
            <div><h5><img src="<?=base_url();?>assets/dashboard/bell.png" style="height:17px; width:17px;">&nbsp;<strong>Notifications</strong></h5></div>         
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading "style="background-color:#182C61;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/bell.png" style="height:23px; width:23px;">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Notice &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/announcement/notice/index" >
                      <div class="panel-footer  bg-white"style="color:#182C61;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>

             <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#FC427B;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/calendar.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div> Event &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/event/index/" >
                      <div class="panel-footer  bg-white"style="color:#FC427B">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#919138;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/sms.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>SMS &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/message/text/index/" >
                      <div class="panel-footer  bg-white"style="color:#919138;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red ">
                  <div class="panel-heading "style="background-color:#eb3b5a;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/gmail.jpg">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Email &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                    <a href="<?php echo BASE_URL();?>index.php/message/mail/index/">
                        <div class="panel-footer  bg-white" style="color:#eb3b5a;">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class       ="fa fa-arrow-circle-right"></i>        </span>
                        <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
     <!--  </div>  -->
    </section>
    <section>
      <!-- <div class="container"> -->
        <div class="row">
            <div><h5><img src="<?=base_url();?>assets/dashboard/gear.png" style="height:20px; width:20px;">&nbsp;<strong>Settings</strong></h5></div>           
            <div class="col-lg-2 col-md-6" style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading "style="background-color:#1287A5;">
                      <div class="row" style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Academic Year &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/administrator/year" >
                      <div class="panel-footer  bg-white"style="color:#1287A5;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6"style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#FD7272;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>General &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/setting" >
                      <div class="panel-footer  bg-white"style="color:#FD7272;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-2 col-md-6"style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading " style="background-color:#218F76;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Payment&nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/setting/payment" >
                      <div class="panel-footer  bg-white"style="color:#218F76;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-2 col-md-6"style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading  "style="background-color:#6D214F;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>SMS &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>index.php/setting/sms/" >
                      <div class="panel-footer  bg-white"style="color:#6D214F;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
             <div class="col-lg-2 col-md-6"style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading  bg-primary">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>Salary Grade &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                   <div class="clearfix"></div>
                  <a href="<?php echo BASE_URL();?>index.php/payroll/grade/index">
                      <div class="panel-footer  bg-white">
                          <span class="pull-left text-primary">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
            <div class="col-lg-2 col-md-6"style="padding-right:0px; padding-left:10px;">
                <div class="panel panel-red ">
                  <div class="panel-heading  "style="background-color:#AE1438;">
                      <div class="row"style="color:white;">
                          <div class="col-xs-3">
                              <img src="<?=base_url();?>assets/dashboard/settings.png">
                          </div>
                          <div class="col-xs-9 text-right">
                           <div>User Role &nbsp;
                            </div>
                          </div>
                      </div>
                  </div>
                  <a href="<?php echo BASE_URL();?>/index.php/administrator/role" >
                      <div class="panel-footer  bg-white"style="color:#AE1438;">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
            </div> 
        </div>
   <!--    </div>
 <div class="container"> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 ">   
      <div class="x_title">
        <h3 class="head-title"><?php echo $this->lang->line('calendar'); ?></h3>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
<!-- </div>
<div class="container">  -->
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12"> 
      <div class="x_panel tile fixed_height_520 overflow_hidden"style="height: 389px;">
                <div class="x_title">
        <!-- <div class="x_content"> -->
            <div id="calendar"></div>
                <link rel='stylesheet' href='<?php echo VENDOR_URL; ?>fullcalendar/lib/cupertino/jquery-ui.min.css' />

                    <link rel='stylesheet' href='<?php echo VENDOR_URL; ?>fullcalendar/fullcalendar.css' />

                    <script type="text/javascript" src='<?php echo VENDOR_URL; ?>fullcalendar/lib/jquery-ui.min.js'></script>

                    <script type="text/javascript" src='<?php echo VENDOR_URL; ?>fullcalendar/lib/moment.min.js'></script>

                    <script type="text/javascript" src='<?php echo VENDOR_URL; ?>fullcalendar/fullcalendar.min.js'></script> 

                    <script type="text/javascript">

                        $(function () {

                            $('#calendar').fullCalendar({

                                header: {

                                    left: 'prev,next today',

                                    center: 'title',    

                                    right: 'month,agendaWeek,agendaDay'

                                },

                                buttonText: {


                                    today: 'today',

                                    month: 'month',

                                    week: 'week',

                                    day: 'day'

                                },



                                //events and holidays

                                events: [

                                    <?php if(isset($events) && !empty($events)){ ?>

                                        <?php foreach($events as $obj){ ?>

                                        {

                                            title: "<?php echo $obj->title; ?>",

                                            start: '<?php echo date('Y-m-d', strtotime($obj->event_from)); ?>T<?php echo date('H:i:s', strtotime($obj->event_from)); ?>',

                                            end: '<?php echo date('Y-m-d', strtotime($obj->event_to)); ?>T<?php echo date('H:i:s', strtotime($obj->event_to)); ?>',

                                            backgroundColor: 'red;', //red

                                            url: '<?php echo site_url('event/view/'.$obj->id); ?>', //red

                                            color: '#ffffff' //red

                                        },

                                        <?php } ?> 

                                    <?php } ?> 

                                    <?php if(isset($holidays) && !empty($holidays)){ ?>

                                        <?php foreach($holidays as $obj){ ?>

                                        {

                                            title: "<?php echo $obj->title; ?>",

                                            start: '<?php echo date('Y-m-d', strtotime($obj->date_from)); ?>T<?php echo date('H:i:s', strtotime($obj->date_from)); ?>',

                                            end: '<?php echo date('Y-m-d', strtotime($obj->date_to)); ?>T<?php echo date('H:i:s', strtotime($obj->date_to)); ?>',

                                            backgroundColor: 'red', //red

                                            url: '<?php echo site_url('announcement/holiday/view/'.$obj->id); ?>', //red

                                            color: '#ffffff' //red

                                        },

                                        <?php } ?> 

                                    <?php } ?>                                     

                                ]

                            });

                        });

                    </script>
                      </div>


                </div>                

            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
     
    
            <div class="x_panel tile fixed_height_520 overflow_hidden"style="height: 389px;">
                <div class="x_title">
                    <h4 class="head-title"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('statistics'); ?></h4>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                              
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <script type="text/javascript">
                        $(function () {
                            $('#student-stats').highcharts({
                                chart: {
                                        type: 'pie',

                                        options3d: {

                                            enabled: true,

                                            alpha: 45,

                                            beta: 0

                                        }

                                    },

                                    title: {

                                        text: '<?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('statistics'); ?>'

                                    },

                                    tooltip: {

                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'

                                    },

                                    plotOptions: {

                                        pie: {

                                            allowPointSelect: true,

                                            cursor: 'pointer',

                                            depth: 35,

                                            dataLabels: {

                                                enabled: true,

                                                format: '{point.name}'

                                            }

                                        }

                                    },

                                    series: [{

                                            type: 'pie',

                                            name: '<?php echo $this->lang->line('student'); ?>',

                                            data: [

                                                <?php if(isset($students) && !empty($students)){ ?>

                                                    <?php foreach($students as $obj){ ?>

                                                    ['<?php echo $this->lang->line('class'); ?> <?php echo $obj->class_name; ?>', <?php echo $obj->total_student; ?>],

                                                    <?php } ?>

                                                <?php } ?>                                                

                                            ]

                                        }],

                                    credits: {

                                        enabled: false

                                    }

                                });

                            });

                        </script>

                        <div id="student-stats" style=" width: 99%; vertical-align: top; height:250px; direction: rtl;"></div>

                    </div>

                </div>
          

        </div>       


</div>
<!-- </div> -->


        <!-- For fee amount collections --->
       <!--  <div class="container"> -->
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel tile fixed_height_320">

                    <div class="x_title">

                        <h4 class="head-title"><?php echo 'Collected Amount Per Years';?> - <?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></h4>

                        <ul class="nav navbar-right panel_toolbox">

                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                                

                        </ul>

                        <div class="clearfix"></div>

                    </div>

                    <div class="x_content">

                        <script type="text/javascript">

                            $(function () {

                                $('#collected_amount').highcharts({

                                    chart: {

                                        type: 'column'

                                    },

                                    title: {

                                        text: ''

                                    },

                                    xAxis: {

                                        type: 'category'

                                    },

                                    yAxis: {

                                        title: {

                                            text: 'Collected Amount'

                                        }

                                    },

                                    legend: {

                                        enabled: false

                                    },

                                    plotOptions: {

                                        series: {

                                            borderWidth: 0,

                                            dataLabels: {

                                                enabled: true,

                                                //format: '{point.y:.1f}'

                                            }

                                        }

                                    },

                                    tooltip: {

                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',

                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'

                                    },

                                    series: [{

                                            name: 'Amount',

                                            colorByPoint: true,

                                            data: [

                                                <?php $i = 0; foreach ($collected_amount as $value) {?>
                                                   { 

                                                    name: '<?php echo $value['month']; ?>',

                                                    y: <?php echo $value['amount']; ?>,

                                                    drilldown: null

                                                } ,
                                                <?php }?>

                                               ]

                                        }],

                                    credits: {

                                        enabled: false

                                    }

                                });

                            });

                        </script>

                        <div id="collected_amount" style=" width: 99%; vertical-align: top;height: 260px;"></div>



                    </div>

                </div>

            </div>

        </div>
     <!--  </div> -->
        <!--End for amount collection--->

        <!-- For  Head wise collections --->
        <!-- <div class="container"> -->
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel tile fixed_height_320">

                    <div class="x_title">

                        <h4 class="head-title"><?php echo 'Head Wise Amount Per Years';?> - <?php echo isset($year_session->session_year) ? $year_session->session_year : '' ; ?></h4>

                        <ul class="nav navbar-right panel_toolbox">

                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                                

                        </ul>

                        <div class="clearfix"></div>

                    </div>

                    <div class="x_content">

                        <script type="text/javascript">

                            $(function () {

                                $('#income_amount').highcharts({

                                    chart: {

                                        type: 'column'

                                    },

                                    title: {

                                        text: ''

                                    },

                                    xAxis: {

                                        type: 'category'

                                    },

                                    yAxis: {

                                        title: {

                                            text: 'Head Wise Amount'

                                        }

                                    },

                                    legend: {

                                        enabled: false

                                    },

                                    plotOptions: {

                                        series: {

                                            borderWidth: 0,

                                            dataLabels: {

                                                enabled: true,

                                                //format: '{point.y:.1f}'

                                            }

                                        }

                                    },

                                    tooltip: {

                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',

                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'

                                    },

                                    series: [{

                                            name: 'Amount',

                                            colorByPoint: true,

                                            data: [

                                                <?php $i = 0; foreach ($income_head_collection as $income_collection) {?>
                                                   { 

                                                    name: '<?php echo $income_collection['title']; ?>',

                                                    y: <?php echo $income_collection['amount']; ?>,

                                                    drilldown: null

                                                } ,
                                                <?php }?>

                                               ]

                                        }],

                                    credits: {

                                        enabled: false

                                    }

                                });

                            });

                        </script>

                        <div id="income_amount" style=" width: 99%; vertical-align: top;height: 260px;"></div>



                    </div>

                </div>

            </div>

        </div>
      </div>
        <!--For  Head wise collections --->
<script src="<?php echo VENDOR_URL; ?>/chart/js/highcharts.js"></script>

<script src="<?php echo VENDOR_URL; ?>/chart/js/highcharts-3d.js"></script>

<script src="<?php echo VENDOR_URL; ?>/chart/js/modules/exporting.js"></script>

