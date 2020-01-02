<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenditure_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    public function get_expenditure_list(){
        
        $this->db->select('E.*, H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();        
    }
    public function get_single_expenditure($id){
        
        $this->db->select('E.*, H.title AS head, AY.session_year');
        $this->db->from('expenditures AS E');        
        $this->db->join('expenditure_heads AS H', 'H.id = E.expenditure_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = E.academic_year_id', 'left');
        $this->db->where('E.id', $id); 
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row();        
    }
}
