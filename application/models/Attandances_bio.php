<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attandances_bio extends CI_Model {
    //$bio = "";
    function __construct() {
        parent::__construct();
        
    }

    public function get_bio_att($em_id)
    {
    	$curr_year = date('Y');
    	$curr_month= date('n');
    	$table = "deviceLogs_".$curr_month."_".$curr_year;
    	$bio = $this->load->database('otherdb', TRUE);
    	$bio->select('*');
        $bio->from($table);
        $bio->like('DownloadDate',date('Y-m-d'));
        $bio->where('UserId',$em_id);
        $bio->where('UserId != 1');
		$bio->order_by('DeviceLogId', 'DESC');/// for out time
        return $query = $bio->get()->row();
    } 
    public function get_bio_att_emp()
    {
    	$bio = $this->load->database('otherdb', TRUE);
    	$bio->select('*');
        $bio->from('employees');
        $bio->where('EmployeeId != 0');
        $bio->where('EmployeeCode != 0');
        $bio->where('RecordStatus = 1');
	    $bio->where('EmployeeName REGEXP "^-?[A-Z a-z ]+$"');
      return $query = $bio->get()->result();
    }

    public function get_student_lists($id){        
        $this->db->select('S.*,E.*, U.email, U.role_id,U.unique_id,S.id AS s_id');
        $this->db->from('students AS S');
        $this->db->join('enrollments AS E', 'E.student_id = S.id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        //$this->db->join('classes AS C', 'C.id = E.class_id', 'left');
       // $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');       
        $this->db->where('S.id', $id);       
        return $this->db->get()->row();
    } 
    public function get_teacher_lists($id){

        $this->db->select('T.*, U.email, U.role_id,T.id AS t_id,(select AY.id from academic_years AS AY where T.school_id = AY.school_id AND AY.is_running = 1) AS academic_year_id');
        $this->db->from('teachers AS T');
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->where('T.status', 1);       
        $this->db->where('T.id', $id);   
        return $this->db->get()->row();        
    } 

    public function get_employee_lists($id){
        
        $this->db->select('E.*, U.email, U.role_id, D.name AS designtion,E.id AS e_id,(select AY.id from academic_years AS AY where E.school_id = AY.school_id AND AY.is_running = 1) AS academic_year_id');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->join('designations AS D', 'D.id = E.designation_id', 'left');      
        $this->db->where('E.status', 1);       
        $this->db->where('E.id',$id);       
       
        return $this->db->get()->row();        
    }
   public function get_single_data($condition,$type)
   {
   		switch ($type) {
   			case 'student':
   				$table = "student_attendances";
   				break;   			
   			case 'teacher':
   				$table = "teacher_attendances";
   				break;
   			case 'employee':
   				$table = "employee_attendances";
   			break;
   		}
   		$this->db->select('*');
   		$this->db->from($table);
   		$this->db->where($condition);
   		return $this->db->get()->row();
   }


   public function update_attandance($attendance_record,$time,$condition,$type)
   {
   	    switch ($type) {
	   		case 'student':
	   			$table = "student_attendances";
	   			break;   			
	   		case 'teacher':
	   			$table = "teacher_attendances";
	   			break;
	   		case 'employee':
   				$table = "employee_attendances";
   			break;
	   	}
   		$this->db->set('attendance_data',$attendance_record);
   		$this->db->set('attendance_time',$time);
   		$this->db->where($condition);
   		//$this->db->where('student_id', $id);
   		return $this->db->update($table);
   }

   public function insert($data,$type){
	   	switch ($type) {
	   		case 'student':
	   			$table = "student_attendances";
	   			break;   			
	   		case 'teacher':
	   			$table = "teacher_attendances";
	   			break;
	   		case 'employee':
   				$table = "employee_attendances";
   			break;
	   	}
	   	return $this->db->insert($table,$data); 
   }
}
