<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_employee_list(){
        
        $this->db->select('E.*, U.email, U.role_id, D.name AS designation,U.unique_id');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();
        
    }
    
    public function get_single_employee($id){
        
        $this->db->select('E.*, U.email, E.role_id, R.name AS role, D.name AS designation, SG.grade_name,U.unique_id');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->join('salary_grades AS SG', 'SG.id = E.salary_grade_id', 'left');
        $this->db->where('E.id', $id);
        $this->db->where('E.school_id',$this->session->userdata('school_id'));
        return $this->db->get()->row();
        
    }
     public function get_teacher_list(){
            
            $this->db->select('T.*, U.email, U.role_id,U.unique_id');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            $this->db->where('T.school_id', $this->session->userdata('school_id'));
            return $this->db->get()->result();
            
        }
        
        public function get_single_teacher($id){
            
            $this->db->select('T.*, U.email, T.role_id, R.name AS role, SG.grade_name,U.unique_id');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            $this->db->join('roles AS R', 'R.id = T.role_id', 'left');
            $this->db->join('salary_grades AS SG', 'SG.id = T.salary_grade_id', 'left');
            $this->db->where('T.id', $id);
            $this->db->where('T.school_id', $this->session->userdata('school_id'));
            return $this->db->get()->row();
            
        }  
     function duplicate_check($email, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('email', $email);
        $this->db->where('school_id', $this->session->userdata('school_id'));
        return $this->db->get('users')->num_rows();            
    }
}
