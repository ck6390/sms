<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Setting.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Setting
 * @description     : Manage application general settings.  
 * @author          : Codetroopers Team     
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com   
 * @copyright       : Codetroopers Team     
 * ********************************************************** */

class Setting extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
       // $this->load->module('state');
        $this->load->model('Setting_Model', 'setting', true);        
        $this->data['fields'] = $this->setting->get_table_fields('languages');
        $this->data['years'] = $this->setting->get_list('academic_years', array('status' => 1,'school_id' => $this->session->userdata('school_id')), '', '', '', 'id', 'ASC');
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "General Setting" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
       if($this->uri->segment(3) == "updated")
       {
         header('Refresh:1; url= '. base_url().'index.php/auth/logout/');          
       }
        check_permission(VIEW);
        $this->data['setting'] = $this->setting->get_single('settings', array('status' => 1, 'id' => $this->session->userdata('school_id')));
        $this->data['purchase'] = $this->setting->get_single('purchase', array('status' => 1));
        $this->data['states'] = $this->setting->get_list('states', array('status' => 1),null,null,null, 'state_name','ASC');
        $this->data['districts'] = $this->setting->get_list('districts', array('status' => 1),null,null,null, 'district_name','ASC');
        
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('index', $this->data);
    }

    public function get_dist()
    {
        
        $SelecetedCategory=$_POST['SelecetedCategory'];

        $get_districts = $this->data['districts'] = $this->setting->get_list('districts', array('status' => 1,'state_id' => $SelecetedCategory), null,null,null, 'district_name','ASC');
        //var_dump($get_districts);
       // die();
        if($get_districts){
            
            echo "<option value=''>===Select District===</option>";
                foreach ($get_districts as $value) {
                    echo "<option value='$value->id'>$value->district_name</option>";
                }                   
        }
        else{
            echo "<option>Not Found Data</option>";
        }   
    }
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "New General Settings" user interface                 
    *                    and process to store "General Settings" into database
    *                    for the first time settings 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_setting_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_setting_data();

                $insert_id = $this->setting->insert('settings', $data);
                if ($insert_id) {
                    
                    create_log('Has been added general setting');
                    success($this->lang->line('insert_success'));
                    redirect('setting/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('setting/add');
                }
            } else {
                $this->data = $_POST;
            }
        }
        $this->data['setting'] = $this->setting->get_single('settings', array('status' => 1, 'id' => $this->session->userdata('school_id')));
        $this->data['purchase'] = $this->setting->get_single('purchase', array('status' => 1));
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('index', $this->data);
    }

    
        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "General Settings" user interface                 
    *                    with populate "General Settings" value 
    *                    and process to update "General Settings" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);

        if ($_POST) {
            $this->_prepare_setting_validation();
            if ($this->form_validation->run() === TRUE) {              
                $data = $this->_get_posted_setting_data();
               
                $updated = $this->setting->update('settings', $data, array('id' => $this->input->post('id'),'id' => $this->session->userdata('school_id')));
             
                if($updated) {                  

                    create_log('Has been updated general setting');
                    success($this->lang->line('update_success').' !. '.'Your logged out because change basic setting. Please login agian');
                    redirect('setting/index'.'/updated/');                   

                } else {
                    error($this->lang->line('update_failed'));
                    redirect('setting/edit/' . $this->input->post('id'));
                }
            }

        }        
        
        $this->data['setting'] = $this->setting->get_single('settings', array('status' => 1, 'id' => $this->session->userdata('school_id')));
        $this->data['purchase'] = $this->setting->get_single('purchase', array('status' => 1));
        $this->data['states'] = $this->setting->get_list('states', array('status' => 1),null,null,null, 'state_name','ASC');
        $this->data['districts'] = $this->setting->get_list('districts', array('status' => 1),null,null,null, 'district_name','ASC');
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('setting/index', $this->data);
    }

        
    /*****************Function _prepare_setting_validation**********************************
    * @type            : Function
    * @function name   : _prepare_setting_validation
    * @description     : Process "General Settings" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_setting_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('school_name', $this->lang->line('school') . ' ' . $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required');
        $this->form_validation->set_rules('affiliation_number', 'Affiliation Number', 'trim|required');
        $this->form_validation->set_rules('school_owner', 'School Owner', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state_id', 'State', 'trim|required');
        $this->form_validation->set_rules('dist_id', 'District', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required');
        $this->form_validation->set_rules('currency', $this->lang->line('currency'), 'trim|required');
        //$this->form_validation->set_rules('currency_symbol', $this->lang->line('currency_symbol'), 'trim|required');
        //$this->form_validation->set_rules('language', $this->lang->line('language'), 'trim|required');
        //$this->form_validation->set_rules('footer', $this->lang->line('footer'), 'trim|required');
        $this->form_validation->set_rules('session_start_month', $this->lang->line('session_start_month'), 'trim|required');
        $this->form_validation->set_rules('session_end_month', $this->lang->line('session_end_month'), 'trim|required');
        $this->form_validation->set_rules('running_year', $this->lang->line('running_year'), 'trim|required');
        $this->form_validation->set_rules('admission_start', $this->lang->line('admission_start'), 'trim|required');
        $this->form_validation->set_rules('admission_end', $this->lang->line('admission_end'), 'trim|required');
        //$this->form_validation->set_rules('purchase_code', $this->lang->line('purchase_code'), 'trim|required');
        //$this->form_validation->set_rules('sms_date_format', $this->lang->line('date_format'), 'trim|required');
        //$this->form_validation->set_rules('default_time_zone', $this->lang->line('default_time_zone'), 'trim|required');
    }

       
    /*****************Function _get_posted_setting_data**********************************
    * @type            : Function
    * @function name   : _get_posted_setting_data
    * @description     : Prepare "General Settings" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_setting_data() {

        $items = array();
        $items[] = 'affiliation_number';
        $items[] = 'school_name';
        $items[] = 'address';
        $items[] = 'phone';
        $items[] = 'email';
        $items[] = 'currency';
        $items[] = 'fax_number';
        $items[] = 'school_owner';
        $items[] = 'alternate_number';
        $items[] = 'city';
        $items[] = 'state_id';
        $items[] = 'dist_id';
        $items[] = 'pin_code';
        $items[] = 'country';
        //$items[] = 'currency_symbol';
       // $items[] = 'language';
        $items[] = 'session_start_month';
        $items[] = 'session_end_month';
        $items[] = 'running_year';
        $items[] = 'is_default_sms';
        
        //$items[] = 'school_geocode';        
        //$items[] = 'enable_rtl';
       // $items[] = 'enable_frontend';
       // $items[] = 'final_result_type';
        //$items[] = 'default_time_zone';
        //$items[] = 'sms_date_format';
        //$items[] = 'facebook_url';
        //$items[] = 'twitter_url';
        //$items[] = 'linkedin_url';
        //$items[] = 'google_plus_url';
        //$items[] = 'youtube_url';
        //$items[] = 'instagram_url';
       // $items[] = 'pinterest_url';
        //$items[] = 'footer';
         $items[] = 'admission_start';
        $items[] = 'admission_end';

        
        $data = elements($items, $_POST);
        //var_dump($data['running_year']);
        //die;
        // update current / runing year session
        $this->db->update('academic_years', array('is_running' => 0),array('school_id' => $this->session->userdata('school_id')));
        $this->setting->update('academic_years', array('is_running' => 1,'session_year' => $data['running_year']),array('school_id' => $this->session->userdata('school_id'),'session_year'=>$data['running_year']));

       /* if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }*/

        if ($_FILES['logo']['name']) {
            $data['school_logo'] = $this->_upload_logo();
        }
        
        // update purchase code table
        //$purchase['id'] = 1;
        //$purchase['purchase_code'] = $this->input->post('purchase_code');
        //$purchase['created_at'] = date('Y-m-d H:i:s');
        //$purchase['created_by'] = 1;
        //$purchase['status'] = 1;
        //$this->db->empty_table('purchase');
        //$this->db->insert('purchase',$purchase);
       // var_dump($data);
        //die;
        return $data;
    }

           
    /*****************Function _upload_logo**********************************
    * @type            : Function
    * @function name   : _upload_logo
    * @description     : Process to upload institute logo in the server                  
    *                     and return logo name   
    * @param           : null
    * @return          : $logo string value 
    * ********************************************************** */
    private function _upload_logo() {

        $prevoius_logo = @$_POST['logo_prev'];
        $logo_name = $_FILES['logo']['name'];
        $logo_type = $_FILES['logo']['type'];
        $logo = '';


        if ($logo_name != "") {
            if ($logo_type == 'image/jpeg' || $logo_type == 'image/pjpeg' ||
                    $logo_type == 'image/jpg' || $logo_type == 'image/png' ||
                    $logo_type == 'image/x-png' || $logo_type == 'image/gif') {

                $destination =  $this->config->item('img_url');

                $file_type = explode(".", $logo_name);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $logo_path = time().'-school-logo.' . $extension;
                $uploadfile = $_SERVER['DOCUMENT_ROOT'].$destination;
                //$uploadfile = $destination . basename($logo_path);
                move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile.$logo_path);            
                if ($prevoius_logo != "") {
                    if (file_exists($destination . $prevoius_logo)) {
                        @unlink($uploadfile. $prevoius_logo);
                    }
                }

                $logo = $logo_path;
            }
        } else {

            $logo = $prevoius_logo;
        }

        return $logo;
    }

}
