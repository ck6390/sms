<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Verify.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Verify
 * @description     : This class used to store purchase code in the database for customer security.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Verify extends CI_Controller {
    
    function __construct() {       
        parent::__construct();  
        $this->load->model('Verify_Model', 'verify', true);
        //$this->load->helper(array('language'));
        
    }


    public function index() {
        if ($this->input->post('submit'))
        {
             # on Submit
             $this->form_validation->set_rules(
                 'email',//field_name
                 'Email Id',//error
                 'required|trim'
             );
             $this->form_validation->set_rules(
                 'licence',//field_name
                 'Licence Key',//error
                 'required|trim'
             );
             $this->form_validation->set_rules(
                 'phone',//field_name
                 'phone no.',//error
                 'required|trim|min_length[10]'
             );
             
             $this->form_validation->set_message(array(
                 'required'=>'You have to fill %s.'
             ));
             if ($this->form_validation->run())
             {   
                    $email = $this->input->post('email');
                    $phone = $this->input->post('phone');
                    $licence = $this->input->post('licence');
                                     
                //var_dump($this->verify->avtivate_licence($school_id));
               //die();
                if($this->verify->avtivate_licence($email,$phone,$licence))
                    {
                      
                        # Added success
                         $this->session->set_flashdata('success', 'Licence is activated now.');
                        redirect('welcome', 'referesh');
                    }
                else
                    {
                       
                        # Failed
                        //$this->session->set_flashdata('message', 'Something went wrong. Can not add '.$school_id.'.');
                        $this->session->set_flashdata('error', 'Something went wrong. Can not update licence.');
                        redirect('verify', 'referesh');

                    }
             }
            else{
                    $this->load->view('verify');     
                }
        }  
         $this->load->view('verify');
    }
}
