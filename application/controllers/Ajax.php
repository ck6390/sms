<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * ***************Ajax.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Ajax
 * @description     : This class used to handle ajax call from view file 
 *                    of whole application.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Ajax extends My_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('report');
        $this->load->model('Ajax_Model', 'ajax', true);
    }

    /**     * *************Function get_user_by_role**********************************
     * @type            : Function
     * @function name   : get_user_by_role
     * @description     : this function used to manage user role list for user interface   
     * @param           : null 
     * @return          : $str string value with user role list 
     * ********************************************************** */
    public function get_user_by_role() {
        
        $role_id = explode(",", $this->input->post('role_id'));
        
        //$role_id = $this->input->post('role_id');
       
        $class_id = $this->input->post('class_id');
        $user_id = $this->input->post('user_id');
        $message = $this->input->post('message');
        $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role_id[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();
     
        $users = array();
        if ($get_role_by_id->name == "Teacher") {                       
            $users = $this->ajax->get_list('teachers', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        } elseif ($get_role_by_id->name == "Guardian") {
           
            $users = $this->ajax->get_list('guardians', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        } elseif ($get_role_by_id->name =="Student") {
            if ($class_id) {
                $users = $this->ajax->get_student_list($class_id);
                //var_dump($users);
                //die();
            } else {
                $users = $this->ajax->get_list('students', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
            }
        } else {
            //var_dump($get_role_by_id->name);
            //die();
            $this->db->select('E.*');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->where('U.user_type', $get_role_by_id->name);
            $this->db->where('E.school_id', $this->session->userdata('school_id'));
            $users = $this->db->get()->result();
           // var_dump($users);
        }

        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (!$message) {
            $str .= '<option value="0">' . $this->lang->line('all') . '</option>';
        }

        $select = 'selected="selected"';
        if (!empty($users)) {
            foreach ($users as $obj) {
                $selected = $user_id == $obj->user_id ? $select : '';
                $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->id . ')</option>';
            }
        }

        echo $str;
    }

    /*     * **************Function get_tag_by_role**********************************
     * @type            : Function
     * @function name   : get_tag_by_role
     * @description     : this function used to manage user role tag list for user interface   
     * @param           : null 
     * @return          : $str string value with user role tag list 
     * ********************************************************** */

    public function get_tag_by_role() {

        $role_id = $this->input->post('role_id');
        $tags = get_template_tags($role_id);
        $str = '';
        foreach ($tags as $value) {
            $str .= '<span> ' . $value . ' </span>';
        }

        echo $str;
    }

    /**     * *************Function update_user_status**********************************
     * @type            : Function
     * @function name   : update_user_status
     * @description     : this function used to update user status   
     * @param           : null 
     * @return          : boolean true/false 
     * ********************************************************** */
    public function update_user_status() {

        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        if ($this->ajax->update('users', array('status' => $status), array('id' => $user_id,'school_id'=> $this->session->userdata('school_id')))) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    /**     * *************Function get_student_by_class**********************************
     * @type            : Function
     * @function name   : get_student_by_class
     * @description     : this function used to populate student list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */
    public function get_student_by_class() {

        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');   
        
        $students = $this->ajax->get_student_list($class_id);
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if( $student_id == 'all'){
            $str .= '<option selected="selected" value="all">--' . $this->lang->line('all') . '--</option>';
        }else{
            $str .= '<option value="all">--' . $this->lang->line('all') . '--</option>';
        }
        
           
        
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->roll_no . ']</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_exam_by_academic_year**********************************
     * @type            : Function
     * @function name   : get_exam_by_academic_year
     * @description     : this function used to populate section list by exam 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_exam_by_academic_year() {

        $academic_year_id = $this->input->post('academic_year_id');
        $exam_id = $this->input->post('exam_id');
        
        $exams = $this->ajax->get_list('exams', array('status' => 1, 'academic_year_id' => $academic_year_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        
        $select = 'selected="selected"';
        if (!empty($exams)) {
            foreach ($exams as $obj) {
                $selected = $exam_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
            }
        }

        echo $str;
    }

    

    /**     * *************Function get_section_by_class**********************************
     * @type            : Function
     * @function name   : get_section_by_class
     * @description     : this function used to populate section list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_section_by_class() {

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $sections = $this->ajax->get_list('sections', array('status' => 1, 'class_id' => $class_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        
        $select = 'selected="selected"';
        if (!empty($sections)) {
            foreach ($sections as $obj) {
                $selected = $section_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    
    
    /*     * **************Function get_student_by_section**********************************
     * @type            : Function
     * @function name   : get_student_by_section
     * @description     : this function used to populate student list by section 
      for user interface
     * @param           : null 
     * @return          : $str string  value with student list
     * ********************************************************** */

    public function get_student_by_section() {

        $student_id = $this->input->post('student_id');
        $section_id = $this->input->post('section_id');

        $students = $this->ajax->get_student_list_by_section($section_id);
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($students)) {
            foreach ($students as $obj) {
                $selected = $student_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . ' [' . $obj->roll_no . ']</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_subject_by_class**********************************
     * @type            : Function
     * @function name   : get_subject_by_class
     * @description     : this function used to populate subject list by class 
      for user interface
     * @param           : null 
     * @return          : $str string  value with subject list
     * ********************************************************** */
    public function get_subject_by_class() {

        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
       
        if($this->session->userdata('role_id') == TEACHER){
          $subjects = $this->ajax->get_list('subjects', array('status' => 1, 'class_id' => $class_id, 'teacher_id'=>$this->session->userdata('profile_id')), '', '', '', 'id', 'ASC');
        }else{
            $subjects = $this->ajax->get_list('subjects', array('status' => 1, 'class_id' => $class_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        }
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
       
        $select = 'selected="selected"';
        if(!empty($subjects)) {
            foreach ($subjects as $obj) {
                $selected = $subject_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_assignment_by_subject**********************************
     * @type            : Function
     * @function name   : get_assignment_by_subject
     * @description     : this function used to populate assignment list by subject 
      for user interface
     * @param           : null 
     * @return          : $str string  value with assignment list
     * ********************************************************** */
    public function get_assignment_by_subject() {

        $subject_id = $this->input->post('subject_id');
        echo $assignment_id = $this->input->post('assignment_id');

        $assignments = $this->ajax->get_list('assignments', array('status' => 1, 'subject_id' => $subject_id, 'academic_year_id' => $this->academic_year_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($assignments)) {
            foreach ($assignments as $obj) {
                $selected = $assignment_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->title . '</option>';
            }
        }

        echo $str;
    }

    /**     * *************Function get_guardian_by_id**********************************
     * @type            : Function
     * @function name   : get_guardian_by_id
     * @description     : this function used to populate guardian information/value by id 
      for user interface
     * @param           : null 
     * @return          : $guardina json  value
     * ********************************************************** */
    public function get_guardian_by_id() {

        header('Content-Type: application/json');
        $guardian_id = $this->input->post('guardian_id');

        $guardian = $this->ajax->get_single('guardians', array('id' => $guardian_id,'school_id'=> $this->session->userdata('school_id')));
        echo json_encode($guardian);
        die();
    }

    /**     * *************Function get_room_by_hostel**********************************
     * @type            : Function
     * @function name   : get_room_by_hostel
     * @description     : this function used to populate room list by hostel  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_room_by_hostel() {

        $hostel_id = $this->input->post('hostel_id');

        $hostels = $this->ajax->get_list('rooms', array('status' => 1, 'hostel_id' => $hostel_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $str = '<option value="">--.' . $this->lang->line('select') . ' ' . $this->lang->line('room_no') . '--</option>';
        $selected = '';
        if (!empty($hostels)) {
            foreach ($hostels as $obj) {
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->room_no . ' [' . $this->lang->line($obj->room_type) . ']</option>';
            }
        }

        echo $str;
    }
    
    
    /**     * *************Function get_bus_stop_by_route**********************************
     * @type            : Function
     * @function name   : get_bus_stop_by_route
     * @description     : this function used to populate bus stop list by route  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_bus_stop_by_route() {

        $route_id = $this->input->post('route_id');

        $stops = $this->ajax->get_list('route_stops', array('status' => 1, 'route_id' => $route_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('bus_stop') . ' --</option>';
        $selected = '';
        if (!empty($stops)) {
            foreach ($stops as $obj) {
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->stop_name . ' [' . $obj->stop_fare . ']</option>';
            }
        }

        echo $str;
    }
    
    
    /** * *************Function get_email_template_by_role**********************************
     * @type            : Function
     * @function name   : get_email_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_email_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('email_templates', array('status' => 1, 'role_id' => $role_id,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->template . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
    
    /** * *************Function get_sms_template_by_role**********************************
     * @type            : Function
     * @function name   : get_sms_template_by_role
     * @description     : this function used to populate template by role  
      for user interface
     * @param           : null 
     * @return          : $str string value with room list 
     * ********************************************************** */
    public function get_sms_template_by_role() {

        $role_id = $this->input->post('role_id');

        $templates = $this->ajax->get_list('sms_templates', array('status' => 1, 'role_id' => $role_id), '', '', '', 'id', 'ASC');
        $str = '<option value="">-- ' . $this->lang->line('select') . ' ' . $this->lang->line('template') . ' --</option>';
        if (!empty($templates)) {
            foreach ($templates as $obj) {
                $str .= '<option itemid="'.$obj->id.'" value="' . $obj->template . '">' . $obj->title . '</option>';
            }
        }

        echo $str;
    }
    
    
    
    /*****************Function get_user_list_by_type**********************************
     * @type            : Function
     * @function name   : get_user_list_by_type
     * @description     : Load "Employee or Teacher Listing" by ajax call                
     *                    and populate user listing
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_list_by_type() {
        
         $payment_to  = $this->input->post('payment_to');
         $user_id  = $this->input->post('user_id');
         
         $users = $this->ajax->get_user_list($payment_to );
         
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        $select = 'selected="selected"';
        if (!empty($users)) {
            foreach ($users as $obj) {   
                $selected = $user_id == $obj->user_id ? $select : '';
                $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name .' [ '. $obj->designation . ' ]</option>';
            }
        }

        echo $str;
    }
    
    
    /*****************Function get_user_single_payment**********************************
     * @type            : Function
     * @function name   : get_user_single_payment
     * @description     : validate the paymeny to user already paid for selected month               
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function get_user_single_payment() {
        
         $payment_to  = $this->input->post('payment_to');
         $user_id  = $this->input->post('user_id');
         $salary_month  = $this->input->post('salary_month');
         
         $exist = $this->ajax->get_single('salary_payments',array('user_id'=>$user_id, 'salary_month'=>$salary_month, 'payment_to'=>$payment_to,'school_id'=> $this->session->userdata('school_id')));
         
         if($exist){
             echo 1;
         }else{
             echo 2;
         }
         
    }

    /**     * *************Function get_class**********************************
     * @type            : Function
     * @function name   : get_class
     * @description     : this function used to populate  class list after add the class  
      for user interface
     * @param           : null 
     * @return          : $str string  value with section list
     * ********************************************************** */
    public function get_class() {

        $class_id = $this->input->post('class_id');        
        $sections = $this->ajax->get_list('classes', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        
        $select = 'selected="selected"';
        if (!empty($sections)) {
            foreach ($sections as $obj) {
                $selected = $class_id == $obj->id ? $select : '';
                $str .= '<option value="' . $obj->id . '" ' . $selected . '>' . $obj->name . '</option>';
            }
        }

        echo $str;
    }



    /**     * *************Function get_user_by_role_by_attendance **********************************
     * @type            : Function
     * @function name   : get_user_by_role_by_attendance
     * @description     : this function used to manage user role list for user interface   
     * @param           : null 
     * @return          : $str string value with user role list 
     * ********************************************************** */
    public function get_user_by_role_by_attendance() {
        $users = '';
        $role_id = explode(",", $this->input->post('role_id'));
        
        //$role_id = $this->input->post('role_id');
       
        $class_id = $this->input->post('class_id');
        $user_id = $this->input->post('user_id');
        $date = date('Y-m-d',strtotime($this->input->post('absent_date')));
        $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role_id[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();
     
        $users = array();
        if ($get_role_by_id->name == "Teacher") {                       
            //$users = $this->ajax->get_list('teachers', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
            $this->db->select('T.*');
            $this->db->from('teachers AS T');
            $this->db->join('teacher_attendances AS TA', 'TA.teacher_id = T.id', 'left');
            $this->db->where('TA.academic_year_id', $this->academic_year_id); 
            $this->db->like('TA.attendance_data', '"attendance":"A","attendance_date":"'.$date.'');     
            $this->db->where('T.school_id', $this->session->userdata('school_id'));     
            $users = $this->db->get()->result();  

        } elseif ($get_role_by_id->name =="Student") {
            if ($class_id) {
                //$users = $this->ajax->get_student_list($class_id);
                $users = $this->ajax->get_student_list_attendances($class_id,$date);
                //var_dump($users);
                //die();
            } else {
                $users = $this->ajax->get_list('students', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
            }
        } else {
            //var_dump($get_role_by_id->name);
            //die();
            $this->db->select('E.*');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->join('employee_attendances AS EA', 'EA.employee_id = E.id', 'left');
            $this->db->where('EA.academic_year_id', $this->academic_year_id);
            $this->db->where('U.user_type', $get_role_by_id->name);
            $this->db->like('EA.attendance_data', '"attendance":"A","attendance_date":"'.$date.'');
            $this->db->where('E.school_id', $this->session->userdata('school_id'));
            $users = $this->db->get()->result();
           // var_dump($users);
        }
        $str = '<option value="">--' . $this->lang->line('select') . '--</option>';
        if (count($users) > 1) {
            $str .= '<option value="0">' . $this->lang->line('all') . '</option>';
        }

        $select = 'selected="selected"';
        if (!empty($users)) {
            foreach ($users as $obj) {
                $selected = $user_id == $obj->user_id ? $select : '';
                $str .= '<option value="' . $obj->user_id . '" ' . $selected . '>' . $obj->name . '(' . $obj->id . ')</option>';
            }
        }

        echo $str;
    }

    /*     * **************Function get_salary**********************************
     * @type            : Function
     * @function name   : get_salary
     * @description     : this function used to manage user role tag list for user interface   
     * @param           : null 
     * @return          : $str string value with user role tag list 
     * ********************************************************** */

    public function get_salary() {
       $salary_month = $this->input->post('date');
       $basic_salary = $this->input->post('basic_salary');
       $payment_to = $this->input->post('payment_to');
        $month_number =  date('m',strtotime($salary_month));
        $year =  date('Y',strtotime($salary_month));
        $days = cal_days_in_month(CAL_GREGORIAN,$month_number,$year);
        $data = $this->get_employee_id($payment_to,$this->input->post('user_id'));
       
        $id = $data->id;
        if($data->in_time && $data->in_time){
            $in_time = $data->in_time;
            $out_time = $data->out_time;
            //Hour calculetion
            $thour = 0;
            $total_deduction = 0;
            /*$check_in = '10:00:00am';
            $check_out = '05:00:00pm';*/
            $check_in = $in_time;
            $check_out = $out_time;

            $check_time = new DateTime($check_in);
            $check_out = new DateTime($check_out);
            $working_hour = $check_out->diff($check_time);
            $working_hours = $working_hour->format("%H");

            $oneDaySalary = ($basic_salary/$days);
            $anHourSalary = ($oneDaySalary/ (int)$working_hours);

            if ($payment_to == 'teacher') {
                $attendance = @get_teacher_monthly_attendance($id, $this->academic_year_id, $month_number ,$days);
            }else{
                $attendance = @get_employee_monthly_attendance($id, $this->academic_year_id, $month_number ,$days);
            }
            /*echo "<pre>";
            print_r($attendance);
            die;*/
            $noParentDay = 0;
            $noAbsentDay = 0;
            $noHolidays = 0;
            $thour = 0 ;
            $t_d_h = 0 ;
            $holidays = get_holidays();
            $month_start_date =  $year.'-'.$month_number.'-01'; 
            if(!empty($attendance->attendance_data)){
               foreach (json_decode($attendance->attendance_data) as $key => $attendance_data) {
                    if($attendance_data->attendance == 'P'){
                        $dailyInTime = '';
                        $dailyInTime = new DateTime($attendance_data->attendance_time);
                        $lateInTimeDiff = $check_time->diff($dailyInTime);
                        if($dailyInTime > $check_time ){
                            $deducted_whrs = ceil($lateInTimeDiff->format('%h.%i'));
                            $t_d_h += $deducted_whrs;
                            $thour += round($working_hour->format('%h.%i'))-$deducted_whrs;
                        }else{
                            $thour += $working_hours;
                        }

                        $noParentDay = $noParentDay+1;
                    }

                    /*if($attendance_data->attendance == 'P'){
                        $noParentDay = $noParentDay+1;
                        //Hours
                            //$a_check_in = new DateTime('11:01:00am');
                            if(!empty($attendance_data->attendance_time)){
                                $a_check_in = new DateTime($attendance_data->attendance_time);
                                $interval = $check_time->diff($a_check_in);
                                if($check_time < $a_check_in){
                                   // echo $interval->format("%H:%I:%S").'^^^^';
                                    $thour = $interval->format("%H") + $thour;
                                    if($interval->format("%I") >= 1  || $interval->format("%S") >= 1){
                                        $thour = $thour + 1;
                                    }
                                }
                            }
                            if(!empty($attendance_data->out_time)){
                                //$a_check_out = new DateTime('04:55:00pm');
                                $a_check_out = new DateTime($attendance_data->out_time);
                                $interval_out = $check_out->diff($a_check_out);
                                if($check_out > $a_check_in){
                                   // echo $interval->format("%H:%I:%S").'^^^^';
                                    $thour = $interval_out->format("%H") + $thour;
                                    if($interval_out->format("%I") >= 1  || $interval_out->format("%S") >= 1){
                                        $thour = $thour + 1;
                                    }
                                }
                            }
                        //Hours
                    }*/
                    $get_sun_a = date("D", strtotime($month_start_date.'+'.($attendance_data->day-1).'days'));
                    if(($attendance_data->attendance == 'A' && $get_sun_a != "Sun") ||  ($attendance_data->attendance == '' && $get_sun_a != "Sun")){
                        $noAbsentDay += 1;
                    }
                    // Holidays
                        foreach($holidays as $val){
                            $begin = new DateTime($val->date_from);
                            $end = new DateTime($val->date_to);
                            $end = $end->modify( '+1 day' ); 

                            $interval = new DateInterval('P1D');
                            $daterange = new DatePeriod($begin, $interval ,$end);

                            foreach($daterange as $date){
                                if(strtotime($date->format("Y-m-d")) == strtotime($attendance_data->attendance_date)){
                                    $noHolidays = $noHolidays +1;
                                    //echo $today_holiday = "<b class='btn-warning btn btn-xs' title=".$val->title.">H</b>";
                                } 
                            }
                        }

                    //Holidays 


                } 
                // $anHourSalary = ($basic_salary/noofdays in a monty ) / $working_hours 
                // $working_hours = $check_time - check_out comes from general settings            
                $perDaySalary = ($basic_salary / $days);
                //$total_deduction = ($anHourSalary * $thour);
                
                //die;
                
                //$all_sun = ""; 
                $sum = 0;
                $sun_count = 0;
                for($i = 1; $i<=$days; $i++ ){ 
                    $get_sun = date("D", strtotime($month_start_date.'+'.($i-1).'days'));
                    if($get_sun == "Sun"){
                        //$all_sun[$i]=$get_sun;
                        $sun_count++;
                    }
                }
                //echo $noParentDay;
                $no_days_with_sunday =  $sun_count + $noParentDay;

                $no_days_with_sunday_holidays =  ($sun_count + $noParentDay) + $noHolidays;
                $total_deduction = ($anHourSalary * $t_d_h)+($noAbsentDay * $perDaySalary);
                //$netSalary = round((($perDaySalary * $no_days_with_sunday_holidays) - $total_deduction),2);
                $total_deduction_hour = ($anHourSalary * $t_d_h);
                $netSalary = round((($perDaySalary * $no_days_with_sunday_holidays) - $total_deduction_hour),2);
                
                $data = array(
                        'netSalary'=>$netSalary, 
                        'total_deduction'=>round($total_deduction,2),
                        'working_hours' => $working_hours,
                        'oneDaySalary' => $oneDaySalary,
                        'anHourSalary' => round($anHourSalary,2),
                        'status' => true);
            }else{
                $data = array('status' => false, 'message'=>'Kindly check attendance before create a salary');
            }
        }else{
             $data = array('status' => false, 'message'=>'Kindly set In Time and Out Time for this user');
        }
        echo json_encode($data); 
    }

    public function get_employee_id($type,$user_id) {
        $data = '';
        if ($type == 'teacher') {
            $teacher = $this->ajax->get_single('teachers', array('user_id' => $user_id,'school_id'=> $this->session->userdata('school_id')));
            //$id = $teacher->id;    
            $data = $teacher;      
        } elseif ($type == 'employee') { 
            $employee = $this->ajax->get_single('employees', array('user_id' => $user_id,'school_id'=> $this->session->userdata('school_id')));
            //$id = $employee->id;
            $data = $employee;
            
        } 
        return $data;
    }
    // 11-06-2019

}
