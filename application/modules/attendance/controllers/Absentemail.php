<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Absentemail.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Absentemail
 * @description     : Manage email which are send to all type of system users.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Absentemail extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Absentemailsms_Model', 'mail', true);
        $this->data['emails'] = $this->mail->get_email_list();
        $this->data['classes'] = $this->mail->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['roles'] = $this->mail->get_list('roles', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Sent Absentemail List" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_email') . ' | ' . SMS);
        $this->layout->view('mail/index', $this->data);
    }

    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Send new Email" user interface                 
    *                    and process to send "Email"
    *                    and store email into database
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_email_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_email_data();

                $insert_id = $this->mail->insert('emails', $data);
                if ($insert_id) {
                    $data['email_id'] = $insert_id;
                    $this->_send_email($data);
                    
                     create_log('Has been sent an Absent Email : '.$data['subject']);
                    
                    success($this->lang->line('insert_success'));
                    redirect('attendance/absentemail/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('attendance/absentemail/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('send') . ' ' . $this->lang->line('email') . ' | ' . SMS);
        $this->layout->view('mail/index', $this->data);
    }

        
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific email data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        check_permission(VIEW);

        if ($id) {
            $this->data['email'] = $this->mail->get_single_email($id);

            if (!$this->data['email']) {
                redirect('attendance/absentemail/index');
            }
        }

        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('email') . ' | ' . SMS);
        $this->layout->view('mail/view', $this->data);
    }
    
    
    /*****************Function get_single_email**********************************
     * @type            : Function
     * @function name   : get_single_email
     * @description     : "Load single email information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_email(){
        
       $email_id = $this->input->post('email_id');
       
       $this->data['email'] = $this->mail->get_single_email($email_id);
       echo $this->load->view('mail/get-single-email', $this->data);
    }

        
    /*****************Function _prepare_email_validation**********************************
    * @type            : Function
    * @function name   : _prepare_email_validation
    * @description     : Process "Email" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_email_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-attendance" style="color: red;">', '</div>');

        $this->form_validation->set_rules('role_id', $this->lang->line('receiver_type'), 'trim|required');
        if ($this->input->post('role_id') == STUDENT) {
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        }
        $this->form_validation->set_rules('receiver_id', $this->lang->line('receiver'), 'trim|required');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required');
        $this->form_validation->set_rules('body', $this->lang->line('email_body'), 'trim|required');
        $this->form_validation->set_rules('absent_date', $this->lang->line('absent') . ' '. $this->lang->line('date'), 'trim|required');
    }

       
    /*****************Function _get_posted_email_data**********************************
    * @type            : Function
    * @function name   : _get_posted_email_data
    * @description     : Prepare "Email" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_email_data() {

        $items = array();
        $items[] = 'role_id';
        $items[] = 'subject';
        $items[] = 'body';
        $data = elements($items, $_POST);
        $data['school_id'] = $this->session->userdata('school_id');
        $data['body'] = nl2br($data['body']);

        $data['absent_date'] = date('Y-m-d', strtotime($this->input->post('absent_date')));
        $data['academic_year_id'] = $this->academic_year_id;
        $data['sender_role_id'] = $this->session->userdata('role_id');
        $data['status'] = 1;
        $data['email_type'] = 'absent';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        return $data;
    }

          
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Email" data from database                  
    *                    and unlink attachmnet document form server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);

        $mail = $this->mail->get_single('emails', array('id' => $id,'school_id' => $this->session->userdata('school_id')));
        if ($this->mail->delete('emails', array('id' => $id,'school_id' => $this->session->userdata('school_id')))) {

            create_log('Has been deleted an Absent Email : '.$mail->subject);
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('attendance/absentemail/index');
    }

    
        
    /*****************Function _send_email**********************************
    * @type            : Function
    * @function name   : _send_email
    * @description     : Process to send email to the users                  
    *                    
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    private function _send_email($data) {

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $setting = $this->mail->get_single('settings', array('status' => 1,'id' => $this->session->userdata('school_id')));
        $from_email = $setting->email;
        $from_name  = $setting->school_name;

        $absent_date = date($this->config->item('date_format'), strtotime($this->input->post('absent_date')));

        $receivers = '';
        $users = $this->mail->get_user_list($data['role_id'], $this->input->post('receiver_id'), $this->input->post('class_id'));

        foreach ($users as $obj) {
           
            // check is user was absent or not            
            $is_absent = false;
            $role = explode(",", $data['role_id']);      
            $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();
            if($get_role_by_id->name == "Student"){
                
                $condition['student_id'] = $obj->student_id;
                $condition['class_id'] = $this->input->post('class_id');
                $condition['month'] = date('m', strtotime($this->input->post('absent_date')));
                $condition['year'] = date('Y', strtotime($this->input->post('absent_date')));
                $field = 'day_' . abs(date('d', strtotime($this->input->post('absent_date')))); 
                $condition[$field] = 'A';

                $attendance = $this->mail->get_single('student_attendances', $condition);
                if(!empty($attendance)){
                    $is_absent = TRUE;
                }
                
            }elseif($get_role_by_id->name == "Teacher"){
                //var_dump('sdfsd');
               // die();
                $condition['teacher_id'] = $obj->teacher_id;
                $condition['month'] = date('m', strtotime($this->input->post('absent_date')));
                $condition['year'] = date('Y', strtotime($this->input->post('absent_date')));
                $field = 'day_' . abs(date('d', strtotime($this->input->post('absent_date')))); 
                $condition[$field] = 'A';
               // var_dump($condition);
                $attendance = $this->mail->get_single('teacher_attendances', $condition);
                //var_dump($attendance);
                //die();
                if(!empty($attendance)){
                    $is_absent = TRUE;
                }
                
            }elseif($get_role_by_id->name == "Guardian"){
                
                $student = $this->mail->get_single_student($obj->guardian_id,  $this->input->post('class_id'));
                
                $condition['student_id'] = $student->id;
                $condition['class_id'] = $this->input->post('class_id');
                $condition['month'] = date('m', strtotime($this->input->post('absent_date')));
                $condition['year'] = date('Y', strtotime($this->input->post('absent_date')));
                $field = 'day_' . abs(date('d', strtotime($this->input->post('absent_date')))); 
                $condition[$field] = 'A';
                $attendance = $this->mail->get_single('student_attendances', $condition);
                if(!empty($attendance)){
                    $is_absent = TRUE;
                }
                
            }else{
                
                $condition['employee_id'] = $obj->employee_id;
                $condition['month'] = date('m', strtotime($this->input->post('absent_date')));
                $condition['year'] = date('Y', strtotime($this->input->post('absent_date')));
                $field = 'day_' . abs(date('d', strtotime($this->input->post('absent_date')))); 
                $condition[$field] = 'A';
                $attendance = $this->mail->get_single('employee_attendances', $condition);
                if(!empty($attendance)){
                    $is_absent = TRUE;
                }
            }
            
            //var_dump($is_absent);
            //die();
            if($is_absent){                
              // var_dump($role[0]);

               //die();               
                $body = get_formatted_body($data['body'], $data['role_id'], $obj->id);

                $body = str_replace('[absent_date]', $absent_date, $body); 
               
                $receivers .= $obj->name.',';
                var_dump($receivers);
                die();
                $this->email->from($from_email, $from_name);
                $this->email->reply_to($from_email, $from_name);

                $this->email->to($obj->email);
                $this->email->subject($data['subject']);
                $this->email->message($body);
                
                $this->email->send();
            }
            
        }
        
        // update emails table 
        $this->mail->update('emails', array('receivers' => $receivers), array('id' => $data['email_id'],'school_id' => $this->session->userdata('school_id')));
    }

}