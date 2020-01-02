<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Payment.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Payment
 * @description     : Manage all kind of paymnet transaction by integrated payment gateway.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Payment extends My_Controller {

    public $data = array();
    public $academic_year_id;
    
    //https://github.com/bitmash/alipay-api-php/blob/master/Alipay.php
    
    function __construct() {
        parent::__construct();
         $this->load->model('Payment_Model', 'payment', true);
         $this->load->model('Invoice_Model', 'invoice', true);
         
         $this->config->load('custom');
         //$this->load->library("paypal");
         $this->load->library("CCAencrypt");
         $this->load->library("TransactionRequest");
        
         $this->load->helper('paytm');

        $this->load->library('twilio');
        $this->load->library('clickatell');
        $this->load->library('bulk');
        $this->load->library('msg91');
        $this->load->library('plivo');
        $this->load->library('smscountry');
        $this->load->library('textlocalsms');
        $this->load->helper('sms_helper');
    }

    

    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Payment" user interface                 
    *                    with specific invoice data   
    * @param           : $invoice_id integer value
    * @return          : null 
    * ********************************************************** */
    public function index($invoice_id = null) {
        
        check_permission(VIEW);
       
        /*if(!$invoice_id){
            redirect('accounting/invoice/due');
        }*/
        $invIds = $_POST['inv_ids'];
       /* echo "<PRE>";
        print_r($_POST);
        die;*/
        if(empty($_POST['inv_ids'])){
            redirect('accounting/invoice/due');
        }
        $due_amount = 0;
        $net_amt = 0;
        $paid_amt = 0;
        foreach ($invIds as $invId) {            
            $invoice = $this->payment->get_invoice_amount($invId);
            $net_amt += $invoice->net_amount; 
            $paid_amt += $invoice->paid_amount;            
        }
        $due_amount  = $net_amt - $paid_amt;
        //$invoice         = $this->payment->get_invoice_amount($invoice_id);      
        //$due_amount      = $invoice->net_amount - $invoice->paid_amount;
        //$this->data['due_amount'] = $due_amount;
        $this->data['due_amount'] = $this->input->post('amount');
        $this->data['invoice_id'] = $invIds;
        $post_amount = intVal(trim($this->input->post('amount')));
        if($due_amount < $post_amount || $post_amount == '0'){
            success('Entered amount is greater than due amount');
            redirect('accounting/invoice/view/'.$invoice->custom_invoice_id);
        }
        $this->data['list'] = TRUE;
        $this->layout->title( $this->lang->line('payment'). ' | ' . SMS);
        $this->layout->view('payment/index', $this->data); 
        
        
    }
    

    
    /*****************Function paid**********************************
    * @type            : Function
    * @function name   : paid
    * @description     : Process invoice payment with integrated payment gateway                  
    *                      
    * @param           : $invoice_id integer value
    * @return          : null 
    * ********************************************************** */
    public function paid($invoice_id = null) {

        check_permission(ADD);
        if ($_POST) {
            $this->_prepare_payment_validation();
            if ($this->form_validation->run() === TRUE) {
                $dataList = $this->_get_posted_payment_data();

                create_log('Has been proceeded a payment : '. $this->input->post('amount'). ' in :' . $this->input->post('payment_method'));
                $invoice_ids = base64_encode(json_encode($this->input->post('invoice_id')));
                if($this->input->post('payment_method') == 'cash' || $this->input->post('payment_method') == 'cheque'){
                    if(!empty($dataList)){ 
                        $paid_amount = $this->input->post('amount');
                        foreach ($dataList as $data) {
                            if($paid_amount > 0){
                                if($paid_amount < $data['amount']){
                                    $data['amount'] = $paid_amount;
                                    $insert_id = $this->payment->insert('transactions', $data);
                                    $update = array('paid_status'=> 'partial', 'modified_at'=>date('Y-m-d H:i:s'));
                                }else{
                                    $insert_id = $this->payment->insert('transactions', $data);
                                    $update = array('paid_status'=> 'paid', 'modified_at'=>date('Y-m-d H:i:s'));
                                }               
                                $this->payment->update('invoices', $update, array('id'=>$data['invoice_id']));
                                $paid_amount = $paid_amount - $data['amount'];
                            }                    
                        }
                    }
                    success($this->lang->line('payment_success'));
                    //redirect('accounting/invoice/view/'.$invoice_id);
                    redirect('accounting/invoice/index');
                    
                }elseif($this->input->post('payment_method') == 'paypal'){                    
                    
                    $this->paypal($data); 
                    
                }elseif($this->input->post('payment_method') == 'stripe'){
                    
                    
                }elseif($this->input->post('payment_method') == 'payumoney'){
                    
                    $this->pay_u_money($data);  
                    
                }elseif($this->input->post('payment_method') == 'ccavenue'){
                    
                    $this->cc_avenue($data); 
                    
                }elseif($this->input->post('payment_method') == 'paytm'){
                    
                    $this->pay_tm($data);  
                    
                }elseif($this->input->post('payment_method') == 'atom'){                    
                    //$this->atom($data);
                    $this->atom($invoice_ids);
                }
                    
            } else {
                $this->data['post'] = $_POST;
                $this->data['due_amount'] = $this->input->post('amount');
                $this->data['invoice_id'] = $invoice_id;
                $this->data['list'] = TRUE;
                $this->layout->title($this->lang->line('payment').' | ' .SMS);
                $this->layout->view('payment/index', $this->data); 
            }
        }else{
             redirect('accounting/invoice/view/'.$invoice_id);
        }
        
    }

    /*****************Function _prepare_payment_validation**********************************
    * @type            : Function
    * @function name   : _prepare_payment_validation
    * @description     : Process "Payment" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_payment_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        //$this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required|callback_amount');   
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'trim|required');   
        $this->form_validation->set_rules('payment_method', $this->lang->line('payment'). ' '. $this->lang->line('method'), 'trim|required|callback_payment_method');   
        
        if($this->input->post('payment_method') == 'cash'){
            
        }elseif($this->input->post('payment_method') == 'cheque'){
            
            $this->form_validation->set_rules('bank_name', $this->lang->line('bank').' '.$this->lang->line('name'), 'trim|required');
            $this->form_validation->set_rules('cheque_no', $this->lang->line('cheque') . ' '.$this->lang->line('number'), 'trim|required');
       
        }elseif($this->input->post('payment_method') == 'paypal'){
            
        }elseif($this->input->post('payment_method') == 'stripe'){
            
            $this->form_validation->set_rules('stripe_card_number', $this->lang->line('card') . ' '.$this->lang->line('number'), 'trim|required');
            $this->form_validation->set_rules('stripe_cvv', $this->lang->line('cvv'), 'trim|required');
            $this->form_validation->set_rules('expire_month', $this->lang->line('expire') . ' '.$this->lang->line('month'), 'trim|required');
            $this->form_validation->set_rules('expire_year', $this->lang->line('expire') . ' '.$this->lang->line('year'), 'trim|required');
            
        }elseif($this->input->post('payment_method') == 'payumoney'){
            
            $this->form_validation->set_rules('pum_first_name', $this->lang->line('first_name'), 'trim|required');
            $this->form_validation->set_rules('pum_email', $this->lang->line('email'), 'trim|required');
            $this->form_validation->set_rules('pum_phone', $this->lang->line('phone'), 'trim|required');
            
        }elseif($this->input->post('payment_method') == 'ccavenue'){
            
        }elseif($this->input->post('payment_method') == 'paytm'){
            
        }elseif($this->input->post('payment_method') == 'atom'){

        }
        
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');   
    }
    
    
    
    /*****************Function amount**********************************
    * @type            : Function
    * @function name   : amount
    * @description     : validate payment "amount"                  
    *                     is amount is correct or not  
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function amount() {
        
        $invoice_id      = $this->input->post('invoice_id');        
        $invoice         = $this->payment->get_invoice_amount($invoice_id);       
        $due_amount      = $invoice->net_amount - $invoice->paid_amount;
        
        if ($this->input->post('amount') > $due_amount) {
            $this->form_validation->set_message("amount", $this->lang->line('input_valid_amount'));
            return FALSE;
        }else{
            return TRUE;
        }
        
    }
  
    
    /*****************Function payment_method**********************************
    * @type            : Function
    * @function name   : payment_method
    * @description     : validate payment method                  
    *                   and check payment method is correct or not  
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function payment_method() {
  
        $payment_method  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        //var_dump($payment_method);
       // die();
        if ($this->input->post('payment_method') == 'cash' || $this->input->post('payment_method') == 'cheque') {
            return TRUE;
        } elseif ($this->input->post('payment_method') == 'paypal' && $payment_method->paypal_status == 1) {
            
            if ($payment_method->paypal_email  == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
            
        } elseif ($this->input->post('payment_method') == 'stripe' && $payment_method->stripe_status == 1) {
            if ($payment_method->stripe_secret == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
            
        } elseif ($this->input->post('payment_method') == 'payumoney' && $payment_method->payumoney_status == 1) {

            if ($payment_method->payumoney_key == "" || $payment_method->payumoney_salt == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
            
        } elseif ($this->input->post('payment_method') == 'ccavenue' && $payment_method->ccavenue_status == 1) {

            if ($payment_method->ccavenue_key == "" || $payment_method->ccavenue_salt == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
            
        } elseif ($this->input->post('payment_method') == 'paytm' && $payment_method->paytm_status == 1) {

            if ($payment_method->paytm_merchant_key == "" || $payment_method->paytm_merchant_mid == "" || $payment_method->paytm_merchant_website == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
        } elseif ($this->input->post('payment_method') == 'atom' && $payment_method->atom_status == 1) {           
            if ($payment_method->atom_user_id == "" || $payment_method->login_password == "" || $payment_method->pro_id == ""|| $payment_method->request_key == "" || $payment_method->response_key == "") {
                $this->form_validation->set_message("payment_method", $this->lang->line('input_valid_payment_setting'));
                return FALSE;
            }else{
                return TRUE;                
            }
        }       
    }



    
    /*****************Function _get_posted_payment_data**********************************
    * @type            : Function
    * @function name   : _get_posted_payment_data
    * @description     : Prepare "Payment" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_payment_data() {

        $items = array();
        //$items[] = 'amount';
        //$items[] = 'invoice_id';
        $items[] = 'payment_method';       
        $items[] = 'note';
        
        $data = elements($items, $_POST); 
        $data['school_id']= $this->session->userdata('school_id');
        if($this->input->post('payment_method') == 'cheque'){
            $data['bank_name'] = $this->input->post('bank_name');
            $data['cheque_no'] = $this->input->post('cheque_no');
        }            
              
        if($this->input->post('payment_method') == 'payumoney'){
            $data['pum_first_name'] = $this->input->post('pum_first_name');
            $data['pum_email'] = $this->input->post('pum_email');
            $data['pum_phone'] = $this->input->post('pum_phone');
        }  
        
        if($this->input->post('payment_method') == 'stripe'){
            $data['stripe_card_number'] = $this->input->post('stripe_card_number');
        }            
              
        $data['status'] = 1;
        $data['academic_year_id'] = $this->academic_year_id;
        $data['payment_date'] = date('Y-m-d');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $invoiceIds = $this->input->post('invoice_id');
        foreach ($invoiceIds as $invoiceId) {
           $data['invoice_id'] = $invoiceId;
           $invoice = $this->payment->get_invoice_amount($invoiceId);
           $data['amount'] =  ($invoice->net_amount - $invoice->paid_amount);
           $dataArray[] = $data;
        }
        return $dataArray;
    }
    
    
    /* PayUMoney Payment Start */    
    
    /*****************Function pay_u_money**********************************
    * @type            : Function
    * @function name   : pay_u_money
    * @description     : Payment processing using "Payumoney" payment gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function pay_u_money($data) {
        
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        
        
        if ($payment_setting->payumoney_demo == TRUE) {
            $api_link = "https://test.payu.in/_payment";
        } else {
            $api_link = "https://secure.payu.in/_payment";
        }
        
       $this->invoice->update('invoices', array('temp_amount'=>$data['amount']), array('id'=>$data['invoice_id'],'school_id'=> $this->session->userdata('school_id')));
        $pay_amount = $data['amount'];
        if($payment_setting->payu_extra_charge > 0){
            $pay_amount = $data['amount'] + ($payment_setting->payu_extra_charge/100*$data['amount']);
        }

        $invoice = $this->invoice->get_single_invoice($data['invoice_id']);
        
        $array['key'] = $payment_setting->payumoney_key;
        $array['salt'] = $payment_setting->payumoney_salt;
        $array['payu_base_url'] = $api_link; // For Test
        $array['surl'] = base_url('accounting/payment/payumoney_success/' . $data['invoice_id']);
        $array['furl'] = base_url('accounting/payment/payumoney_failed/' . $data['invoice_id']);
        $array['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $array['action'] = $api_link;
        $array['amount'] = $pay_amount;
        $array['firstname'] = $data['pum_first_name'];
        $array['email'] = $data['pum_email'];
        $array['phone'] = $data['pum_phone'];
        $array['productinfo'] = 'Invoice' . ' - ' .$data['note'];
        $array['hash'] = $this->_generate_hash($array);

        $this->load->view('payment/pay_u_money', $array);
    }

    
    
    
    
    /*****************Function _generate_hash**********************************
    * @type            : Function
    * @function name   : _generate_hash
    * @description     : generate hash id for payumoney peyment processing                  
    *                       
    * @param           : $array array() value
    * @return          : $hash string value
    * ********************************************************** */
    private function _generate_hash($array) {
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if (empty($array['key']) || empty($array['txnid']) || empty($array['amount']) || empty($array['firstname']) || empty($array['email']) || empty($array['phone']) || empty($array['productinfo']) || empty($array['surl']) || empty($array['furl'])) {
            return false;
        } else {
            
            $hash = '';
            $salt = $array['salt'];
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach ($hashVarsSeq as $hash_var) {
                $hash_string .= isset($array[$hash_var]) ? $array[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $salt;
            $hash = strtolower(hash('sha512', $hash_string));
            return $hash;
        }
    }

    
    /*****************Function payumoney_failed**********************************
    * @type            : Function
    * @function name   : payumoney_failed
    * @description     : payumoney peyment processing failed url                 
    *                    load user interface with payment failed message   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function payumoney_failed() {
        
        $invoice_id = $this->uri->segment(4);
        error($this->lang->line('payment_failed'));
        redirect('accounting/invoice/view/' . $invoice_id);
        
    }

    
    /*****************Function payumoney_success**********************************
    * @type            : Function
    * @function name   : payumoney_success
    * @description     : payumoney peyment processing success url                 
    *                    load user interface with payment success message   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function payumoney_success() {
        // print_r($_POST); die();
        $invoice_id = $this->uri->segment(4);
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        
        $status         = $_POST["status"];
        $firstname      = $_POST["firstname"];
        $amount         = $_POST["amount"];
        $txnid          = $_POST["txnid"];
        $posted_hash    = $_POST["hash"];
        $key            = $_POST["key"];
        $productinfo    = $_POST["productinfo"];
        $email          = $_POST["email"];
        $phone          = $_POST["phone"];
        $salt           = $payment_setting->payumoney_salt;
        

        If (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $hash = strtolower(hash("sha512", $retHashSeq));
        if ($hash != $posted_hash) {
            
            error($this->lang->line('invalid_transaction_pls_try_again'));
            redirect('accounting/invoice/view/' . $invoice_id);
            
        } else {
            if ($status === "success") {
                
                $invoice = $this->invoice->get_single_invoice($invoice_id);
                $payment = $this->payment->get_invoice_amount($invoice_id);                
                
               
                                
                $data['invoice_id'] = $invoice_id;
                $data['amount'] = $invoice->temp_amount;
                $data['payment_method'] = 'PayUMoney';
                $data['transaction_id'] = $txnid;
                $data['pum_first_name'] = $firstname;
                $data['pum_email'] = $email;
                $data['pum_phone'] = $phone;
                $data['note'] = $productinfo;
                $data['status'] = 1;
                $data['academic_year_id'] = $this->db->get_where('academic_years', array('is_running'=>1))->row()->id;
                $data['payment_date'] = date('Y-m-d');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id(); 
                $data['school_id']= $this->session->userdata('school_id');
                $this->payment->insert('transactions', $data);                
                $due_mount = $invoice->net_amount - $payment->paid_amount;
                
                if(floatval($data['amount']) < floatval($due_mount)){
                    $update = array('paid_status'=> 'partial');
                }else{
                    $update = array('paid_status'=> 'paid', 'modified_at'=>date('Y-m-d H:i:s'));
                }                    
                $this->payment->update('invoices', $update, array('id'=>$invoice_id,'school_id'=> $this->session->userdata('school_id')));

                success($this->lang->line('payment_success'));
                redirect('accounting/invoice/view/' . $invoice_id);
               
            } else {
                error($this->lang->line('payment_failed'));
                redirect('accounting/invoice/view/' . $invoice_id);
            }
        }
    }
    /* PayUmoney Payment End */
    
    
    /* Paypal payment start */
    
    
    /*****************Function paypal**********************************
    * @type            : Function
    * @function name   : paypal
    * @description     : Payment processing using "Paypal" payment gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function paypal($data)
    {
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        $invoice = $this->invoice->get_single_invoice($data['invoice_id']);
                
        $this->invoice->update('invoices', array('temp_amount'=>$data['amount']), array('id'=>$data['invoice_id'],'school_id'=> $this->session->userdata('school_id')));
        $pay_amount = $data['amount'];
        if($payment_setting->paypal_extra_charge > 0){
            $pay_amount = $data['amount'] + ($payment_setting->paypal_extra_charge/100*$data['amount']);
        }
        
        $this->paypal->add_field('rm', 2);
        $this->paypal->add_field('no_note', 0);
        $this->paypal->add_field('item_name', 'Invoice');
        $this->paypal->add_field('amount', $pay_amount);
        $this->paypal->add_field('custom', $data['invoice_id']);
        $this->paypal->add_field('business', $payment_setting->paypal_email);
        $this->paypal->add_field('tax', 1);
        $this->paypal->add_field('quantity', 1);
        $this->paypal->add_field('currency_code', 'USD');

        $this->paypal->add_field('notify_url', base_url('accounting/gateway/paypal_notify'));
        $this->paypal->add_field('cancel_return', base_url('accounting/payment/paypal_cancel/' . $data['invoice_id']));
        $this->paypal->add_field('return', base_url('accounting/payment/paypal_success/' . $data['invoice_id']));
        
               
        
        if($payment_setting->paypal_demo){
            $this->paypal->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $this->paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }
        
        $this->paypal->submit_paypal_post();
    }

    /*****************Function paypal_cancel**********************************
    * @type            : Function
    * @function name   : paypal_cancel
    * @description     : paypal peyment processing cancel url                
                         load user interface with some cancel message 
     *                   while user cancel paypal paymnet.   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function paypal_cancel(){    
        $invoice_id = $this->uri->segment(4);
        error($this->lang->line('payment_failed'));
        redirect('accounting/invoice/view/' . $invoice_id);
    }

    
    /*****************Function paypal_success**********************************
    * @type            : Function
    * @function name   : paypal_success
    * @description     : paypal peyment processing success url                
                         load user interface with success message 
     *                   while user succesully pay.   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function paypal_success(){ 
        $invoice_id = $this->uri->segment(4);
        success($this->lang->line('payment_success'));
        redirect('accounting/invoice/view/' . $invoice_id);
    }
 
    /* Paypal payment end */
    
   
    
     /* cc_avenue Payment Start */    
    
    /*****************Function cc_avenue**********************************
    * @type            : Function
    * @function name   : cc_avenue
    * @description     : Payment processing using "cc_avenue" payment gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function cc_avenue($data) {
              
        
        //http://webprepration.com/integrate-ccavenue-payment-gateway-in-php/
        
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        

        $invoice = $this->invoice->get_single_invoice($data['invoice_id']);
        
        if ($payment_setting->ccavenue_demo == TRUE) {
            //$api_link = "http://www.ccavenue.com/shopzone/cc_details.jsp"; // demo
            $api_link = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"; // demo
        } else {
            $api_link = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
        }   
        
        $this->invoice->update('invoices', array('temp_amount'=>$data['amount']), array('id'=>$data['invoice_id'],'school_id'=> $this->session->userdata('school_id')));
        $pay_amount = $data['amount'];
        if($payment_setting->ccavenue_extra_charge > 0){
            $pay_amount = $data['amount'] + ($payment_setting->ccavenue_extra_charge/100*$data['amount']);
        }
                
        $data = array(
            'merchant_id' => $payment_setting->ccavenue_key,
            'working_key' => $payment_setting->ccavenue_salt,
            'amount' => $pay_amount,
            'action' => $api_link,
            'order_id' => abs(crc32(uniqid())),
            'redirect_url' => base_url('accounting/payment/cc_avenue_success/' . $data['invoice_id']),
            'cancel_url' => base_url('accounting/payment/cc_avenue_cancel/' . $data['invoice_id']),
            'billing_cust_name' => "",
            'billing_cust_address' => "",
            'billing_cust_country' => "",
            'billing_cust_state' => "",
            'billing_city' => "",
            'billing_zip' => "",
            'billing_cust_tel' => "",
            'billing_cust_email' => "",
            'delivery_cust_name' => "",
            'delivery_cust_address' => "",
            'delivery_cust_country' => "",
            'delivery_cust_state' => "",
            'delivery_city' => "",
            'delivery_zip' => "",
            'delivery_cust_tel' => "",
            'delivery_cust_notes' => "",
            'delivery_cust_notes' => "",
            'name' => $invoice->head,
            'address' => "",
            'currency' => "INR",
            'tid' => time(),
        );

        $this->load->view('payment/cc_avenue', $data);
    }
    
    
     /*****************Function cc_avenue_success**********************************
    * @type            : Function
    * @function name   : cc_avenue_success
    * @description     : cc_avenue peyment processing success url                
                         load user interface with success message 
     *                   while user succesully pay.   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function cc_avenue_success(){
        
        $invoice_id = $this->uri->segment(4);
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        
        $workingKey  = $payment_setting->ccavenue_salt;		//Working Key should be provided here.
	$encResponse = $_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString  = $this->ccaencrypt->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues = explode('&', $rcvdString);        
	$dataSize = sizeof($decryptValues);
        
        mail('yousuf361@gmail.com', 'CCAVENUE Return', json_encode($rcvdString));
        
	for($i = 0; $i < $dataSize; $i++) 
	{
            $information=explode('=',$decryptValues[$i]);
            if($i==3){	$order_status=$information[1];}
	}

	if($order_status==="Success")
	{
	    $invoice = $this->invoice->get_single_invoice($invoice_id);
            $payment = $this->payment->get_invoice_amount($invoice_id);                

            $data['invoice_id'] = $invoice_id;
            $data['amount'] = $invoice->temp_amount;
            $data['payment_method'] = 'CCAvenue';
            $data['transaction_id'] = '1234567890';            
            $data['note'] = 'Note';
            $data['status'] = 1;
            $data['academic_year_id'] = $this->db->get_where('academic_years', array('is_running'=>1,'school_id'=> $this->session->userdata('school_id')))->row()->id;
            $data['payment_date'] = date('Y-m-d');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 

            $this->payment->insert('transactions', $data);                
            $due_mount = $invoice->net_amount - $payment->paid_amount;

            if(floatval($data['amount']) < floatval($due_mount)){
                $update = array('paid_status'=> 'partial');
            }else{
                $update = array('paid_status'=> 'paid', 'modified_at'=>date('Y-m-d H:i:s'));
            }                    
            $this->payment->update('invoices', $update, array('id'=>$invoice_id,'school_id'=> $this->session->userdata('school_id')));

            success($this->lang->line('payment_success'));
            redirect('accounting/invoice/view/' . $invoice_id);
            
	}else{
            
            error($order_status .' : ' . $this->lang->line('payment_failed'));
            redirect('accounting/invoice/view/' . $invoice_id);          
	}
    }
    
    
     /*****************Function cc_avenue_cancel**********************************
    * @type            : Function
    * @function name   : cc_avenue_cancel
    * @description     : cc_avenue peyment processing cancel url                
                         load user interface with some cancel message 
     *                   while user cancel cc_avenue paymnet 
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function cc_avenue_cancel(){
        $invoice_id = $this->uri->segment(4);
        error($this->lang->line('payment_failed'));
        redirect('accounting/invoice/view/' . $invoice_id);
    }

    /* cc_avenue Payment END */  

    
        
     /* PAY TM Payment Start */    
    
    /*****************Function pay_tm**********************************
    * @type            : Function
    * @function name   : pay_tm
    * @description     : Payment processing using "pay_tm" payment gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function pay_tm($data) {
                
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id'))); 
        $invoice = $this->invoice->get_single_invoice($data['invoice_id']);
        
        if ($payment_setting->paytm_demo == TRUE) {
            
            define('PAYTM_ENVIRONMENT', 'TEST'); // TEST
            define('PAYTM_MERCHANT_KEY', 'bQfzzkKzeCbR7jOl'); //Change this constant's value with Merchant key downloaded from portal
            define('PAYTM_MERCHANT_MID', 'amitgo59443067266036'); //Change this constant's value with MID (Merchant ID) received from Paytm
            define('PAYTM_MERCHANT_WEBSITE', 'DIYtestingweb '); //Change this constant's value with Website name received from Paytm

        } else {
            define('PAYTM_ENVIRONMENT', 'PROD'); // PROD
            define('PAYTM_MERCHANT_KEY', $payment_setting->paytm_merchant_key); //Change this constant's value with Merchant key downloaded from portal
            define('PAYTM_MERCHANT_MID', $payment_setting->paytm_merchant_mid); //Change this constant's value with MID (Merchant ID) received from Paytm
            define('PAYTM_MERCHANT_WEBSITE', $payment_setting->paytm_merchant_website); //Change this constant's value with Website name received from Paytm
        }         
        

        $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL = 'https://pguat.paytm.com/oltp-web/processTransaction';
        
        if (PAYTM_ENVIRONMENT == 'PROD') {
                $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw.paytm.in/merchant-status/getTxnStatus';
                $PAYTM_TXN_URL = 'https://securegw.paytm.in/theia/processTransaction';
        }
        
               
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
        
        
        
        $this->invoice->update('invoices', array('temp_amount'=>$data['amount']), array('id'=>$data['invoice_id'],'school_id'=> $this->session->userdata('school_id')));
        $pay_amount = $data['amount'];
        if($payment_setting->paytm_extra_charge > 0){
            $pay_amount = $data['amount'] + ($payment_setting->paytm_extra_charge/100*$data['amount']);
        }
        
        // Preparing data
        $pay_tm_data = array(
            'ORDER_ID' => "ORDS" . rand(10000,99999999),
            'CUST_ID' => 'CUST'.$invoice->id,
            'INDUSTRY_TYPE_ID' => 'Retail',
            'CHANNEL_ID' => 'WEB',
            'TXN_AMOUNT' => $pay_amount,             
        );
        
              
        $checkSum = "";
        $paramList = array();
        
        // mandatory param
        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $pay_tm_data['ORDER_ID'];
        $paramList["CUST_ID"] = $pay_tm_data['CUST_ID'];
        $paramList["INDUSTRY_TYPE_ID"] = $pay_tm_data['INDUSTRY_TYPE_ID'];
        $paramList["CHANNEL_ID"] = $pay_tm_data['CHANNEL_ID'];
        $paramList["TXN_AMOUNT"] = $pay_tm_data['TXN_AMOUNT'];;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

        // additional param
        $paramList["CALLBACK_URL"] = base_url('accounting/payment/pay_tm_success/' . $data['invoice_id']);
        
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $paramList["MSISDN"] = $this->session->userdata('phone'); //Mobile number of customer
            $paramList["EMAIL"]  = $this->session->userdata('email'); //Email ID of customer
        }else{
            $paramList["MSISDN"] = '7777777777'; //Mobile number of customer
            $paramList["EMAIL"]  = $this->session->userdata('email'); //Email ID of customer
        }
        
        $paramList["VERIFIED_BY"] = "EMAIL"; //
        $paramList["IS_USER_VERIFIED"] = "YES"; //
        
                
        $data['param_lists'] = $paramList;
        //Here checksum string will return by getChecksumFromArray() function.
        
        $data['check_sum'] = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
       
        $this->load->view('payment/pay_tm', $data);
    }
    
    
     /*****************Function pay_tm_success**********************************
    * @type            : Function
    * @function name   : pay_tm_success
    * @description     : pay_tm peyment processing success url                
                         load user interface with success message 
     *                   while user succesully pay.   
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function pay_tm_success(){
        
        $invoice_id = $this->uri->segment(4);
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));
        
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";	

        mail('yousuf361@gmail.com', 'PAY TM Return', json_encode($_POST));
        
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

        if($isValidChecksum == "TRUE") {
            
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                
                $invoice = $this->invoice->get_single_invoice($invoice_id);
                $payment = $this->payment->get_invoice_amount($invoice_id);                

                $data['invoice_id'] = $invoice_id;
                $data['amount'] = $invoice->temp_amount;
                $data['payment_method'] = 'PayTM';
                $data['transaction_id'] = '1234567890';            
                $data['note'] = 'Note';
                $data['status'] = 1;
                $data['academic_year_id'] = $this->db->get_where('academic_years', array('is_running'=>1,'school_id'=> $this->session->userdata('school_id')))->row()->id;
                $data['payment_date'] = date('Y-m-d');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = logged_in_user_id();

                $this->payment->insert('transactions', $data);                
                $due_mount = $invoice->net_amount - $payment->paid_amount;

                if(floatval($data['amount']) < floatval($due_mount)){
                    $update = array('paid_status'=> 'partial');
                }else{
                    $update = array('paid_status'=> 'paid', 'modified_at'=>date('Y-m-d H:i:s'));
                }                    
                $this->payment->update('invoices', $update, array('id'=>$invoice_id));

                success($this->lang->line('payment_success'));
                redirect('accounting/invoice/view/' . $invoice_id);
                
            }else{
                error($order_status .' : ' . $this->lang->line('payment_failed'));
                redirect('accounting/invoice/view/' . $invoice_id); 
            }
        }else{
            error($order_status .' : ' . $this->lang->line('payment_failed'));
            redirect('accounting/invoice/view/' . $invoice_id); 
        }
     
    }
    
    
     /*****************Function pay_tm_cancel**********************************
    * @type            : Function
    * @function name   : pay_tm_cancel
    * @description     : pay_tm peyment processing cancel url                
                         load user interface with some cancel message 
     *                   while user cancel pay_tm paymnet 
    * @param           : null
    * @return          : null
    * ********************************************************** */
    public function pay_tm_cancel(){
        $invoice_id = $this->uri->segment(4);
        error($this->lang->line('payment_failed'));
        redirect('accounting/invoice/view/' . $invoice_id);
    }

    /* PAY TM Payment END */  

 /* Atom Payment Start */    
    
    /*****************Function atom**********************************
    * @type            : Function
    * @function name   : atom
    * @description     : Payment processing using "atom" payment gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function atom($invoice_ids)
    {
       // die();
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        $transactionId = 100;
       // require_once 'TransactionRequest.php';
        $transactionRequest = new TransactionRequest();

        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id')));  
       $invoice_id_arr = json_decode(base64_decode($invoice_ids));
       $pay_amount = '0';
       $paid_amount = $this->input->post('amount');
        foreach($invoice_id_arr as $invoice_id){
            if($paid_amount > 0){
                $invoice = $this->invoice->get_single_invoice($invoice_id); 
                 if($paid_amount < $invoice->net_amount){
                    $invoice->net_amount = $paid_amount;
                 }else{
                    $invoice->net_amount = $invoice->net_amount;
                 }
                $this->invoice->update('invoices', array('temp_amount'=>$invoice->net_amount), array('id'=>$invoice_id,'school_id'=> $this->session->userdata('school_id')));
                $pay_amount = $pay_amount + $invoice->net_amount;
                $paid_amount = $paid_amount - $invoice->net_amount = $invoice->net_amount;
            }
        }
        
        //$transactionRequest->setMode("live");
        $transactionRequest->setLogin($payment_setting->atom_user_id);
        $transactionRequest->setPassword($payment_setting->login_password);
        $transactionRequest->setProductId($payment_setting->pro_id);
        $transactionRequest->setAmount($pay_amount);
        $transactionRequest->setTransactionCurrency("INR");
        $transactionRequest->setTransactionAmount($pay_amount);
        $transactionRequest->setReturnUrl(base_url('accounting/payment/atom_success/' . $invoice_ids));
        $transactionRequest->setClientCode('NAVIN');
        $transactionRequest->setTransactionId($transactionId);
        $transactionRequest->setTransactionDate($transactionDate);
        $transactionRequest->setCustomerName("Test Name");
        $transactionRequest->setCustomerEmailId("test@test.com");
        $transactionRequest->setCustomerMobile("9999999999");
        $transactionRequest->setCustomerBillingAddress("Mumbai");
        $transactionRequest->setCustomerAccount("639827");
        $transactionRequest->setReqHashKey($payment_setting->request_key);
        $transactionRequest->seturl("https://payment.atomtech.in/paynetz/epi/fts");
        $transactionRequest->setRequestEncypritonKey("8E41C78439831010F81F61C344B7BFC7");
        $transactionRequest->setSalt("8E41C78439831010F81F61C344B7BFC7");
        $url = $transactionRequest->getPGUrl();
        //var_dump($url);
       // die();
        header("Location: $url");
    }


     /*****************Function atom_success**********************************
    * @type            : Function
    * @function name   : atom_success
    * @description     : atom peyment processing success url                
                         load user interface with success message 
     *                   while user succesully pay.   
    * @param           : null
    * @return          : null
    * ********************************************************** */

    public function atom_success()
    {
        $payment_setting  = $this->payment->get_single('payment_settings', array('status'=>1,'school_id'=> $this->session->userdata('school_id'))); 
        

        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey($payment_setting->response_key); ///
        $transactionResponse->setResponseEncypritonKey("8E41C78439831010F81F61C344B7BFC7");
        $transactionResponse->setSalt("8E41C78439831010F81F61C344B7BFC7");
        $transactionResponse->validateResponse($_POST);
        //$arrayofdata = $transactionResponse->decryptResponseIntoArray($_POST['encdata']);
        $transactionResponse->validateResponse($_POST);
            if(strtolower($_POST['f_code']) == "ok")
            {
                $pg_data['status'] = 1;
            }else{
                $pg_data['status'] = 0; 
            }
            $pg_data['mmp_txn'] = $_POST['mmp_txn'];            
            $pg_data['pg_response'] = json_encode($_POST);            
            $pg_data['desc'] = $_POST['desc'];
            $pg_data['amt'] = $_POST['amt'];
            $invoice_ids = $this->uri->segment(4);
            $this->online_payment_update($invoice_ids,$pg_data,'atom');
        
    }
    private function online_payment_update($invoice_ids,$pg_data,$payment_method = null){
        
        $invoice_ids = json_decode(base64_decode($invoice_ids));
        $amt = $pg_data['amt'];
        foreach($invoice_ids as $invoice_id)
        {
            $invoice = $this->invoice->get_single_invoice($invoice_id);
            $payment = $this->payment->get_invoice_amount($invoice_id);  
            $data['invoice_id'] = $invoice_id;
            $data['amount'] = $invoice->net_amount;
            $data['payment_method'] = $payment_method;
            $data['transaction_id'] = $pg_data['mmp_txn'];            
            $data['pg_response'] = $pg_data['pg_response'];            
            $data['note'] = $pg_data['desc'];
            $data['status'] = $pg_data['status'];
          
            $data['academic_year_id'] = $this->db->get_where('academic_years', array('is_running'=>1,'school_id'=> $this->session->userdata('school_id')))->row()->id;
            $data['payment_date'] = date('Y-m-d');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 
            $data['school_id']= $this->session->userdata('school_id');
            $due_mount = $invoice->net_amount - $payment->paid_amount;
            if($due_mount > $amt){
                $data['amount'] = $invoice->net_amount;
            }else{
                $data['amount'] = $amt;
            }
            $this->payment->insert('transactions', $data); 
            if($pg_data['status'] == "1")
            {
                if(floatval($data['amount']) < floatval($due_mount)){
                    $update = array('paid_status'=> 'partial');
                }else{
                    $update = array('paid_status'=> 'paid', 'modified_at'=>date('Y-m-d H:i:s'));
                }
                $this->payment->update('invoices', $update, array('id'=>$invoice_id)); 
                success($this->lang->line('payment_success'));
                $pg_msg = "succesully";
            }
            else{
                success($this->lang->line('payment_failed'));
                $pg_msg = "failed";
            }
            $amt = $amt - $invoice->net_amount;
        }        
        //var_dump($invoice->student_id);
       // die(); 
        $student = $this->invoice->get_single_student($invoice->student_id);    
      //  var_dump($student);
        //die();  
        $message_bodysms= 'Dear, '."\n" . $student->name."[".$student->unique_id."]"."\n".' Your payment has been '.$pg_msg.' against in this invoice id - '. $invoice->custom_invoice_id ."\n".'Amount - '.$invoice->net_amount;
                                        
        $message = $message_bodysms;    
        $sms_gateway = $this->session->userdata('is_default_sms');

        $phone = $student->phone;
        
         if ($sms_gateway == "clicktell") {
            
            $this->clickatell->send_message($phone, $message);
        } elseif ($sms_gateway == 'twilio') {
            
            $get = $this->twilio->get_twilio();
            $from = $get['number'];            
            $response = $this->twilio->sms($from, $phone, $message);          
        } elseif ($sms_gateway == 'bulk') {

            //https://github.com/anlutro/php-bulk-sms     
            
            $this->bulk->send($phone, $message);
        } elseif ($sms_gateway == 'msg91') {
            
            $response = $this->msg91->send($phone, $message);
        } elseif ($sms_gateway == 'plivo') {
            
            $response = $this->twilio->send($phone, $message);
        }elseif ($sms_gateway == 'sms_country') { 
            
            $response = $this->smscountry->sendSMS($phone, $message);            
        } elseif ($sms_gateway == 'text_local') {  
            
            $response = $this->textlocalsms->sendSms(array($phone), $message);
        } elseif($sms_gateway == 'msgclub'){
            $urlencode = urlencode($message);                    
            send_sms($phone,$urlencode);
           
        }                
        //send_sms($student->phone,$urlencode);

        redirect('accounting/invoice/');
    }

}
