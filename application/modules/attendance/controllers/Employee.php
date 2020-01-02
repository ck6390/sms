<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Employee.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Employee
 * @description     : Manage employee daily attendance.  
 * @author          : Codetroopers Team     
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com   
 * @copyright       : Codetroopers Team     
 * ********************************************************** */

class Employee extends MY_Controller {

    public $data = array();    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Employee_Model', 'employee', true);
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Employee Attendance" user interface                 
    *                    and Process to manage daily Employee attendance    
    * @param           : null
    * @return          : null 
    * ********************************************************** */    
    public function index() { 
        
          check_permission(VIEW);
        
        if($_POST){ 
            $date       = $this->input->post('date');            
            $month      = date('m', strtotime($this->input->post('date')));
            $year       = date('Y', strtotime($this->input->post('date')));            
            $current_date = strtotime($date);
            $this->db->from('holidays');
            $this->db->where('school_id',$this->session->userdata('school_id'));
            $result = $this->db->get()->result();
        if($result)
            {
                foreach ($result as $value) 
                {
                    $from_date = strtotime($value->date_from);
                    $to_date = strtotime($value->date_to);
                   
                    if(($from_date <= $current_date) && ($current_date <= $to_date))
                    {
                        //echo "string";
                        $this->data['holiday_msg'] = "Today is holiday.";
                       // break;
                    }else{
                        $this->data['employees'] = $this->employee->get_employee_list();            
                        
                        $condition = array(              
                            'month'=>$month,
                            'year'=>$year
                        );
                        $today = $year."-".$month."-";
                        $data = $condition;
                        if(!empty($this->data['employees'])){
                            
                            foreach($this->data['employees'] as $obj){
                                
                                $condition['employee_id'] = $obj->id;                    
                                $attendance = $this->employee->get_single('employee_attendances', $condition);
								
                                //Start for add attendances for all days
                                    $attend = '';
                                    $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                    for ($i=1; $no_of_days >= $i; $i++) {
                                        $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>$today.$i,'attendance_time'=>'');
                                    }
                                //End for add attendances for all days
                                if(empty($attendance)){
                                   $data['academic_year_id'] = $this->academic_year_id; 
                                   $data['employee_id'] = $obj->id; 
                                   $data['status'] = 1;
                                   $data['created_at'] = date('Y-m-d H:i:s');
                                   $data['created_by'] = logged_in_user_id();
                                   $data['school_id'] = $this->session->userdata('school_id');
                                   $data['attendance_data'] = json_encode($attend);
								  
                                   $this->employee->insert('employee_attendances', $data);
                                }                    
                            }
                        }
                    }
                }
				
            }else{
                $this->data['employees'] = $this->employee->get_employee_list();            
                    
                    $condition = array(              
                        'month'=>$month,
                        'year'=>$year
                    );
                    
                    $data = $condition;
                    if(!empty($this->data['employees'])){
                        
                        foreach($this->data['employees'] as $obj){
                            
                            $condition['employee_id'] = $obj->id;                    
                            $attendance = $this->employee->get_single('employee_attendances', $condition);
							$attend = '';
                            $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            for ($i=1; $no_of_days >= $i; $i++) {
                                $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>'','attendance_time'=>'');
                            }
                            if(empty($attendance)){
                               $data['academic_year_id'] = $this->academic_year_id; 
                               $data['employee_id'] = $obj->id; 
                               $data['status'] = 1;
                               $data['created_at'] = date('Y-m-d H:i:s');
                               $data['created_by'] = logged_in_user_id();
                               $data['school_id'] = $this->session->userdata('school_id');
							   $data['attendance_data'] = json_encode($attend);
							    //var_dump($data);
                               $this->employee->insert('employee_attendances', $data);
                            }                    
                        }
                    }
            }
            $this->data['academic_year_id'] = $this->academic_year_id;
            $this->data['day'] = date('d', strtotime($this->input->post('date')));
            $this->data['month'] = date('m', strtotime($this->input->post('date')));
            $this->data['year'] = date('Y', strtotime($this->input->post('date')));

            $this->data['date'] = $date;
           
