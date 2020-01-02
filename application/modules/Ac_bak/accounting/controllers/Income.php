<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Income.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Income
 * @description     : Manage all kind of income like student fee, admission, fine and other income.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */
class Income extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Income_Model', 'income', true);
         $this->load->model('Invoice_Model', 'invoice', true);
         $this->load->model('Payment_Model', 'payment', true);               
    }

            
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Income List" user interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index() {
        
        check_permission(VIEW);
        
        $this->data['income_heads'] = $this->income->get_list('income_heads', array('status'=> 1,'head_type'=>'income','school_id'=> $this->session->userdata('school_id')));        
        $this->data['incomes'] = $this->income->get_income_list();
        $this->data['classes'] = $this->income->get_list('classes', array('status'=> 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
        $this->layout->title( $this->lang->line('manage_income'). ' | ' . SMS);
        $this->layout->view('income/index', $this->data);            
       
    }

    
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Income" user interface                 
     *                    and store "Income" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {

        check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_income_validation();
            
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_income_data();
                $insert_id = $this->income->insert('invoices', $data);
                if ($insert_id) {                    
                    // save transction table data
                    $data['invoice_id'] = $insert_id;
                    $this->_save_transaction($data);
                    if ($this->input->post('usertype') == 'nonexisting') {
                        $data['invoice_id'] = $insert_id;
                        $this->_save_student_register($data);
                        create_log('New Student has been register');  
                    }
                    create_log('Has been created a income : '. $data['net_amount']);
                        
                    success($this->lang->line('insert_success'));
                    redirect('accounting/income/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accounting/income/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['income_heads'] = $this->income->get_list('income_heads', array('status'=> 1,'head_type'=>'income','school_id'=> $this->session->userdata('school_id')));        
        $this->data['incomes'] = $this->income->get_income_list();
        $this->data['classes'] = $this->income->get_list('classes', array('status'=> 1,'school_id'=> $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
         
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('income'). ' | ' . SMS);
        $this->layout->view('income/index', $this->data);
    }

    
     /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Income" user interface                 
     *                    with populated "Income" value 
     *                    and update "Income" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {       
       
        check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/income/index'); 
        }
        
        if ($_POST) {
            $this->_prepare_income_validation();
            if ($this->form_validation->run() === TRUE) {
                
                $data = $this->_get_posted_income_data();
                $updated = $this->income->update('invoices', $data, array('id' => $this->input->post('id'),'school_id'=> $this->session->userdata('school_id')));

                if ($updated) {
                    
                    $this->_save_transaction($data);
                     create_log('Has been updated a income : '. $data['net_amount']);
                    
                    success($this->lang->line('update_success'));
                    redirect('accounting/income/index');                   
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('accounting/income/edit/' . $this->input->post('id'));
                }
            } else {
                  $this->data['income'] = $this->income->get_single_income($this->input->post('id'));
            }
        }
        
        if ($id) {
            $this->data['income'] = $this->income->get_single_income($id);

            if (!$this->data['income']) {
                 redirect('accounting/income/index');
            }
        }

        $this->data['income_heads'] = $this->income->get_list('income_heads', array('status'=> 1,'head_type'=>'income','school_id'=> $this->session->userdata('school_id')));        
        $this->data['incomes'] = $this->income->get_income_list();
         
        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('income'). ' | ' . SMS);
        $this->layout->view('income/index', $this->data);
    }
    
    
     /*****************Function view**********************************
     * @type            : Function
     * @function name   : view
     * @description     : Load user interface with specific Income data                 
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function view($id = null){
        
        check_permission(VIEW);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/income/index'); 
        }
        
        $this->data['income_heads'] = $this->income->get_list('income_heads', array('status'=> 1,'head_type'=>'income','school_id'=> $this->session->userdata('school_id')));        
        $this->data['incomes'] = $this->income->get_income_list();
         
        $this->data['income'] = $this->income->get_single_income($id);
        $this->data['detail'] = TRUE;       
        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('income'). ' | ' . SMS);
        $this->layout->view('income/index', $this->data);
    }

    /*****************Function detail**********************************
     * @type            : Function
     * @function name   : view
     * @description     : Load user interface with specific Income data                 
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function detail($id = null){
        check_permission(VIEW);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/income/index');
        }
        $this->data['settings'] = $this->invoice->get_single('settings', array('status'=>1,'id'=> $this->session->userdata('school_id')));
        $invoice = $this->payment->get_invoice_amount($id);
        $this->data['paid_amount'] = $invoice->paid_amount;
        $this->data['invoice'] = $this->invoice->get_single_invoice($id);
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('income/detail', $this->data);
    }

               
     /*****************Function get_single_income*********************************
     * @type            : Function
     * @function name   : get_single_income
     * @description     : "Load single income information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_income(){
        
       $income_id = $this->input->post('income_id');       
       $this->data['income'] = $this->income->get_single_income($income_id);
       echo $this->load->view('income/get-single-income', $this->data);
    }

    
    /*****************Function _prepare_income_validation**********************************
     * @type            : Function
     * @function name   : _prepare_income_validation
     * @description     : Process "Income" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_income_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('income_head_id', $this->lang->line('income_head'), 'trim|required');
        if($this->input->post('usertype') == 'existing') {
            $this->form_validation->set_rules('student_id', 'Please select a student', 'trim|required|numeric');
            $this->form_validation->set_message('numeric', 'Please select a student');
        }elseif ($this->input->post('usertype') == 'nonexisting') {
            $this->form_validation->set_rules('add_student_name', $this->lang->line('name'), 'trim|required');
            $this->form_validation->set_rules('add_student_phone', $this->lang->line('phone'), 'trim|required|numeric');
            $this->form_validation->set_rules('add_student_email', $this->lang->line('email'), 'trim|required|valid_email');
        }
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|numeric');   
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required');   
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }


           
    /*****************Function _get_posted_income_data**********************************
     * @type            : Function
     * @function name   : _get_posted_income_data
     * @description     : Prepare "Income" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_income_data() {
     
        $data = array();
        $data['income_head_id'] = $this->input->post('income_head_id');
        $data['note'] = $this->input->post('note');
        $data['gross_amount'] = $this->input->post('amount');
        $data['net_amount'] = $this->input->post('amount');
        $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
        if($this->input->post('usertype') == 'existing'){
            $data['student_id'] = $this->input->post('student_id');
        }else{
            $data['student_id'] = 0;
        }
        $data['net_amount'] = $this->input->post('amount');
        
        $data['school_id']= $this->session->userdata('school_id');  
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['custom_invoice_id'] = $this->income->get_custom_id('invoices', 'INV');
            //$data['class_id'] = 0;
            $data['class_id'] = $this->input->post('class_id');
            //$data['student_id'] = 0;
            
            $data['discount'] = 0;
            $data['invoice_type'] = 'income';
            $data['paid_status'] = 'paid';
            $data['status'] = 1;
            $data['academic_year_id'] = $this->academic_year_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();            
           
        }

        return $data;
    }

    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Income" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/income/index'); 
        }
        
        $income = $this->income->get_single('invoices', array('id' => $id,'school_id'=> $this->session->userdata('school_id')));
        
        if ($this->income->delete('invoices', array('id' => $id,'school_id'=> $this->session->userdata('school_id')))) { 
            
            create_log('Has been deleted a income : '. $income->net_amount);
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('accounting/income/index');
    } 
    
    
    /*****************Function _save_transaction**********************************
     * @type            : Function
     * @function name   : _save_transaction
     * @description     : transaction data save/update into database 
     *                    while add/update income data into database                
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    private function _save_transaction($data){
        
        $txn = array();
        $txn['amount'] = $data['net_amount'];  
        $txn['note'] = $data['note'];
        $txn['payment_date'] = $data['date'];
        $txn['payment_method'] = $this->input->post('payment_method');
        $txn['bank_name'] = $this->input->post('bank_name');
        $txn['cheque_no'] = $this->input->post('cheque_no');
      
        if ($this->input->post('id')) {
            
            $txn['modified_at'] = date('Y-m-d H:i:s');
            $txn['modified_by'] = logged_in_user_id();
            $this->income->update('transactions', $txn, array('invoice_id'=>$this->input->post('id'),'school_id'=> $this->session->userdata('school_id')));
            
        } else {            
           
            $txn['invoice_id'] = $data['invoice_id'];
            $txn['status'] = 1;
            $txn['academic_year_id'] = $data['academic_year_id'];            
            $txn['created_at'] = $data['created_at'];
            $txn['created_by'] = $data['created_by'];
            $txn['school_id']= $this->session->userdata('school_id');
            $this->income->insert('transactions', $txn);
        }
    }
    /*****************Function _save_transaction**********************************
     * @type            : Function
     * @function name   : _save_student_register
     * @description     : transaction data save/update into database 
     *                    while add/update income data into database                
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    private function _save_student_register($data){        
        $stuReg = array();
        $stuReg['class_id'] = $this->input->post('class_id');  
        $stuReg['student_name'] = $this->input->post('add_student_name');
        $stuReg['student_phone'] = $this->input->post('add_student_name');
        $stuReg['student_email'] = $this->input->post('add_student_email');
      
        if ($this->input->post('id')) {            
            $stuReg['modified_at'] = date('Y-m-d H:i:s');
            $stuReg['modified_by'] = logged_in_user_id();
            //$this->income->update('student_register', $txn, array('invoice_id'=>$this->input->post('id'),'school_id'=> $this->session->userdata('school_id')));            
        } else {  
            $stuReg['invoice_id'] = $data['invoice_id'];
            $stuReg['status'] = 1;
            $stuReg['academic_year_id'] = $this->academic_year_id;
            $stuReg['created_at'] = date('Y-m-d H:i:s');
            $stuReg['created_by'] = logged_in_user_id();
            $stuReg['school_id']= $this->session->userdata('school_id');
            $this->income->insert('student_register', $stuReg);
        }
    }
}