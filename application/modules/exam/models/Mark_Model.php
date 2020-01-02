<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mark_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_student_list($exam_id = null, $class_id = null, $section_id = null, $subject_id = null){
        
        $this->db->select('S.type as subject_type');
        $this->db->from('subjects AS S'); 
        $this->db->where('S.id', $subject_id);
        $result = $this->db->get()->row();
        if($result->subject_type == 'co-curricular'){
            // Add because of remove attendance and exam schedule of exam marks
            $this->db->select(' E.roll_no,   C.name AS class_name, S.id AS student_id, S.name AS student_name, S.photo,  S.phone,  SU.type as subject_type');
            $this->db->from('students AS S');
            $this->db->join('enrollments AS E', 'E.student_id = S.id', 'left');  
            $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $this->db->join('subjects AS SU', 'SU.class_id = C.id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);       
            $this->db->where('E.class_id', $class_id);
            $this->db->where('E.section_id', $section_id);
            $this->db->where('SU.id', $subject_id);
            $this->db->where('E.school_id', $this->session->userdata('school_id'));
            $this->db->group_by('S.id');
        }else{
            $this->db->select('ES.*, E.roll_no,   C.name AS class_name, S.id AS student_id, S.name AS student_name, S.photo,  S.phone,  SU.type as subject_type');
            $this->db->from('exam_schedules AS ES');        
            $this->db->join('classes AS C', 'C.id = ES.class_id', 'left');
            $this->db->join('enrollments AS E', 'E.class_id = ES.class_id', 'left');        
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('subjects AS SU', 'SU.id = ES.subject_id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);       
            $this->db->where('E.class_id', $class_id);
            $this->db->where('E.section_id', $section_id);
            $this->db->where('ES.exam_id', $exam_id);
            $this->db->where('ES.subject_id', $subject_id);
            $this->db->where('ES.school_id', $this->session->userdata('school_id'));
        }
       
        return $this->db->get()->result();        
    }
    
    public function get_student_list_by_class($role_id, $exam_id, $class_id, $receiver_id){
        
        $this->db->select('DISTINCT(S.id), C.name AS class_name, S.id AS student_id, S.user_id, EX.title AS exam_name, S.name AS student_name, S.phone, S.guardian_id');
        $this->db->from('students AS S');        
        $this->db->join('exam_attendances AS EA', 'EA.student_id = S.id', 'left');
        $this->db->join('classes AS C', 'C.id = EA.class_id', 'left');
        $this->db->join('exams AS EX', 'EX.id = EA.exam_id', 'left');
        $this->db->where('EA.academic_year_id', $this->academic_year_id);       
        $this->db->where('EA.class_id', $class_id);
        $this->db->where('EA.exam_id', $exam_id);
        $this->db->where('EA.is_attend', 1);
        $this->db->where('S.school_id', $this->session->userdata('school_id'));

        if($receiver_id > 0){
            $role = explode(",", $role_id);
            $roles = $role[1];
            if ($roles == "Student") {
                $this->db->where('S.user_id', $receiver_id);
            }else{
                $guardian_id = $this->db->get_where('guardians', array('user_id'=>$receiver_id,'school_id' => $this->session->userdata('school_id')))->row()->id;
                $this->db->where('S.guardian', $guardian_id);
            }            
        }
        
        return $this->db->get()->result();        
    }
    
    public function get_receiver_email($role_id, $student_id){
        $role = explode(",", $role_id);
        $roles = $role[1];
        if ($roles == "Student") {
            $this->db->select('U.id, U.email, U.role_id,  S.name');
            $this->db->from('users AS U'); 
            $this->db->join('students AS S', 'S.user_id = U.id', 'left');
            $this->db->where('S.id', $student_id);
            $this->db->where('U.school_id', $this->session->userdata('school_id'));
        }else{
            $this->db->select('U.id, U.email, U.role_id, G.name');
            $this->db->from('users AS U'); 
            $this->db->join('guardians AS G', 'G.user_id = U.id', 'left');
            $this->db->join('students AS S', 'S.guardian_id = G.id', 'left');
            $this->db->where('S.id', $student_id);
            $this->db->where('U.school_id', $this->session->userdata('school_id'));
        }
        
        return $this->db->get()->row();
    }
    
    
    public function get_mark_emails(){
        $this->db->select('ME.*, R.name AS receiver_type, AY.session_year, C.name AS class_name, EX.title AS exam');
        $this->db->from('mark_emails AS ME');        
        $this->db->join('classes AS C', 'C.id = ME.class_id', 'left');
        $this->db->join('exams AS EX', 'EX.id = ME.exam_id', 'left');
        $this->db->join('roles AS R', 'R.id = ME.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ME.academic_year_id', 'left');
        $this->db->where('ME.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result(); 
    }
    
    
    public function get_single_email($id){
        $this->db->select('ME.*, R.name AS receiver_type, AY.session_year, C.name AS class_name, EX.title AS exam');
        $this->db->from('mark_emails AS ME');        
        $this->db->join('classes AS C', 'C.id = ME.class_id', 'left');
        $this->db->join('exams AS EX', 'EX.id = ME.exam_id', 'left');
        $this->db->join('roles AS R', 'R.id = ME.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = ME.academic_year_id', 'left');
        $this->db->where('ME.id', $id);
        $this->db->where('ME.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row(); 
    }
    
    public function get_mark_sms_list(){
        $this->db->select('MS.*, R.name AS receiver_type, AY.session_year, C.name AS class_name, EX.title AS exam_name');
        $this->db->from('mark_smses AS MS');        
        $this->db->join('classes AS C', 'C.id = MS.class_id', 'left');
        $this->db->join('exams AS EX', 'EX.id = MS.exam_id', 'left');
        $this->db->join('roles AS R', 'R.id = MS.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = MS.academic_year_id', 'left');
        $this->db->where('MS.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result(); 
    }
    
    public function get_single_sms($id){
        $this->db->select('MS.*, R.name AS receiver_type, AY.session_year, C.name AS class_name, EX.title AS exam_name');
        $this->db->from('mark_smses AS MS');        
        $this->db->join('classes AS C', 'C.id = MS.class_id', 'left');
        $this->db->join('exams AS EX', 'EX.id = MS.exam_id', 'left');
        $this->db->join('roles AS R', 'R.id = MS.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = MS.academic_year_id', 'left');
        $this->db->where('MS.id', $id);
        $this->db->where('MS.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row(); 
    }
    
    public function get_marks_list_by_student($exam_id, $class_id, $student_id){
        
        $this->db->select('M.*, S.name AS subject');
        $this->db->from('marks AS M'); 
        $this->db->join('subjects AS S', 'S.id = M.subject_id', 'left');
        $this->db->where('M.exam_id', $exam_id);
        $this->db->where('M.class_id', $class_id);
        $this->db->where('M.student_id', $student_id);
        $this->db->where('M.academic_year_id', $this->academic_year_id); 
        $this->db->where('M.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result(); 
    }
}
