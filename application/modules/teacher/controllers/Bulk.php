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
        
        $this->load->model('Teacher_Model', 'teacher', true);
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
            $status = $this->_get_posted_teacher_data();
            if ($status) {
                create_log('Has been added Bulk Teacher');
                success($this->lang->line('insert_success'));
                redirect('teacher/index/'.$this->input->post('class_id'));
            } else {
                error($this->lang->line('insert_failed'));
                redirect('teacher/bulk/add/');
            }            
        } 
        $this->data['grades'] = $this->teacher->get_list('salary_grades', array('status' => 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        /*echo "<PRe>";
        print_r($this->data['grades']);
        die;*/
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('teacher') . ' | ' . SMS);
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
    private function _get_posted_teacher_data() {
        //die();
        $this->_upload_file();
        $destination = 'assets/csv/bulk_uploaded_teacher.csv';
        if (($handle = fopen($destination, "r")) !== FALSE) {
            $count = 1;
            while (($arr = fgetcsv($handle)) !== false) {
                //Start check sequence of csv data
                if ($count == 1) {
                    $csvHeader = array('name*','national_id','phone*','gender*','date_of_birth(20-12-2011)*','joining_date(20-12-2011)*','email*','password*','present_address','permanent_address');
                    $arrHeader =  array($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9]);
                    if($csvHeader !== $arrHeader){
                        error($this->lang->line('insert_failed'));
                        redirect('teacher/bulk/add/');
                    }
                }
                 //End check sequence of csv data
                if ($count == 1) {
                    $count++;
                    continue;
                }
                // need atleast some mandatory data
                if ($arr[0] != '' && $arr[2] != '' && $arr[3] != '' && $arr[4] != '' && $arr[5] != '' && $arr[6] != '' && $arr[7] != '') {
                    // need to check email unique
                    if ($this->teacher->duplicate_check($arr[6])) {
                        continue;
                    }

                    $data = array();
                    $user = array();

                    $user['email'] = isset($arr[6]) ? $arr[6] : '';
                    $user['password'] = isset($arr[7]) ? $arr[7] : '';
                    $data['permanent_address'] = isset($arr[9]) ? $arr[9] : '';
                    $data['present_address'] = isset($arr[8]) ? $arr[8] : '';
                    $data['name'] = isset($arr[0]) ? $arr[0] : '';
                    $data['national_id'] = isset($arr[1]) ? $arr[1] : '';
                    $data['phone'] = isset($arr[2]) ? $arr[2] : '';
                    $data['gender'] = isset($arr[3]) ? $arr[3] : '';
                    
                    $data['role_id'] = '19';
                    $data['dob'] = isset($arr[4]) ? date('Y-m-d', strtotime($arr[4])) : '';
                    $data['joining_date'] = isset($arr[5]) ? date('Y-m-d', strtotime($arr[5])) : '';
                    //$data['is_view_on_web'] = $this->input->post('is_view_on_web') ? 1 : 0;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $data['status'] = 1;

                    $data['school_id']     = $this->session->userdata('school_id');
                    // first need to create user
                   
                    $data['user_id'] = $this->_create_user($user);
                   // var_dump($user);
                  //  die();
                    // now need to create student
                    $enroll['student_id'] = $this->teacher->insert('teachers', $data);

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

        $file = $_FILES['bulk_teacher']['name'];
        if ($file != "") {

            $destination = 'assets/csv/bulk_uploaded_teacher.csv';          
            //$ext = strtolower(end(explode('.', $file)));
            $temp = explode('.', $file);
            $ext = strtolower(end($temp));
            if ($ext == 'csv') {                 
                move_uploaded_file($_FILES['bulk_teacher']['tmp_name'], $destination);  
            }
        } else {
            error($this->lang->line('insert_failed'));
            redirect('teacher/bulk/add/');
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
        $data['user_type']= 'Teahcer';
        $data['role_id']    = 5;
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
        $data['unique_id'] = strtoupper(substr($school,0,3))."/".$yrs."/"."T".$maxid;
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    
}