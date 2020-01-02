<?php
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

    public $academic_year_id = '';
    public $gsms_setting = array();
    public $lang_path = 'application/language/english/sms_lang.php';
    //public $config_path = 'application/config/custom.php';  
   // echo $this->session->userdata("school_id");
    //die(); 
    function __construct() {
        parent::__construct();
        if (!logged_in_user_id()) {
            redirect('welcome');
            exit;
        }
       // var_dump($config_path);
       // die;
        $academic_year = $this->db->get_where('academic_years', array('is_running'=>1,'school_id' => $this->session->userdata('school_id')))->row();
        if($academic_year){
            $this->academic_year_id = $academic_year->id;
        }
        
        $gsms_setting = $this->db->get_where('settings',array('status'=>1,'id' => $this->session->userdata('school_id')))->row();
        if($gsms_setting){
            $this->gsms_setting = $gsms_setting;
            date_default_timezone_set($this->gsms_setting->default_time_zone);
        }
        $page_name="custom_".$this->session->userdata('school_id');
        if(create_new_page($page_name)){
          $this->config->load($page_name);
        }
        
    }
    
   
    public function update_lang() {
        
        $data = array();
        $language = $this->db->get_where('settings', array('status'=>1,'id' => $this->session->userdata('school_id')))->row()->language; 
        $this->db->select("id, label, $language");
        $this->db->from('languages');        
        $this->db->order_by('id' , 'ASC');
        $languages = $this->db->get()->result(); 
        
        foreach($languages as $obj){
            $data[$obj->label] = $obj->$language;
        }        
        if (!is_array($data) && count($data) == 0) {
            return FALSE;
        }

        @chmod($this->lang_path, FILE_WRITE_MODE);

        // Is the config file writable?
        if (!is_really_writable($this->lang_path)) {
            show_error($this->lang_path . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        } 
        // Read the config file as PHP
        require $this->lang_path;  

        // load the file helper
        $this->CI = & get_instance();
        $this->CI->load->helper('file');

        // Read the config data as a string
        //$lang_file = read_file($this->lang_path);
        // Trim it
        //$lang_file = trim($lang_file);

        $lang_file = '<?php ';

        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                //$pattern = '/\$lang\[\\\'' . $key . '\\\'\]\s+=\s+[^\;]+/';  
                $lang_file .= "\n";
                //$lang_file .= "\$lang['$key'] = '".$val."';"; 
                $lang_file .= "\$lang['$key'] = ".'"'.$val.'";';    
                //$config_file = preg_replace($pattern, $replace, $config_file);
            }
        }
        
        if (!$fp = fopen($this->lang_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return FALSE;
        }
        
        flock($fp, LOCK_EX);
        fwrite($fp, $lang_file, strlen($lang_file));
        flock($fp, LOCK_UN);
        fclose($fp);

        
        @chmod($this->lang_path, FILE_READ_MODE);
  
        return TRUE;
    }
    
    public function update_config() {

        $custom_config= "application/config/custom_".$this->session->userdata('school_id').".php";
      //  var_dump($custom_config);
       // die();
        $data = array();

        $this->db->select('P.*, M.module_slug, O.operation_slug');
        $this->db->from('privileges AS P');
        $this->db->join('operations AS O', 'O.id = P.operation_id', 'left');
        $this->db->join('modules AS M', 'M.id = O.module_id', 'left');
		$this->db->where('P.school_id',$this->session->userdata('school_id'));
        $results = $this->db->get()->result();


        foreach ($results as $obj) {
            // $data[][$obj->operation_slug][$obj->role_id] = $obj->is_add .'|'.$obj->is_edit.'|'.$obj->is_view.'|'.$obj->is_delete;
            $data[] = $obj;
        }
        if (!is_array($data) && count($data) == 0) {
            return FALSE;
        }
       // echo $custom_config;
        //echo FILE_WRITE_MODE;
        //die;
        @chmod($custom_config, FILE_WRITE_MODE);

        // Is the config file writable?
        if (!is_really_writable($custom_config)) {
            show_error($custom_config . ' does not appear to have the proper file permissions.  Please make the file writeable.');
        }
        // Read the config file as PHP
        require $custom_config;

        // load the file helper
        $this->CI = & get_instance();
        $this->CI->load->helper('file');

        // Read the config data as a string
        //$lang_file = read_file($this->lang_path);
        // Trim it
        //$lang_file = trim($lang_file);

        $config_file = '<?php ';

        // Do we need to add totally new items to the config file?
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                //$pattern = '/\$lang\[\\\'' . $key . '\\\'\]\s+=\s+[^\;]+/';  
                $config_file .= "\n";
                $config_file .= "\$config['my_$val->module_slug']['$val->operation_slug']['$val->role_id'] = '" . $val->is_add . "|" . $val->is_edit . "|" . $val->is_view . "|" . $val->is_delete . "';";
                //$config_file = preg_replace($pattern, $replace, $config_file);
            }
        }

        if (!$fp = fopen($custom_config, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
            return FALSE;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $config_file, strlen($config_file));
        flock($fp, LOCK_UN);
        fclose($fp);


        @chmod($custom_config, FILE_READ_MODE);

        return TRUE;
    }

    
}