            create_log('Has been process employee attendance');   
        }
        
        $this->layout->title($this->lang->line('employee'). ' ' . $this->lang->line('attendance'). ' | ' . SMS);
        $this->layout->view('employee/index', $this->data);  
    }

 

    /*****************Function update_single_attendance**********************************
    * @type            : Function
    * @function name   : update_single_attendance
    * @description     : Process to update single employee attendance status               
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */  
    public function update_single_attendance(){        
        
        $status     = $this->input->post('status');
        $condition['employee_id'] = $this->input->post('employee_id');;        
        $condition['month']      = date('m', strtotime($this->input->post('date')));
        $condition['year']       = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;
        
        $field = 'day_'.abs(date('d', strtotime($this->input->post('date'))));
        $today =  date('Y-m-d', strtotime($this->input->post('date')));
        $str_replace = str_replace("-","",$today);
        //Start for attendance update in json
        $day = abs(date('d', strtotime($this->input->post('date'))));
        $attendance = $this->employee->get_single('employee_attendances', $condition);
        $attendance_data = $attendance->attendance_data;
        $attendance_data_decode = json_decode($attendance_data);
        $attend = '';
        foreach ($attendance_data_decode as $att_data) {
            if($att_data->day == $day){
                if($att_data->attendance == 'P'){
                    $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$att_data->attendance_time,'out_time'=>date("h:i:sa"));
                }else{
                    $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>date("h:i:sa"),'out_time'=>date("h:i:sa"));
                }
            }else{
                $attend[] = $att_data;
            }            
        }
        $attendance_record = json_encode($attend);
        //End for attendance update in json
        if($this->employee->update('employee_attendances', array($field=>$status,'attendance_date' => $str_replace,'attendance_time' => date("h:i:sa"),'attendance_data' => $attendance_record), $condition)){
            echo TRUE;
        }else{
            echo FALSE;
        }  
    }
    
    
    /*****************Function update_all_attendance**********************************
    * @type            : Function
    * @function name   : update_all_attendance
    * @description     : Process to update all employee attendance status                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
     public function update_all_attendance(){        
        
        $status     = $this->input->post('status');        
        $condition['month']      = date('m', strtotime($this->input->post('date')));
        $condition['year']       = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;
        
        $field = 'day_'.abs(date('d', strtotime($this->input->post('date'))));
        $today =  date('Y-m-d', strtotime($this->input->post('date')));
        $str_replace = str_replace("-","",$today);
        //Start for attendance update in json
        $day = abs(date('d', strtotime($this->input->post('date'))));
        //$attendance = $this->employee->get_single('employee_attendances', $condition);

        $attendance_list = $this->employee->get_list('employee_attendances', $condition);
        if(!empty($attendance_list)){
            foreach ($attendance_list as $attendance) {
                $attendance_data = $attendance->attendance_data;
                $attend = '';
                if($attendance_data){
                    $attendance_data_decode = json_decode($attendance_data);
                    foreach ($attendance_data_decode as $att_data) {
                        if($att_data->day == $day){
                            if($att_data->attendance == 'P'){
                                $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$att_data->attendance_time,'out_time'=>date("h:i:sa"));
                            }else{
                                $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>date("h:i:sa"),'out_time'=>date("h:i:sa"));
                            }
                        }else{
                            $attend[] = $att_data;
                        }
                    }
                }
                $attendance_record = json_encode($attend);
                $condition['employee_id'] = $attendance->employee_id;
                if ($this->employee->update('employee_attendances', array($field => $status,'attendance_date' => $str_replace,'attendance_time' => date("h:i:sa"),'attendance_data' => $attendance_record), $condition)) {
                    echo TRUE;
                } else {
                    echo FALSE;
                }
            }
        }










        /*$attendance_data = $attendance->attendance_data;
        $attendance_data_decode = json_decode($attendance_data);
        $attend = '';
        foreach ($attendance_data_decode as $att_data) {
            if($att_data->day == $day){
                if($att_data->attendance == 'P'){
                    $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$att_data->attendance_time,'out_time'=>date("h:i:sa"));
                }else{
                    $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>date("h:i:sa"),'out_time'=>date("h:i:sa"));
                }
            }else{
                $attend[] = $att_data;
            }
        }
        $attendance_record = json_encode($attend);
        //End for attendance update in json

        if($this->employee->update('employee_attendances', array($field=>$status,'attendance_date' => $str_replace,'attendance_time' => date("h:i:sa"),'attendance_data' => $attendance_record), $condition)){
            echo TRUE;
        }else{
            echo FALSE;
        }    */   
    }
    
}
