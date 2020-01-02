<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_Hall_Ticket_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_student_list($class_id){

        $this->db->select('E.roll_no,  S.id, S.user_id, S.name, U.unique_id');
        $this->db->from('enrollments AS E');        
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'S.user_id = U.id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);       
        $this->db->where('E.class_id', $class_id);     
        $this->db->where('E.school_id', $this->session->userdata('school_id'));     
        return $this->db->get()->result();       
    }

    public function generate_exam_hall_ticket($exam_id,$class_id,$student_id){

        //$this->db->select('E.roll_no, S.id,S.name as student_name,U.unique_id,group_concat(DISTINCT EX.title separator ",") AS exam_name,group_concat(DISTINCT ES.exam_date separator ",") AS exam_date,group_concat(DISTINCT ES.start_time separator ",") AS start_time,group_concat(DISTINCT ES.end_time separator ",") AS end_time,group_concat(DISTINCT ES.room_no separator ",") AS room_no,group_concat(DISTINCT SB.name separator ",") as subject_name,C.name as class_name,C.numeric_name,group_concat(DISTINCT AY.session_year separator ",") as session_year,ES.exam_id');
		///group_concat(EX.title separator ",")
		$this->db->select('E.roll_no,S.admission_no as admission_no, S.id,S.name as student_name,U.unique_id,group_concat(DISTINCT EX.title separator ",") AS exam_name,group_concat(ES.exam_date separator ",") AS exam_date,group_concat(ES.start_time separator ",") AS start_time,group_concat(ES.end_time separator ",") AS end_time,group_concat(ES.room_no separator ",") AS room_no,group_concat(SB.name separator ",") as subject_name,C.name as class_name,C.numeric_name,group_concat(DISTINCT AY.session_year separator ",") as session_year,ES.exam_id');

        $this->db->from('exam_schedules AS ES');       

        $this->db->join('students AS S', 'S.id ='.$student_id);
        $this->db->join('subjects AS SB', 'SB.id = ES.subject_id', 'left');
        $this->db->join('classes AS C', 'C.id = ES.class_id', 'left');
        $this->db->join('users AS U', 'S.user_id = U.id', 'left');
        $this->db->join('enrollments AS E', 'E.student_id = S.id', 'left');
        $this->db->join('exams AS EX', 'EX.id = ES.exam_id', 'left'); 
        $this->db->join('academic_years AS AY', 'AY.id = ES.academic_year_id', 'left');

        $this->db->where('ES.academic_year_id', $this->academic_year_id);       
        $this->db->where('ES.class_id', $class_id);
        $this->db->where('ES.exam_id='.$exam_id);    
        $this->db->group_by('S.id'); 
        $this->db->where('ES.school_id', $this->session->userdata('school_id'));     
        return $this->db->get()->result();       
    }

    public function get_exam_hall_ticket($id){
        $this->db->select('E.*, S.photo, S.dob, S.signature');
        $this->db->from('exam_hall_tickets AS E');
        $this->db->join('students AS S', 'S.id = E.s_id', 'left');
        $this->db->where('E.id', $id);
        //$this->db->where('E.id', $this->academic_year_id);
        $this->db->where('E.school_id', $this->session->userdata('school_id'));    
        return $this->db->get()->row();
    } 

}
