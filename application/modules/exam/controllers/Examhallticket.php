<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Examhallticket.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Examhallticket
 * @description     : Manage exam term.  
 * @author          : Codetroopers Team     
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com   
 * @copyright       : Codetroopers Team     
 * ********************************************************** */

class Examhallticket extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Exam_Hall_Ticket_Model', 'exam_hall_tickets', true);
        $this->data['classes'] = $this->exam_hall_tickets->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['exams'] = $exams = $this->exam_hall_tickets->get_list('exams', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
         // check running session
        if(!$this->academic_year_id){
            error($this->lang->line('academic_year_setting'));
            redirect('setting');
        } 
               
    }

    
        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Exam term List" user interface                
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);
        
        
        //var_dump($this->data);
        //die();
        $this->layout->title($this->lang->line('exam_hall_ticket') . ' | ' . SMS);
        $this->layout->view('exam_hall_ticket/index', $this->data);
    }

    
    /*****************Function get_class_by_student**********************************
    * @type            : Function
    * @function name   : get_class_by_student
    * @description     : Load "Get class by students" user interface                 
    *                    and process to store "Exam term" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function get_class_by_student()
    {
        $class_id = $this->input->post('class_id');
        $student_list = $this->exam_hall_tickets->get_student_list($class_id);
       if($student_list){            
            echo "<option value='All'>===All===</option>";
                foreach ($student_list as $value) {
                    //echo "";
                    echo "<option value='$value->id'>$value->name - [$value->unique_id]</option>";
                }                   
        }
        else{
            echo "<option>Not Found Data</option>";
        }   

    }
    
    /*****************Function Add Exam Hall Ticket**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Exam term" user interface                 
    *                    with populate "Exam term" value 
    *                    and process to update "exam term" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function check_fee()
    {
       $exam_id = $this->input->post('exam_id');
       $class_id = $this->input->post('class_id');
       $student_id = $this->input->post('student_id');
       $payment_status = $this->input->post('payment_status');
        if($student_id != "All"){
            $student_list = $this->exam_hall_tickets->get_list('students', array('status'=> 1,'id'=>$student_id,'school_id'=> $this->session->userdata('school_id')));
        }else{
            $student_list = $this->exam_hall_tickets->get_student_list($class_id);
          /*  echo "<pre>";
            print_r($student_list);
            die();*/
        }
      if(count($student_list)){
        $counter = 0;
          foreach ($student_list as $students) {
                $student_fee = $this->exam_hall_tickets->get_single('invoices', array('status'=> 1,'class_id'=>$class_id,'student_id'=>$students->id,'paid_status!='=>"paid", 'school_id'=> $this->session->userdata('school_id')));
                if($payment_status == 'paid'){
                    if(empty($student_fee->student_id)){
                        $insert_id = $this->hall_tickets($exam_id,$class_id,$students->id);
                    }
                }else{
                    if(!empty($student_fee->student_id)){
                        $insert_id = $this->hall_tickets($exam_id,$class_id,$students->id);
                    }
                }
            $counter++;
          }
          if(@$insert_id)
            {  
                $total_failed = count($student_list) - $counter;  
                //create_log('Has been created an '.$this->lang->line('exam_hall_ticket'));   
                success($counter." - Students ".$this->lang->line('insert_success') ." and not inserted students - ".$total_failed);  
                redirect('exam/examhallticket/view', 'referesh');      
            }else{
                $this->session->set_flashdata('error', 'Might be all students exam hall ticket has been generated of fee due');
                redirect('exam/examhallticket/view', 'referesh');
            }  
       }else{
            $this->session->set_flashdata('error', 'Your fee not clear.');
            redirect('exam/examhallticket/view', 'referesh');
       }
    }
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific exam term data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view()
    {
      $this->data['exam_hall_ticket'] = $this->exam_hall_tickets->get_list('exam_hall_tickets', array('status'=> 1,'school_id'=> $this->session->userdata('school_id'))); 
      //var_dump($this->data);
      //die();
      $this->layout->view('exam_hall_ticket/index', $this->data);  
    }
    
    /*****************Function _prepare_exam_validation**********************************
    * @type            : Function
    * @function name   : _prepare_exam_validation
    * @description     : Process "exam term" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function exam_hall_ticket_print($id)
    {
        //$this->data['exam_hall_tickets'] = $this->exam_hall_tickets->get_single('exam_hall_tickets', array('id' => $id,'school_id' => $this->session->userdata('school_id')));
        $this->data['exam_hall_tickets'] = $this->exam_hall_tickets->get_exam_hall_ticket($id);
        $this->layout->title($this->lang->line('exam_hall_ticket') . ' | ' . SMS);
        $this->layout->view('exam_hall_ticket/exam_hall_print', $this->data); 
        //var_dump($this->data['exam_hall_tickets']);
        //die();
    }
    
    /*****************Function title**********************************
    * @type            : Function
    * @function name   : title
    * @description     : Unique check for "Exam term title" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
   
    
    /*****************Function _get_posted_exam_data**********************************
    * @type            : Function
    * @function name   : _get_posted_exam_data
    * @description     : Prepare "Exam term" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    

    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Exam Term" from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
     public function delete($id = null) {

        check_permission(DELETE);

         if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
             redirect('exam/examhallticket/view');
        }
        
        $exam_hall_tickets = $this->exam_hall_tickets->get_single('exam_hall_tickets', array('id' => $id,'school_id' => $this->session->userdata('school_id')));
        
        if ($this->exam_hall_tickets->delete('exam_hall_tickets', array('id' => $id,'school_id' => $this->session->userdata('school_id')))) {
            
            create_log('Has been deleted an exam hall tickets : '.$exam_hall_tickets->s_name); 
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('exam/examhallticket/view');
    }

    public function hall_tickets($exam_id,$class_id, $students){
         $get_exam_schedule = $this->exam_hall_tickets->generate_exam_hall_ticket($exam_id,$class_id,$students);
        // var_dump($get_exam_schedule);die();
            foreach ($get_exam_schedule as $value) {
                $data = '';
                $data = array(
                    's_id' => $value->id,
                    's_name' => $value->student_name,
                    's_roll_no' => $value->roll_no,
                    's_unique_id' => $value->admission_no,
                    's_exam_name' => $value->exam_name,
                    's_exam_date' => $value->exam_date,
                    's_start_time' => $value->start_time,
                    's_end_time' => $value->end_time,
                    's_room_no' => $value->room_no,
                    's_subject_name' => $value->subject_name,
                    's_class_name' => $value->class_name,
                    's_class_numeric_name' => $value->numeric_name,
                    's_session_year' => $value->session_year,
                    'school_id' => $this->session->userdata('school_id'),
                    's_exam_id' =>  $value->exam_id
                );
               // var_dump($data);die();
                $check_student_exam = $this->exam_hall_tickets->get_list('exam_hall_tickets', array('status'=> 1,'s_class_name'=>$value->class_name,'s_id'=>$value->id,'s_exam_id'=>$value->exam_id,'school_id'=> $this->session->userdata('school_id')));
                //var_dump($data);die(); 
                if(empty($check_student_exam)){
                   return $insert_id = $this->exam_hall_tickets->insert('exam_hall_tickets', $data);    
                }                   
            }
    }

}
