<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Bulk.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Bulk
 * @description     : Manage bulk students imformation of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Bulk extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();      
        
        $this->load->model('Student_Model', 'student', true);
        // check running session
        if(!$this->academic_year_id){
            error($this->lang->line('academic_year_setting'));
            redirect('setting');
        }        
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add Bulk Student" user interface                 
    *                    and process to store "Bulk Student" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {            
            $status = $this->_get_posted_student_data();
            if ($status) {                   

                create_log('Has been added Bulk Student');
                success($this->lang->line('insert_success'));
                redirect('student/index/'.$this->input->post('class_id'));
            } else {
                error($this->lang->line('insert_failed'));
                redirect('student/bulk/add/');
            }            
        } 
        
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('bulk', $this->data);
    }

   

    /*****************Function _get_posted_student_data**********************************
    * @type            : Function
    * @function name   : _get_posted_student_data
    * @description     : Prepare "Student" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_student_data() {

        $this->_upload_file();

        $destination = 'assets/csv/bulk_uploaded_student.csv';
        if (($handle = fopen($destination, "r")) !== FALSE) {

            $count = 1;

            while (($arr = fgetcsv($handle)) !== false) {
                //Start check sequence of csv data
                if ($count == 1) {
                    $csvHeader = array('name*','admission_no*','guardian_id*','relation_with_guardian','national_id*','registration_no*','roll_no*','date_of_birth(20-12-2011)*','gender*','phone*','email*','password*',);
                    $arrHeader =  array($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9],$arr[10],$arr[11]);
                    if($csvHeader !== $arrHeader){
                        error($this->lang->line('insert_failed'));
                        redirect('student/bulk/add/');
                    }
                }
                 //End check sequence of csv data
                if ($count == 1) {
                    $count++;
                    continue;
                }
                // need atleast some mandatory data
                //if ($arr[0] != '' && $arr[1] != '' && $arr[6] != '' && $arr[10] != '' && $arr[11] != '') {
                if ($arr[0] != '' && $arr[1] != '' && $arr[6] != '' && $arr[11] != '') {

                    // need to check email unique
                   /* if ($this->student->duplicate_check($arr[10])) {
                        continue;
                    }*/

                    $data = array();
                    $enroll = array();
                    $user = array();

                    $data['admission_date'] = date('Y-m-d');
                    $data['name'] = isset($arr[0]) ? $arr[0] : '';
                    $data['admission_no'] = isset($arr[1]) ? $arr[1] : '';
                    $data['guardian_id'] = isset($arr[2]) ? $arr[2] : '';
                    $data['relation_with'] = isset($arr[3]) ? $arr[3] : '';
                    $data['national_id'] = isset($arr[4]) ? $arr[4] : '';
                    $data['registration_no'] = isset($arr[5]) ? $arr[5] : '';
                    $enroll['roll_no'] = isset($arr[6]) ? $arr[6] : '';
                    $data['dob'] = isset($arr[7]) ? date('Y-m-d', strtotime($arr[7])) : '';
                    $data['gender'] = isset($arr[8]) ? $arr[8] : '';
                    $data['phone'] = isset($arr[9]) ? $arr[9] : '';
                    $user['email'] = isset($arr[10]) ? $arr[10] : '';
                    $user['password'] = isset($arr[11]) ? $arr[11] : '';
                    $data['group'] = isset($arr[12]) ? $arr[12] : '';
                    $data['blood_group'] = isset($arr[13]) ? $arr[13] : '';
                    $data['religion'] = isset($arr[14]) ? $arr[14] : '';
                    $data['discount_id'] = isset($arr[15]) ? $arr[15] : '';
                    $data['present_address'] = isset($arr[16]) ? $arr[16] : '';
                    $data['permanent_address'] = isset($arr[17]) ? $arr[17] : '';
                    $data['second_language'] = isset($arr[18]) ? $arr[18] : '';
                    $data['health_condition'] = isset($arr[19]) ? $arr[19] : '';
                    $data['previous_school'] = isset($arr[20]) ? $arr[20] : '';
                    $data['father_name'] = isset($arr[21]) ? $arr[21] : '';
                    $data['father_phone'] = isset($arr[22]) ? $arr[22] : '';
                    $data['father_education'] = isset($arr[23]) ? $arr[23] : '';
                    $data['father_profession'] = isset($arr[24]) ? $arr[24] : '';
                    $data['father_designation'] = isset($arr[25]) ? $arr[25] : '';
                    $data['mother_name'] = isset($arr[26]) ? $arr[26] : '';
                    $data['mother_phone'] = isset($arr[27]) ? $arr[27] : '';
                    $data['mother_education'] = isset($arr[28]) ? $arr[28] : '';
                    $data['mother_profession'] = isset($arr[29]) ? $arr[29] : '';
                    $data['mother_designation'] = isset($arr[30]) ? $arr[30] : '';
                    $data['other_info'] = isset($arr[31]) ? $arr[31] : '';

                    $data['age'] = $data['dob'] ? floor((time() - strtotime($data['dob'])) / 31556926) : 0;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $data['status'] = 1;
                    $data['school_id']     = $this->session->userdata('school_id');
                    //Create by Nakul on 18-03-2019 for when user add guardian should be added.
                    if($data['guardian_id'] == ''){
                        $data['guardian_id'] =  $this->_create_user_guardian($data);
                    }
                    // first need to create user
                    $data['user_id'] = $this->_create_user($user);

                    // now need to create student
                    $enroll['student_id'] = $this->student->insert('students', $data);

                    // now need to create enroll
                    $this->_insert_enrollment($enroll);
                }
            }
        }

        return TRUE;
    }
    
     /*****************Function _upload_file**********************************
    * @type            : Function
    * @function name   : _upload_file
    * @description     : upload bulk studebt csv file                  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _upload_file() {

        $file = $_FILES['bulk_student']['name'];

        if ($file != "") {

            $destination = 'assets/csv/bulk_uploaded_student.csv';          
            //$ext = strtolower(end(explode('.', $file)));
            $temp = explode('.', $file);
            $ext = strtolower(end($temp));
            if ($ext == 'csv') {                 
                move_uploaded_file($_FILES['bulk_student']['tmp_name'], $destination);  
            }
        } else {
            error($this->lang->line('insert_failed'));
            redirect('student/bulk/add/');
        }       
    }
   
    
    /*****************Function _create_user**********************************
    * @type            : Function
    * @function name   : _create_user
    * @description     : save user info to users while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function _create_user($user){
        
        $data = array();
        $data['user_type']= 'Student';
        $data['role_id']    = 4;
        $data['password']   = md5($user['password']);
        $data['temp_password'] = base64_encode($user['password']);
        $data['email']      = $user['email'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['status']     = 1; // by default would not be able to login
        $data['school_id']     = $this->session->userdata('school_id'); // by default would not be able to login

            $school = $this->session->userdata('school_name');
            $next = $this->db->query("SHOW TABLE STATUS LIKE 'users'");
            $next = $next->row(0);
            $next->Auto_increment;
            $maxid= $next->Auto_increment;
            $yrs = date("Y");
            $data['unique_id'] = strtoupper(substr($school,0,3))."/".$yrs."/".$maxid;

        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    /*****************Function _create_user**********************************
    * @type            : Function (Modified)
    * @function name   : _create_user_guardian
    * @description     : save user info to users while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function _create_user_guardian($user){
        $data = array();
        $users = $this->student->get_single('users', array('email' => $user['phone']), array('email','id'));
        if(empty($users->id)){    
            $data['user_type']= 'Guardian';    
            $data['role_id']    = 3;
            $data['password']   = md5($user['phone']);
            $data['temp_password'] = base64_encode($user['phone']);
            $data['email']      = $user['phone'];
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status']     = 1; // by default would not be able to login
            $data['school_id']     = $this->session->userdata('school_id'); // by default would not be able to login
            $this->db->insert('users', $data);
            $insert_guardian_id = $this->db->insert_id();
                if($insert_guardian_id){
                    $datag = array();
                        $datag['name'] = $user['phone'];
                        $datag['national_id'] = $user['national_id'];
                        $datag['relation'] = 'father';
                        $datag['phone'] = $user['phone'];
                        $datag['school_id'] = $this->session->userdata('school_id');
                        $datag['created_at'] = date('Y-m-d H:i:s');
                        $datag['created_by'] = logged_in_user_id();
                        $datag['status'] = 1;
                        $datag['user_id'] = $insert_guardian_id;
                    return $insert_id = $this->student->insert('guardians', $datag);
                }
        }else{
            return $users->id;
        }
    }
    
    
    /*****************Function _insert_enrollment**********************************
    * @type            : Function
    * @function name   : _insert_enrollment
    * @description     : save student info to enrollment while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function _insert_enrollment($enroll) {
        
        $data = array();
        $data['student_id'] = $enroll['student_id'];
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['school_id']     = $this->session->userdata('school_id');
        
        if($this->input->post('advanced')){
            $data['academic_year_id'] = $this->input->post('academic_year_id');
        }else{            
            $data['academic_year_id'] = $this->academic_year_id;
        }
        
        $data['roll_no'] = $enroll['roll_no'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['status'] = 1;
        $this->db->insert('enrollments', $data);
    }
}