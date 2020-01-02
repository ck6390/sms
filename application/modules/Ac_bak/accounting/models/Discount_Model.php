<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Discount_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
     
    
     function duplicate_check($title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('title', $title);
        $this->db->where('school_id', $this->session->userdata('school_id'));
        return $this->db->get('discounts')->num_rows();            
    }

}
