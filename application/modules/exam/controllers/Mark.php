<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Mark.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Mark
 * @description     : Manage exam mark for student whose are attend in the exam.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Mark extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Mark_Model', 'mark', true);
        $this->data['classes'] = $this->mark->get_list('classes', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['exams'] = $this->mark->get_list('exams', array('status' => 1, 'academic_year_id' => $this->academic_year_id,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['grades'] = $this->mark->get_list('grades', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Exam Mark List" user interface                 
    *                    with filter option  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        if ($_POST) {

             $exam_id = $this->input->post('exam_id');
             $class_id = $this->input->post('class_id');
             $section_id = $this->input->post('section_id');
             $subject_id = $this->input->post('subject_id');

            $this->data['students'] = $this->mark->get_student_list($exam_id, $class_id, $section_id, $subject_id);
            //var_dump($this->data['students']);
            //die();
            $condition = array(
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'academic_year_id' => $this->academic_year_id,
                'subject_id' => $subject_id
            );

            $data = $condition;
            if (!empty($this->data['students'])) {

                foreach ($this->data['students'] as $obj) {

                    $condition['student_id'] = $obj->student_id;
                    $mark = $this->mark->get_single('marks', $condition);

                    if (empty($mark)) {
                        $data['student_id'] = $obj->student_id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['created_by'] = logged_in_user_id();
                        $data['school_id'] = $this->session->userdata('school_id');
                        $this->mark->insert('marks', $data);
                    }
                }
            }

            $this->data['exam_id'] = $exam_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['subject_id'] = $subject_id;
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id,'school_id' => $this->session->userdata('school_id')));
            create_log('Has been process exam mark for class: '. $class->name);
        }
        $this->layout->title($this->lang->line('manage_mark') . ' | ' . SMS);
        $this->layout->view('mark/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Process to store "Exam Mark" into database                
    *                     
    * @param           : null
    * @return          : null 
     * ********************************************************** */
    public function add() {

        check_permission(ADD);
        if ($_POST) {

            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $subject_id = $this->input->post('subject_id');

            $condition = array(
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'academic_year_id' => $this->academic_year_id,
                'subject_id' => $subject_id
            );

            $data = $condition;

           
            if (!empty($_POST['students'])) {

                foreach ($_POST['students'] as $key => $value) {
                    $condition['student_id'] = $value;
                    
                    $data['exam_total_mark'] = @$_POST['exam_total_mark'][$value];
                    $data['obtain_total_mark'] = @$_POST['obtain_total_mark'][$value];
                    if(!empty($_POST['grade_id'][$value])){
                        $data['grade_id'] = @$_POST['grade_id'][$value];  
                    }else{
                        $data['grade_id'] = '';
                    }           
                    $data['remark'] = $_POST['remark'][$value];
                    $data['status'] = 1;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $data['school_id'] = $this->session->userdata('school_id');
                    $this->mark->update('marks', $data, $condition);
                }

                //var_dump($data);
               //die();
            }
            
            $class = $this->mark->get_single('classes', array('id'=>$class_id,'school_id' => $this->session->userdata('school_id')));
            create_log('Has been process exam mark and save for class: '. $class->name);
            
            success($this->lang->line('insert_success'));
            redirect('exam/mark');
        }

        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('mark') . ' | ' . SMS);
        $this->layout->view('mark/index', $this->data);
    }

}
