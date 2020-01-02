<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grade_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
     
    
     function duplicate_check($field, $value, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where($field, $value);
        $this->db->where('school_id', $this->session->userdata('school_id'));

        return $this->db->get('salary_grades')->num_rows();            
    }

}
