<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Student.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Student
 * @description     : Manage students imformation of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Student extends MY_Controller {

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

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Student List" user interface                 
    *                    with class wise listing    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index($class_id = null) {

        check_permission(VIEW);
        
        if(isset($class_id) && !is_numeric($class_id)){
            error($this->lang->line('unexpected_error'));
            redirect('academic/classes/index');
        }
        
        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->student->get_student_list($class_id);
       /* var_dump($this->data['students']);
       die();*/
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Student" user interface                 
    *                    and process to store "Student" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {
         $admission_start = strtotime($this->session->userdata('admission_start'));
          $admission_end = strtotime($this->session->userdata('admission_end'));
        //var_dump($this->session->userdata('admission_start'));
        // var_dump($this->session->userdata('admission_end'));
        $today_date= strtotime(date("Y/m/d"));
       //var_dump($today_date);die();
        check_permission(ADD);
        if($today_date >= $admission_start && $today_date <= $admission_end){
            if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();

                $insert_id = $this->student->insert('students', $data);
                
                if ($insert_id) {
                    $this->__insert_enrollment($insert_id);
                    
                    create_log('Has been added a Student : '.$data['name']);
                    success($this->lang->line('insert_success'));
                    redirect('student/index/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('student/add/'.$this->input->post('class_id'));
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }
        
       
        
        $class_id = $this->uri->segment(4);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }

        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->student->get_student_list($class_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        }else{
        //die("dfgdf"); 
            error($this->lang->line('unexpected_error'));
            redirect('student/index');
     }
        $this->layout->view('student/index', $this->data);
    }

        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Student" user interface                 
    *                    with populate "Student" value 
    *                    and process to update "Student" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {
	      check_permission(EDIT);

			if(!is_numeric($id)){
				error($this->lang->line('unexpected_error'));
				redirect('student/index');     
			}
			
			if ($_POST) 
			{
				$password = md5($_POST['password']);
			
				$this->_prepare_student_validation();
				if ($this->form_validation->run() === TRUE) {
					$data = $this->_get_posted_student_data();
					
					$updated = $this->student->update('students', $data, array('id' => $this->input->post('id'),'school_id' => $this->session->userdata('school_id')));
					$single_id = $this->input->post('id');
					//$user_id=$this->student->getsingledata($single_id);
					/**/
					$userid=$user_id->user_id;

					if ($updated) {
						
						$school_id = $this->session->userdata('school_id');
						$password_update = $this->student->passwordupdate($_POST['user_id'],$school_id,$password);

						$this->__update_enrollment();
						create_log('Has been updated a Student : '.$data['name']);
						success($this->lang->line('update_success'));
						redirect('student/index/'.$this->input->post('class_id'));
					} else {
						error($this->lang->line('update_failed'));
						redirect('student/edit/' . $this->input->post('id'));
					}
				} else {
					$this->data['student'] = $this->student->get_single_student($this->input->post('id'));
				}
			}

			if ($id) {
				$this->data['student'] = $this->student->get_single_student($id);

				if (!$this->data['student']) {
					redirect('student/index');
				}
			}
			
			$class_id = $this->data['student']->class_id;
			if(!$class_id){
			  $class_id = $this->input->post('class_id');
			} 

			$this->data['class_id'] = $class_id;
			$this->data['students'] = $this->student->get_student_list($class_id);
			$this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
			$this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
			$this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
			$this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
			
			$this->data['edit'] = TRUE;
			$this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('student') . ' | ' . SMS);
			$this->layout->view('student/index', $this->data);
     }

        
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Student data                 
    *                       
    * @param           : $student_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($student_id = null) {

        check_permission(VIEW);

        if(!is_numeric($student_id)){
             error($this->lang->line('unexpected_error'));
              redirect('student/index');
        }
        
        $this->data['student'] = $this->student->get_single_student($student_id);        
        $class_id = $this->data['student']->class_id;
        
        $this->data['students'] = $this->student->get_student_list($class_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
        $this->data['class_id'] = $class_id;  
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }
    
    
    
     /*****************Function get_single_student**********************************
     * @type            : Function
     * @function name   : get_single_student
     * @description     : "Load single student information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_student(){
        
        $this->load->helper('report');
        $student_id = $this->input->post('student_id');
        $adv = $this->input->post('adv');
        $this->data['student'] = $this->student->get_single_student($student_id, $adv);        
        
        $this->data['guardian'] = $this->student->get_single_guardian($this->data['student']->guardian_id);
       
        $this->data['days'] = 31;
        $this->data['academic_year_id'] = $this->data['student']->academic_year_id;
        $this->data['class_id'] = $this->data['student']->class_id;
        $this->data['section_id'] = $this->data['student']->section_id;
        $this->data['student_id'] = $this->data['student']->id;
        
        $this->data['exams'] = $this->student->get_list('exams', array('status' => 1, 'academic_year_id' => $this->academic_year_id,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        
        $this->data['invoices'] = $this->student->get_invoice_list($student_id);  
        $this->data['activity'] = $this->student->get_activity_list($student_id);  
        // var_dump($this->data);
        //die();
        echo $this->load->view('get-single-student', $this->data);
    }
    
        
    /*****************Function _prepare_student_validation**********************************
    * @type            : Function
    * @function name   : _prepare_student_validation
    * @description     : Process "Student" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_student_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        if (!$this->input->post('id')) {
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|valid_email|callback_email');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
            $this->form_validation->set_rules('roll_no', $this->lang->line('roll_no'), 'trim|required');
			$this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), 'trim|required|is_unique[students.admission_no]');
        }

		
        $this->form_validation->set_rules('admission_date', $this->lang->line('admission_date'), 'trim|required');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required');

        //$this->form_validation->set_rules('guardian_id', $this->lang->line('guardian'), 'trim|required');
        $this->form_validation->set_rules('registration_no', $this->lang->line('registration_no'), 'trim');
        $this->form_validation->set_rules('group', $this->lang->line('group'), 'trim');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('dob', $this->lang->line('birth_date'), 'trim|required');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required');
        $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('permanent_address', $this->lang->line('permanent') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('religion', $this->lang->line('religion'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');
        $this->form_validation->set_rules('photo', $this->lang->line('photo'), 'trim|callback_photo');
        $this->form_validation->set_rules('signature', $this->lang->line('signature'), 'trim|callback_photo');
    }
                        
    /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Student Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->student->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->student->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
                
    /*****************Function photo**********************************
    * @type            : Function
    * @function name   : photo
    * @description     : validate student profile photo                 
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function photo() {
        if ($_FILES['photo']['name']) {
            $name = $_FILES['photo']['name'];
            $arr = explode('.', $name);
            $ext = end($arr);
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                return TRUE;
            } else {
                $this->form_validation->set_message('photo', $this->lang->line('select_valid_file_format'));
                return FALSE;
            }
        }
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

        $items = array();
        $items[] = 'admission_no';
        $items[] = 'guardian_id';
        $items[] = 'relation_with';
        $items[] = 'national_id';
        $items[] = 'registration_no';
        $items[] = 'group';
        $items[] = 'name';
        $items[] = 'phone';
        $items[] = 'gender';
        $items[] = 'blood_group';
        $items[] = 'present_address';
        $items[] = 'permanent_address';
        $items[] = 'religion';
        $items[] = 'discount_id';
        $items[] = 'second_language';
        $items[] = 'previous_school';
        $items[] = 'previous_class';
        $items[] = 'father_name';
        $items[] = 'father_phone';
        $items[] = 'father_education';
        $items[] = 'father_profession';
        $items[] = 'father_designation';
        $items[] = 'mother_name';
        $items[] = 'mother_phone';
        $items[] = 'mother_education';
        $items[] = 'mother_profession';
        $items[] = 'mother_designation';
        $items[] = 'health_condition';
        $items[] = 'other_info';
        $items[] = 'signature';

        $data = elements($items, $_POST);
        /*$roles = $this->input->post('role_id');
        $role = explode(",", $roles); 
        $data['role_id'] = $role[0];
        $data['school_id'] = $this->session->userdata('school_id');*/
        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['admission_date'] = date('Y-m-d', strtotime($this->input->post('admission_date')));
        $data['age'] = floor((time() - strtotime($data['dob'])) / 31556926);
        $data['school_id'] = $this->session->userdata('school_id');
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status'] = 1;
            // create guardian 
            if(empty($this->input->post('guardian_id'))){
                $data['guardian_id'] = $this->student->create_user_guardian();
            }
            // create user
            $data['user_id'] = $this->student->create_user();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }
        if ($_FILES['signature']['name']) {
            $data['signature'] = $this->_upload_signature();
        }
        if ($_FILES['transfer_certificate']['name']) {
            $data['transfer_certificate'] = $this->_upload_transfer_certificate();
        }
        if ($_FILES['father_photo']['name']) {
            $data['father_photo'] = $this->_upload_father_photo();
        }
        if ($_FILES['mother_photo']['name']) {
            $data['mother_photo'] = $this->_upload_mother_photo();
        }
        //var_dump(expression)
        return $data;
    }

           
    /*****************Function _upload_photo**********************************
    * @type            : Function
    * @function name   : _upload_photo
    * @description     : process to upload student profile photo in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_photo string value 
    * ********************************************************** */
    private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/student-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
    
    /*****************Function _upload_transfer_certificate**********************************
    * @type            : Function
    * @function name   : _upload_transfer_certificate
    * @description     : process to upload student transfer_certificate in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_photo string value 
    * ********************************************************** */
    private function _upload_transfer_certificate() {

        $prev_transfer_certificate = $this->input->post('prev_transfer_certificate');
        $transfer_certificate = $_FILES['transfer_certificate']['name'];
        $transfer_certificate_type = $_FILES['transfer_certificate']['type'];
        $return_transfer_certificate = '';
        if ($transfer_certificate != "") {
            if ($transfer_certificate_type == 'image/jpeg' || $transfer_certificate_type == 'image/pjpeg' ||
                    $transfer_certificate_type == 'image/jpg' || $transfer_certificate_type == 'image/png' ||
                    $transfer_certificate_type == 'image/x-png' || $transfer_certificate_type == 'image/gif') {

                $destination = 'assets/uploads/transfer-certificate/';

                $file_type = explode(".", $transfer_certificate);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $transfer_certificate_path = 'tc-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['transfer_certificate']['tmp_name'], $destination . $transfer_certificate_path);

                // need to unlink previous transfer_certificate
                if ($prev_transfer_certificate != "") {
                    if (file_exists($destination . $prev_transfer_certificate)) {
                        @unlink($destination . $prev_transfer_certificate);
                    }
                }

                $return_transfer_certificate = $transfer_certificate_path;
            }
        } else {
            $return_transfer_certificate = $prev_transfer_certificate;
        }

        return $return_transfer_certificate;
    }

    
               
    /*****************Function _upload_father_photo**********************************
    * @type            : Function
    * @function name   : _upload_father_photo
    * @description     : process to upload student profile photo in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_father_photo string value 
    * ********************************************************** */
    private function _upload_father_photo() {

        $prev_father_photo = $this->input->post('prev_father_photo');
        $father_photo = $_FILES['father_photo']['name'];
        $father_photo_type = $_FILES['father_photo']['type'];
        $return_father_photo = '';
        if ($father_photo != "") {
            if ($father_photo_type == 'image/jpeg' || $father_photo_type == 'image/pjpeg' ||
                    $father_photo_type == 'image/jpg' || $father_photo_type == 'image/png' ||
                    $father_photo_type == 'image/x-png' || $father_photo_type == 'image/gif') {

                $destination = 'assets/uploads/father-photo/';

                $file_type = explode(".", $father_photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $father_photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['father_photo']['tmp_name'], $destination . $father_photo_path);

                // need to unlink previous father_photo
                if ($prev_father_photo != "") {
                    if (file_exists($destination . $prev_father_photo)) {
                        @unlink($destination . $prev_father_photo);
                    }
                }

                $return_father_photo = $father_photo_path;
            }
        } else {
            $return_father_photo = $prev_father_photo;
        }

        return $return_father_photo;
    }
    
    
    
               
    /*****************Function _upload_mother_photo**********************************
    * @type            : Function
    * @function name   : _upload_mother_photo
    * @description     : process to upload mother profile photo in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_mother_photo string value 
    * ********************************************************** */
    private function _upload_mother_photo() {

        $prev_mother_photo = $this->input->post('prev_mother_photo');
        $mother_photo = $_FILES['mother_photo']['name'];
        $mother_photo_type = $_FILES['mother_photo']['type'];
        $return_mother_photo = '';
        if ($mother_photo != "") {
            if ($mother_photo_type == 'image/jpeg' || $mother_photo_type == 'image/pjpeg' ||
                    $mother_photo_type == 'image/jpg' || $mother_photo_type == 'image/png' ||
                    $mother_photo_type == 'image/x-png' || $mother_photo_type == 'image/gif') {

                $destination = 'assets/uploads/mother-photo/';

                $file_type = explode(".", $mother_photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $mother_photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['mother_photo']['tmp_name'], $destination . $mother_photo_path);

                // need to unlink previous mother_photo
                if ($prev_mother_photo != "") {
                    if (file_exists($destination . $prev_mother_photo)) {
                        @unlink($destination . $prev_mother_photo);
                    }
                }

                $return_mother_photo = $mother_photo_path;
            }
        } else {
            $return_mother_photo = $prev_mother_photo;
        }

        return $return_mother_photo;
    }
    /*****************Function _upload_signature**********************************
    * @type            : Function
    * @function name   : _upload_signature
    * @description     : process to upload signature in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_signature string value 
    * ********************************************************** */
     private function _upload_signature() {

        $prev_signature = $this->input->post('prev_signature');
        $signature = $_FILES['signature']['name'];
        $signature_type = $_FILES['signature']['type'];
        $return_signature = '';
        if ($signature != "") {
            if ($signature_type == 'image/jpeg' || $signature_type == 'image/pjpeg' ||
                    $signature_type == 'image/jpg' || $signature_type == 'image/png' ||
                    $signature_type == 'image/x-png' || $signature_type == 'image/gif') {

               $destination = 'assets/uploads/student-signature/';

                $file_type = explode(".", $signature);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $signature_path = 'signature-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['signature']['tmp_name'], $destination . $signature_path);

                // need to unlink previous photo
                if ($prev_signature != "") {
                    if (file_exists($destination . $prev_signature)) {
                        @unlink($destination . $prev_signature);
                    }
                }

                $return_signature = $signature_path;
            }
        } else {
            $return_signature = $prev_signature;
        }

        return $return_signature;
    }

    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Student" data from database                  
    *                     also delete all relational data
    *                     and unlink student photo from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
              redirect('student/index');
        }
        
        $student = $this->student->get_single('students', array('id' => $id,'school_id' => $this->session->userdata('school_id')));
        if (!empty($student)) {

            // delete student data
            $this->student->delete('students', array('id' => $id,'school_id' => $this->session->userdata('school_id')));

            // delete student login data
            $this->student->delete('users', array('id' => $student->user_id,'school_id' => $this->session->userdata('school_id')));

            // delete student enrollments
            $this->student->delete('enrollments', array('student_id' => $student->id,'school_id' => $this->session->userdata('school_id')));

            // delete student hostel_members
            $this->student->delete('hostel_members', array('user_id' => $student->user_id,'school_id' => $this->session->userdata('school_id')));

            // delete student transport_members
            $this->student->delete('transport_members', array('user_id' => $student->user_id,'school_id' => $this->session->userdata('school_id')));

            // delete student library_members
            $this->student->delete('library_members', array('user_id' => $student->user_id,'school_id' => $this->session->userdata('school_id')));

            // delete student resume and photo
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/student-photo/' . $student->photo)) {
                @unlink($destination . '/student-photo/' . $student->photo);
            }

            create_log('Has been deleted a Student : '.$student->name);
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        redirect('student/index/');
    }

        
    /*****************Function __insert_enrollment**********************************
    * @type            : Function
    * @function name   : __insert_enrollment
    * @description     : save student info to enrollment while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function __insert_enrollment($insert_id) {
        $data = array();
        $data['student_id'] = $insert_id;
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['is_hostel'] = $this->input->post('is_hostel') ? $this->input->post('is_hostel') : '0';
        $data['is_transport'] = $this->input->post('is_transport') ? $this->input->post('is_transport') : '0';
        if($this->input->post('advanced')){
            $data['academic_year_id'] = $this->input->post('academic_year_id');
        }else{            
            $data['academic_year_id'] = $this->academic_year_id;
        }
        $data['school_id'] = $this->session->userdata('school_id');
        $data['roll_no'] = $this->input->post('roll_no');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['status'] = 1;
        $this->db->insert('enrollments', $data);
    }

    /*****************Function __update_enrollment**********************************
    * @type            : Function
    * @function name   : __update_enrollment
    * @description     : update student info to enrollment while update a student                  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function __update_enrollment() {


        $data = array();
        $data['section_id'] = $this->input->post('section_id');
        $data['roll_no'] = $this->input->post('roll_no');
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();
		$data['is_hostel'] = $this->input->post('is_hostel') ? $this->input->post('is_hostel') : '0';
        $data['is_transport'] = $this->input->post('is_transport') ? $this->input->post('is_transport') : '0';
        $this->db->where('student_id', $this->input->post('id'));
        
        if($this->input->post('advanced')){
            $data['academic_year_id'] = $this->input->post('academic_year_id');
            $this->db->where('academic_year_id', $this->academic_year_id);
        }else{            
            $data['academic_year_id'] = $this->academic_year_id;
            $this->db->where('academic_year_id', $this->academic_year_id);
        }
        
        
        $this->db->update('enrollments', $data, array('school_id' => $this->session->userdata('school_id')));
    }
    
    
    /*****************Function advanced**********************************
    * @type            : Function
    * @function name   : advanced
    * @description     : Load "Add new advanced Student" user interface                 
    *                    and process to store "Student" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function advanced() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();

                $insert_id = $this->student->insert('students', $data,array('school_id' => $this->session->userdata('school_id')));

                if ($insert_id) {
                    $this->__insert_enrollment($insert_id);
                    success($this->lang->line('insert_success'));
                    redirect('student/advanced/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('student/advanced/'.$this->input->post('class_id'));
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }
        
       
        
        $class_id = $this->uri->segment(3);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }
        $session = $this->student->get_single('academic_years', array('id'=>$this->academic_year_id,'school_id' => $this->session->userdata('school_id')));   
        $this->data['class_id'] = $class_id;
       // var_dump($this->session->userdata('end_year'));
       // die();
        $this->data['students'] = $this->student->get_student_list($class_id);
        //$this->data['students'] = $this->student->get_student_list($class_id, $session->end_year);
        $this->data['academic_years'] = $this->student->get_list('academic_years', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/advanced', $this->data);
    }
    
            
    /*****************Function editadvanced**********************************
    * @type            : Function
    * @function name   : editadvanced
    * @description     : Load Update "Student" user interface                 
    *                    with populate "Student" value 
    *                    and process to update "Student" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function editadvanced($id = null) {

        check_permission(EDIT);

        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('student/advanced');     
        }
        
        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();
                $updated = $this->student->update('students', $data, array('id' => $this->input->post('id'),'school_id' => $this->session->userdata('school_id')));

                if ($updated) {
                    $this->__update_enrollment();
                    success($this->lang->line('update_success'));
                    redirect('student/advanced/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('student/editadvanced/' . $this->input->post('id'));
                }
            } else {
                $this->data['student'] = $this->student->get_single_student($this->input->post('id'), true);
            }
        }

        if ($id) {
            $this->data['student'] = $this->student->get_single_student($id, true);

            if (!$this->data['student']) {
                redirect('student/advanced');
            }
        }
        
        $class_id = $this->data['student']->class_id;
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        } 

        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->student->get_student_list($class_id, true);
        $this->data['academic_years'] = $this->student->get_list('academic_years', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->student->get_list('guardians', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->student->get_list('discounts', array('status'=> 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');  
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/advanced', $this->data);
    }


 //deactivate user
    public function deactivate($id)
    {
        $role_id = $this->session->userdata('role_id');
        if($role_id!="1")
        {
           return show_error ('You must view adminstrator to view this page'); 
        }
        if ($this->student->deactivateUser($id))
        {
            # Add success
            success('Updated status.(Deactivated');
            redirect('student', 'referesh');
        }
        else
        {
            # Failed
            success('Can\'t update status.');
            redirect('student', 'referesh');
        }
    }

    //activate user
    public function activate($id)
    {
        $role_id = $this->session->userdata('role_id');

         if($role_id!="1")
          {
           return show_error ('You must view adminstrator to view this page'); 
          }
        if ($this->student->activateUser($id))
        {
            success('Updated status(Activated).');
            redirect('student', 'referesh');
        }
        else
        {
            success('Can\'t update status.');
            redirect('student', 'referesh');
        }
    }
}
