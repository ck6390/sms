<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_notice_list($limit){
        
        $this->db->select('N.*, R.name');
        $this->db->from('notices AS N');
        $this->db->join('roles AS R', 'R.id = N.role_id', 'left');
        $this->db->order_by('N.id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
        
    }
     public function get_single_notice($id){
        
        $this->db->select('N.*, R.name');
        $this->db->from('notices AS N');
        $this->db->join('roles AS R', 'R.id = N.role_id', 'left');
        $this->db->where('N.id', $id);
        return $this->db->get()->row();        
    }
    
     public function get_event_list($limit){
        
        $this->db->select('E.*, R.name');
        $this->db->from('events AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->order_by('E.id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
        
    }
       
    public function get_single_event($id){
        
        $this->db->select('E.*, R.name');
        $this->db->from('events AS E');
        $this->db->join('roles AS R', 'R.id = E.role_id', 'left');
        $this->db->where('E.id', $id);
        return $this->db->get()->row();
        
    }
    
     public function get_image_list($id){
        
        $this->db->select('GI.*, G.title');
        $this->db->from('gallery_images AS GI');
        $this->db->join('galleries AS G', 'G.id = GI.gallery_id', 'left');
        $this->db->where('GI.gallery_id', $id);
        return $this->db->get()->result();        
    }
    
    public function get_teacher_list(){
        
        $this->db->select('T.*, U.email, U.role_id');
        $this->db->from('teachers AS T');
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->where('T.is_view_on_web', 1);
        $this->db->order_by('T.id', 'DESC');
        return $this->db->get()->result();
        
    }
    
     public function get_employee_list(){
        
        $this->db->select('E.*, U.email, U.role_id, D.name AS designation');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');
        $this->db->where('E.is_view_on_web', 1);
        $this->db->order_by('E.id', 'DESC');
        return $this->db->get()->result();
        
    }
    
  
}
