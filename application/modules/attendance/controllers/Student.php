<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Student.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Student
 * @description     : Manage student daily attendance.  
 * @author          : Codetroopers Team     
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com   
 * @copyright       : Codetroopers Team     
 * ********************************************************** */

class Student extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        
        $this->load->helper('report');
       // $this->load->module('announcement');
        //$this->load->model('Holiday_Model', 'holiday', true);            
        $this->load->model('Student_Model', 'student', true);
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Student Attendance" user interface                 
    *                    and Process to manage daily Student attendance    
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
    public function index() {

        check_permission(VIEW);
        if ($_POST) {

            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $date = $this->input->post('date');

           // $this->data['holidays'] = $this->holiday->get_holiday_list();
            $current_date = strtotime($date);
            //var_dump($current_date);
            $month = date('m', strtotime($this->input->post('date')));
            $year = date('Y', strtotime($this->input->post('date')));
            $academic_year_id = $this->academic_year_id;

           // $current_date = str_replace("-", "", $current_date_formate);
            $this->db->from('holidays');
            $this->db->where('school_id',$this->session->userdata('school_id'));
            $result = $this->db->get()->result();
            //var_dump($result);
            //die();
        if($result)
            {
                    foreach ($result as $value) 
                    {
                        $from_date = strtotime($value->date_from);
                        $to_date = strtotime($value->date_to);
                        //var_dump($from_date);
                        //var_dump($current_date);
                        //var_dump($to_date);
                        if(($from_date <= $current_date) && ($current_date <= $to_date))
                        {
                            //echo "string";
                            $this->data['holiday_msg'] = "Today is holiday.";
                           // break;
                        }else{
                          // echo "jkdagkjdhaksdhgkjas";
                            $this->data['students'] = $this->student->get_student_list($class_id, $section_id, $academic_year_id);
                           // var_dump($this->data['students']);
							// die();
                            $condition = array(
                                'class_id' => $class_id,
                                'section_id' => $section_id,
                                'academic_year_id' => $academic_year_id,
                                'month' => $month,
                                'year' => $year
                            );
                            $today = $year."-".$month."-";
                            $data = $condition;
                            if (!empty($this->data['students'])) {
                                
                                foreach ($this->data['students'] as $obj) {

                                    $condition['student_id'] = $obj->id;
                                    $attendance = $this->student->get_single('student_attendances', $condition);
                                   // var_dump($obj->id);
                                    //Start for add attendances for all days
                                    $attend = '';
                                    $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                    for ($i=1; $no_of_days >= $i; $i++) {
                                        $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>$today.$i,'attendance_time'=>date("h:i:sa"));
                                    }
                                    //End for add attendances for all days
                                    if (empty($attendance)) {
                                     //   var_dump($obj->id);
                                        $data['student_id'] = $obj->id;
                                        $data['status'] = 1;
                                        $data['created_at'] = date('Y-m-d H:i:s');
                                        $data['created_by'] = logged_in_user_id();
                                        $data['school_id'] = $this->session->userdata('school_id');
                                        $data['attendance_data'] = json_encode($attend);
                                       // $data['unique_id'] = $obj->unique_id;
                                       // var_dump($data);
                                       // die();
                                        $this->student->insert('student_attendances', $data);
                                    }
                                }
                            }                
                    }                
                }           
            }else{
                 $this->data['students'] = $this->student->get_student_list($class_id, $section_id, $academic_year_id);
                    //var_dump($this->data['students']);
                    $condition = array(
                        'class_id' => $class_id,
                        'section_id' => $section_id,
                        'academic_year_id' => $academic_year_id,
                        'month' => $month,
                        'year' => $year
                    );

                    $data = $condition;
                    if (!empty($this->data['students'])) {
                        
                        foreach ($this->data['students'] as $obj) {

                            $condition['student_id'] = $obj->id;
                            $attendance = $this->student->get_single('student_attendances', $condition);
                           // var_dump($obj->id);
						    $attend = '';
                            $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            for ($i=1; $no_of_days >= $i; $i++) {
                                $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>'','attendance_time'=>date("h:i:sa"));
                            }
                            if (empty($attendance)) {
                             //   var_dump($obj->id);
                                $data['student_id'] = $obj->id;
                                $data['status'] = 1;
                                $data['created_at'] = date('Y-m-d H:i:s');
                                $data['created_by'] = logged_in_user_id();
                                $data['school_id'] = $this->session->userdata('school_id');
								$data['attendance_data'] = json_encode($attend);
                                //var_dump($data);
                               // die();
                                $this->student->insert('student_attendances', $data);
                            }
                        }
                    } 
            }
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['day'] = date('d', strtotime($this->input->post('date')));           
            $this->data['month'] = date('m', strtotime($this->input->post('date')));          
            $this->data['year'] = date('Y', strtotime($this->input->post('date')));
           
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['date'] = $date;
            
            create_log('Has been process student attendance');   
        }

        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('attendance') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }

   
        
    /*****************Function guardian**********************************
    * @type            : Function
    * @function name   : guardian
    * @description     : Load "Student Attendance for guardian" user interface                 
    *                    and Process to manage daily Student attendance    
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
    public function guardian() {

        check_permission(VIEW);

        $this->data['month_number'] = 1;
        $session = $this->student->get_single('academic_years', array('is_running' => 1,'school_id' => $this->session->userdata('school_id')));

        if ($_POST) {

            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $month = $this->input->post('month');


            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['month'] = $month;
            $this->data['month_number'] = date('m', strtotime($this->data['month']));
            $session = $this->student->get_single('academic_years', array('id' => $academic_year_id,'school_id' => $this->session->userdata('school_id')));
            $this->data['students'] = $this->student->get_student_attendance_list($academic_year_id, $class_id, $section_id);
           
        }

        
        $this->data['academic_years'] = $this->student->get_list('academic_years', array('status' => 1,'school_id' => $this->session->userdata('school_id')));

        
        $this->data['year'] = substr($session->session_year, 7);
        $this->data['days'] =  @date('t', mktime(0, 0, 0, $this->data['month_number'], 1, $this->data['year']));
        //$this->data['days'] = cal_days_in_month(CAL_GREGORIAN, $this->data['month_number'], $this->data['year']);

        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')));

        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('student/attendance', $this->data);
    }


    /*****************Function update_single_attendance**********************************
    * @type            : Function
    * @function name   : update_single_attendance
    * @description     : Process to update single student attendance status               
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
    public function update_single_attendance() {

        $status = $this->input->post('status');
        $condition['student_id'] = $this->input->post('student_id');
        $condition['class_id'] = $this->input->post('class_id');
        $condition['section_id'] = $this->input->post('section_id');
        $condition['month'] = date('m', strtotime($this->input->post('date')));
        $condition['year'] = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;

        $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
        $day = abs(date('d', strtotime($this->input->post('date'))));
        //var_dump($field);
        //die();
        $today =  date('Y-m-d', strtotime($this->input->post('date')));
        $str_replace = str_replace("-","",$today);

        //Start for attendance update in json
        $attendance = $this->student->get_single('student_attendances', $condition);
        $attendance_data = $attendance->attendance_data;
        $attendance_data_decode = json_decode($attendance_data);
        $attend = '';
        foreach ($attendance_data_decode as $att_data) {
            if($att_data->day == $day){
                $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>date("h:i:sa"));
            }else{
                $attend[] = $att_data;
            }            
        }
        $attendance_record = json_encode($attend);
        //End for attendance update in json

        //if ($this->student->update('student_attendances', array($field => $status,'attendance_date'=>$str_replace,'attendance_time' => date("h:i:sa")), $condition)) {
        if ($this->student->update('student_attendances', array('attendance_data' => $attendance_record,'attendance_time' => date("h:i:sa")), $condition)) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    
    /*****************Function update_all_attendance**********************************
    * @type            : Function
    * @function name   : update_all_attendance
    * @description     : Process to update all student attendance status                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function update_all_attendance() {
      
        $status = $this->input->post('status');

        $condition['class_id'] = $this->input->post('class_id');
        $condition['section_id'] = $this->input->post('section_id');
        $condition['month'] = date('m', strtotime($this->input->post('date')));
        $condition['year'] = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;

        $field = 'day_' . abs(date('d', strtotime($this->input->post('date'))));
        $day = abs(date('d', strtotime($this->input->post('date'))));
        $today =  date('Y-m-d', strtotime($this->input->post('date')));
        //$str_replace = str_replace("-","",$today);

        //Start for attendance update in json
        $attendance = $this->student->get_single('student_attendances', $condition);
        $attendance_data = $attendance->attendance_data;
        $attendance_data_decode = json_decode($attendance_data);
        $attend = '';
        foreach ($attendance_data_decode as $att_data) {
            if($att_data->day == $day){
                $attend[] = array('day'=>$day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>date("h:i:sa"));
            }else{
                $attend[] = $att_data;
            }
        }
        $attendance_record = json_encode($attend);
        //End for attendance update in json

        //if ($this->student->update('student_attendances', array($field => $status,'attendance_date' => $str_replace,'attendance_time' => date("h:i:sa")), $condition)) {
        if ($this->student->update('student_attendances', array('attendance_data' => $attendance_record,'attendance_time' => date("h:i:sa")), $condition)) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

}
