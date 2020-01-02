<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Marksheet.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Marksheet
 * @description     : Manage exam mark sheet.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Marksheet extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Marksheet_Model', 'mark', true);
        $this->data['classes'] = $this->mark->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        //$this->data['exams'] = $this->mark->get_list('exams', array('status' => 1, 'academic_year_id' => $this->academic_year_id), '', '', '', 'id', 'ASC');
        $this->data['academic_years'] = $this->mark->get_list('academic_years', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
       
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Mark sheet" user interface                 
    *                    with data filter option
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        if ($_POST) {
            if($this->session->userdata('role_id')==4){
               
                $ci = & get_instance();

                $ci->db->select('S.*, G.name AS guardian, E.roll_no, E.section_id, E.class_id, U.email, U.role_id,  C.name AS class_name, SE.name AS section, D.title AS discount');
                $ci->db->from('enrollments AS E');
                $ci->db->join('students AS S', 'S.id = E.student_id', 'left');
                $ci->db->join('guardians AS G', 'G.id = S.guardian_id', 'left');
                $ci->db->join('users AS U', 'U.id = S.user_id', 'left');
                $ci->db->join('classes AS C', 'C.id = E.class_id', 'left');
                $ci->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
                $ci->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
                //$ci->db->where('S.user_id', $user_id);
                $ci->db->where('E.school_id',$this->session->userdata('school_id'));
                $student = $ci->db->get()->row();
                

                //$student = get_user_by_role($this->session->userdata('role_id'), $this->session->userdata('id'));
                
                $class_id = $student->class_id;
                $section_id = $student->section_id;
                $student_id = $student->id;
                
            }else{
                
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                
                $student = $this->mark->get_single('students', array('id'=>$student_id,'school_id' => $this->session->userdata('school_id')));
                $ci = & get_instance();

                $ci->db->select('S.*, G.name AS guardian, E.roll_no, E.section_id, E.class_id, U.email, U.role_id,  C.name AS class_name, SE.name AS section, D.title AS discount');
                $ci->db->from('enrollments AS E');
                $ci->db->join('students AS S', 'S.id = E.student_id', 'left');
                $ci->db->join('guardians AS G', 'G.id = S.guardian_id', 'left');
                $ci->db->join('users AS U', 'U.id = S.user_id', 'left');
                $ci->db->join('classes AS C', 'C.id = E.class_id', 'left');
                $ci->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
                $ci->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
                $ci->db->where('S.user_id', $student->user_id);
                $ci->db->where('E.school_id',$this->session->userdata('school_id'));
                $student = $ci->db->get()->row();               
               
                //$student = get_user_by_role(STUDENT, $student->user_id);
            }
            
            $exam_id = $this->input->post('exam_id');
            $exam = $this->mark->get_single('exams', array('id'=>$exam_id,'school_id' => $this->session->userdata('school_id')));
           // var_dump($exam);
            $this->data['subjects'] = $this->mark->get_subject_list($exam_id, $class_id, $section_id, $student_id);
            //var_dump($this->data['subjects']);
           // die();
            $this->academic_year_id = $this->input->post('academic_year_id') ? $this->input->post('academic_year_id') : $this->academic_year_id;
            $this->data['academic_year_id'] = $this->academic_year_id;
            //var_dump($this->data['academic_year_id']);
           // die();
            $this->data['exam'] = $exam;
            $this->data['student'] = $student;
            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id,'school_id' => $this->session->userdata('school_id')));
            //var_dump( $class);
            //die();
            create_log('Has been filter exam mark sheet for class: '. $class->name);
        }
        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('mark_sheet') . ' | ' . SMS);
        $this->layout->view('mark_sheet/index', $this->data);
    }

}
