<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth_Model
 *
 * @author Nafeesa
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function get_operation_list(){
        $this->db->select('O.*, M.module_name');
        //$this->db->select('O.*, M.module_name,states.state_name,districts.district_name');
        $this->db->from('operations AS O');
        $this->db->join('modules AS M', 'M.id = O.module_id', 'left');
        $this->db->order_by('M.id');
       // $this->db->where('O.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();
    }


}
