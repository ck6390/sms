<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_vehicle_list(){
        
        $this->db->select('V.*');
        $this->db->from('vehicles AS V');
        $this->db->where('school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();
        
    }
    
    function duplicate_check($number, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('number', $number);
        $this->db->where('school_id', $this->session->userdata('school_id'));
        return $this->db->get('vehicles')->num_rows();            
    }

}
