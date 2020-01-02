<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absentemailsms_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    } 
    
    public function get_email_list(){
        $this->db->select('E.*, R.name AS receiver_type, AY.session_year ');
        $this->db->from('emails AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.email_type', 'absent');
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();    
    }
    
     public function get_sms_list(){
        $this->db->select('TM.*, R.name AS receiver_type, AY.session_year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = TM.academic_year_id', 'left');
        $this->db->where('TM.sms_type', 'absent');
        $this->db->where('TM.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();    
    }
    
    public function get_single_email($id){
        $this->db->select('E.*, R.name AS receiver_type, AY.session_year ');
        $this->db->from('emails AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.id', $id);
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row();    
    }
    
    public function get_single_sms($id){
        $this->db->select('TM.*, R.name AS receiver_type, AY.session_year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = TM.academic_year_id', 'left');
        $this->db->where('TM.id', $id);
        $this->db->where('TM.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row();    
    }

    public function get_user_list($role_id, $receiver_id, $class_id = null){
        
        $role = explode(",", $role_id);
      
        $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();
        
        if ($get_role_by_id->name == "Student") {
            
            $this->db->select('E.student_id, S.phone, S.name, U.email, U.role_id, U.id,  C.name AS class_name');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);
            $this->db->where('E.class_id', $class_id);
            $this->db->where('E.school_id', $this->session->userdata('school_id'));
            if($receiver_id > 0){
                $this->db->where('S.user_id', $receiver_id);
            }
            return $this->db->get()->result(); 
            
        }elseif($get_role_by_id->name == "Teacher"){
            $this->db->select('T.id AS teacher_id, T.phone, T.name, U.email, U.role_id,  U.id');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            if($receiver_id > 0){
                $this->db->where('T.school_id', $this->session->userdata('school_id'));
                $this->db->where('T.user_id', $receiver_id);
            }
            return $this->db->get()->result();            
        
        }elseif($get_role_by_id->name == "Guardian"){
            $this->db->select('G.id AS guardian_id, G.phone, G.name, U.email, U.role_id,  U.id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left'); 
            if($receiver_id > 0){
                $this->db->where('G.school_id', $this->session->userdata('school_id'));
                $this->db->where('G.user_id', $receiver_id);
            }
            return $this->db->get()->result();
        }else{
            $this->db->select('E.id AS employee_id, E.phone, E.name, U.email, U.role_id,  U.id');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            if($receiver_id > 0){
                $this->db->where('E.school_id', $this->session->userdata('school_id'));
                $this->db->where('E.user_id', $receiver_id);
            }
            return $this->db->get()->result();
        }  
    }
    
    public function get_single_student($guardian_id, $class_id){
        
        $this->db->select('S.id');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');      
        $this->db->where('E.class_id', $class_id);
        $this->db->where('S.guardian_id', $guardian_id);
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row();
        
    }

}
