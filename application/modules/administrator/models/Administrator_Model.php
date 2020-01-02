<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator_Model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_user_list($role_id, $class_id, $user_id) {
        $role = explode(",", $this->input->post('role_id'));
        $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role_id[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();
        if ($get_role_by_id->name == "Student") {

            $this->db->select('S.*, U.email, U.role_id, U.status AS login_status ');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);
            $this->db->where('E.school_id',$this->session->userdata('school_id'));
            if($class_id){
                $this->db->where('E.class_id', $class_id);
            }            
             if($user_id){
                $this->db->where('S.user_id', $user_id);                 
             }
            return $this->db->get()->result();
            
        } elseif ($get_role_by_id->name == "Teacher") {
            
            $this->db->select('T.*, U.email, U.role_id, U.status AS login_status ');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            $this->db->where('T.school_id',$this->session->userdata('school_id'));
             if($user_id){
                $this->db->where('T.user_id', $user_id);                 
             }
            return $this->db->get()->result();
            
        } elseif ($get_role_by_id->name == "Guardian") {
            
            $this->db->select('G.*, U.email, U.role_id, U.status AS login_status ');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->where('G.school_id',$this->session->userdata('school_id'));
             if($user_id){                 
                $this->db->where('G.user_id', $user_id);
             }
            return $this->db->get()->result();
            
        } else {
            
            $this->db->select('E.*, U.email, U.role_id, D.name AS designation, U.status AS login_status ');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
            $this->db->where('E.school_id',$this->session->userdata('school_id'));
            if($user_id){
                $this->db->where('E.user_id', $user_id);
            }
            //$this->db->where('U.role_id', $role_id);
            return $this->db->get()->result();
        }
    }

    
    public function get_activity_log($role_id, $class_id, $user_id) {
        if(!empty($role_id)){
                $role = explode(",", $role_id);       
                $get_role_by_id =  $this->db->get_where('roles', array('status' => 1,'id'=> $role[0],'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC')->row();      
                if ($get_role_by_id->name == "Student")  {

                    $this->db->select('L.*, U.email');
                    $this->db->from('activity_logs AS L');
                    $this->db->join('users AS U', 'U.id = L.user_id', 'left');
                    $this->db->join('students AS S', 'S.user_id = L.user_id', 'left');
                    $this->db->join('enrollments AS E', 'E.student_id = S.id', 'left');
                    $this->db->where('L.school_id',$this->session->userdata('school_id'));
                             
                    if($class_id){
                        $this->db->where('E.class_id', $class_id);
                    }            
                    if($user_id){
                       $this->db->where('L.user_id', $user_id);                 
                    }
                    return $this->db->get()->result();
                    
                } elseif ($get_role_by_id->name != "Student")  {
                    
                    $this->db->select('L.*, U.email');
                    $this->db->from('activity_logs AS L');
                    $this->db->join('users AS U', 'U.id = L.user_id', 'left');
                    $this->db->where('L.school_id',$this->session->userdata('school_id'));
                   
                     if($user_id){
                        $this->db->where('L.user_id', $user_id);                 
                     }
                    return $this->db->get()->result();
              
                }
            }
        else{
            $this->db->select('L.*, U.email');
            $this->db->from('activity_logs AS L');
            $this->db->join('users AS U', 'U.id = L.user_id', 'left');    
            $this->db->where('L.school_id',$this->session->userdata('school_id'));       
            $this->db->where('L.user_type','School');       
            return $this->db->get()->result();
        }
    }
    
    
    function duplicate_check($email, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('email', $email);
        $this->db->where('school_id',$this->session->userdata('school_id'));
        return $this->db->get('users')->num_rows();            
    }

}
