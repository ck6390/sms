<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
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
        return $this->db->get('users')->num_rows();            
    }

    public  function deactivateUser($id)
    {

        $email = $this->uri->segment(4); 
        $status = array(
            'status'  => 0
        );
        $query = $this->db->update('teachers', $status, array('id'=>$id));
        $query = $this->db->update('users', $status, array('email'=>base64_decode($email)));
        return $query;
    }

    public function activateUser($id)
    {
       $email = $this->uri->segment(4);      
        $status = array(
            'status'  => 1
        );
        $query = $this->db->update('teachers', $status, array('id'=>$id));
        $query = $this->db->update('users', $status, array('email'=>base64_decode($email)));
        return $query;
    }
}
