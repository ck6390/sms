<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Verify_Model extends CI_Model {

    

    function __construct() {

        parent::__construct();

    }

    public function avtivate_licence($email,$phone,$licence)
    {
       // var_dump($school_id);
        //die();
        $active = array(
            'is_verify'  => 1
        );        
        $query=$this->db->update('licences', $active, array('email' => $email,'phone'=>$phone,'licence'=>$licence,'active'=>1,'status'=>1)); 
        $purchase = array(
            'email'  => $email,
            'purchase_code'  => $licence
        );           
        if($this->db->affected_rows() > 0){
            $query=$this->db->insert('purchase', $purchase);  
            return true; 
        }else{
            return false;
        }
        
    }

}