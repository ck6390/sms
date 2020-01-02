<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }  
    
     function duplicate_check($page_name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('page_name', $page_name);      
        return $this->db->get('pages')->num_rows();            
    }

}
