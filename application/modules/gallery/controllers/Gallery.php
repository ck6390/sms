<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Gallery.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Gallery
 * @description     : Manage school Gallery for guardian, student, teacher and employee.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Gallery extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Gallery_Model', 'gallery', true);       
    }


    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Gallery List" user interface                 
    *                      
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);

        $this->data['galleries'] = $this->gallery->get_list('galleries', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Gallery" user interface                 
    *                    and process to store "Gallery" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_gallery_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_gallery_data();

                $insert_id = $this->gallery->insert('galleries', $data);
                if ($insert_id) {
                    
                    create_log('Has been created a Gallery : '.$data['title']);
                     
                    success($this->lang->line('insert_success'));
                    redirect('gallery/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('gallery/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $this->data['galleries'] = $this->gallery->get_list('galleries', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Gallery" user interface                 
    *                    with populated "Gallery" value 
    *                    and process to update "Gallery" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);
        
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('gallery/index');
        }
        
        if ($_POST) {
            $this->_prepare_gallery_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_gallery_data();
                $updated = $this->gallery->update('galleries', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    
                    create_log('Has been updated a Gallery : '.$data['title']);
                    
                    success($this->lang->line('update_success'));
                    redirect('gallery/index');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('gallery/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $this->input->post('id')));
            }
        }

        if ($id) {
            $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $id));

            if (!$this->data['gallery']) {
                redirect('gallery/index');
            }
        }

        $this->data['galleries'] = $this->gallery->get_list('galleries', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific gallery data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id) {

        check_permission(VIEW);

        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('gallery/index');
        }
        
        $this->data['galleries'] = $this->gallery->get_list('galleries', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $id));        
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('gallery') . ' | ' . SMS);
        $this->layout->view('gallery/index', $this->data);
    }

                  
    /*****************Function get_single_gallery**********************************
    * @type            : Function
    * @function name   : get_single_gallery
    * @description     : "Load single gallery information" from database                  
    *                    to the user interface   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function get_single_gallery(){
        
       $gallery_id = $this->input->post('gallery_id');
       
       $this->data['gallery'] = $this->gallery->get_single('galleries', array('id' => $gallery_id)); 
       echo $this->load->view('get-single-gallery', $this->data);
    }
    
    /*****************Function _prepare_gallery_validation**********************************
    * @type            : Function
    * @function name   : _prepare_gallery_validation
    * @description     : Process "gallery" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_gallery_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('title', $this->lang->line('gallery') . ' ' . $this->lang->line('title'), 'trim|required|callback_title');
        $this->form_validation->set_rules('is_view_on_web', $this->lang->line('is_view_on_web'), 'trim|required');
        $this->form_validation->set_rules('image', $this->lang->line('cover_image'), 'trim|callback_image');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

    
    /*****************Function title**********************************
    * @type            : Function
    * @function name   : title
    * @description     : Unique check for "gallery title" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */  
    public function title() {
        if ($this->input->post('id') == '') {
            $gallery = $this->gallery->duplicate_check($this->input->post('title'));
            if ($gallery) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $gallery = $this->gallery->duplicate_check($this->input->post('title'), $this->input->post('id'));
            if ($gallery) {
                $this->form_validation->set_message('title', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    
    /*****************Function image**********************************
    * @type            : Function
    * @function name   : image
    * @description     : validate gallery image type/format                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function image() {
        if ($_FILES['image']['name']) {
            $name = $_FILES['image']['name'];
            $arr = explode('.', $name);
            $ext = end($arr);
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                return TRUE;
            } else {
                $this->form_validation->set_message('image', $this->lang->line('select_valid_file_format'));
                return FALSE;
            }
        }
    }

    
    /*****************Function _get_posted_gallery_data**********************************
    * @type            : Function
    * @function name   : _get_posted_gallery_data
    * @description     : Prepare "gallery" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_gallery_data() {

        $items = array();
        $items[] = 'title';
        $items[] = 'note';

        $data = elements($items, $_POST);

        $data['is_view_on_web'] = $this->input->post('is_view_on_web') ? 1 : 0;

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        if (isset($_FILES['image']['name'])) {
            $data['image'] = $this->_upload_image();
        }

        return $data;
    }

    
    /*****************Function _upload_image**********************************
    * @type            : Function
    * @function name   : _upload_image
    * @description     : Process to to upload gallery image in the server
    *                    and return image name                   
    *                       
    * @param           : null
    * @return          : $return_image string value 
    * ********************************************************** */
    private function _upload_image() {

        $prev_image = $this->input->post('prev_image');
        $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $return_image = '';
        if ($image != "") {
            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' ||
                    $image_type == 'image/jpg' || $image_type == 'image/png' ||
                    $image_type == 'image/x-png' || $image_type == 'image/gif') {

                $destination = 'assets/uploads/gallery/';

                $file_type = explode(".", $image);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $image_path = 'gallery-cover-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['image']['tmp_name'], $destination . $image_path);

                // need to unlink previous image
                if ($prev_image != "") {
                    if (file_exists($destination . $prev_image)) {
                        @unlink($destination . $prev_image);
                    }
                }

                $return_image = $image_path;
            }
        } else {
            $return_image = $prev_image;
        }

        return $return_image;
    }

      
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "gallery" from database                  
    *                    and unlink gallery image from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('gallery/index');
        }
        
        $gallery = $this->gallery->get_single('galleries', array('id' => $id));
        if ($this->gallery->delete('galleries', array('id' => $id))) {

            // delete teacher resume and image
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/gallery/' . $gallery->image)) {
                @unlink($destination . '/gallery/' . $gallery->image);
            }

            create_log('Has been deleted a Gallery : '.$gallery->title);
            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('gallery/index');
    }

}
