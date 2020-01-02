<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Welcome.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Welcome
 * @description     : This is default class of the application.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */
class Attandance_bio extends CI_Controller {
    /*     * **************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : this function load login view page            
     * @param           : null; 
     * @return          : null 
     * ********************************************************** */
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Attandances_bio','m_bio_att');        
    }

    public function index() {        
        
        $employee = $this->m_bio_att->get_bio_att_emp();//bio data   
		//echo count($employee);
		// echo "<pre>";
		// print_r($employee);
		// die;		
        $curr_year = date('Y');
        $curr_month = date('m');
        $curr_day = date('d');   
		$snd_sms_no="";
		$st_name = "";
        foreach ($employee as $emp) {
           $sub_str = substr($emp->EmployeeCode, 0, 1);
           switch ($sub_str) {
              case '1':
                $type = 'student';
              break;
              case '2':  
                $type = 'teacher';          
              break;
              case '3':
                $type = 'employee';
              break;
           }
           $id = substr($emp->EmployeeCode, 1);
           $em_id = $emp->EmployeeCode;

           switch ($type){
              case 'student':
				 // var_dump($id);
                  $result_att = $this->m_bio_att->get_student_lists($id);
				 // var_dump($result_att);
				 // die;
                  $snd_sms_no = $result_att->phone;
                  $st_name = $result_att->name;
                  $condition = array(
                    'class_id' => $result_att->class_id,
                    'section_id' => $result_att->section_id,
                    'academic_year_id' => $result_att->academic_year_id,
                    'month' => $curr_month,
                    'year' => $curr_year,
                    'student_id' =>$result_att->s_id
                  );  
              break;                          
              case 'teacher':
                  $result_att = $this->m_bio_att->get_teacher_lists($id);
				  // echo "<pre>";
				  // print_r($result_att);
				 // die;
                  $condition = array(                    
                    'month' => $curr_month,
                    'year' => $curr_year,
                    'academic_year_id' =>@$result_att->academic_year_id,
                    'teacher_id' =>@$result_att->t_id
                  );
                break;
              case 'employee':
                $result_att = $this->m_bio_att->get_employee_lists($id);
                $condition = array(                    
                    'month' => $curr_month,
                    'year' => $curr_year,
                    'academic_year_id' => @$result_att->academic_year_id,
                    'employee_id' => @$result_att->e_id
                );  
                break; 
                                
            }  
          $data = $condition;
          if (!empty($result_att)) {                  
			       $attendance = $this->m_bio_att->get_single_data($condition,$type);              
          }                                
            $attend = '';
            $bio_att_year = date('Y');
            $bio_att_month = date('m');
            $bio_att_day = date('d');
            $today = $bio_att_year."-".$bio_att_month."-";
            $time = date("h:i:sa");
			   /// for out time  'attendance_time' blank
            $no_of_days = cal_days_in_month(CAL_GREGORIAN, $bio_att_month,$bio_att_year);
            for ($i=1; $no_of_days >= $i; $i++) {
                //$today = date('Y-m-01',strtotime('+1 days'));
                $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>$today.$i,'attendance_time'=>'','out_time'=>'');
            }
            if (empty($attendance)) {
                switch ($type) {
                    case 'student':
                        $data['student_id'] = @$result_att->s_id;
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['school_id'] = @$result_att->school_id;
                        $data['attendance_data'] = json_encode($attend);
                    break;                                
                    case 'teacher':
                        $data['teacher_id'] = @$result_att->t_id;
                        $data['status'] = 1;
                        $data['school_id'] = @$result_att->school_id;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['attendance_data'] = json_encode($attend);
                    break;
                    case 'employee':
                        $data['employee_id'] = @$result_att->e_id; 						
                        $data['status'] = 1;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['school_id'] = @$result_att->school_id;
                        $data['attendance_data'] = json_encode($attend);
					          break;
                }
              $this->m_bio_att->insert($data,$type);                          
            }else{
                $this->update_atten($em_id,$attendance,$condition,$type,$snd_sms_no,$st_name,$id);
            } 
          }

           echo "<h1><center>Attendance update successfully. Please check attendance now.</center></h1>";
         
    }

    public function update_atten($em_id,$attendance,$condition,$type,$snd_sms_no,$st_name,$id)
    { 
      $result = $this->m_bio_att->get_bio_att($em_id);//bio data   
	  // echo "<pre>";
	  // print_r($result);
	  // die();
      $attendance_data = $attendance->attendance_data;
      $attendance_data_decode = json_decode($attendance_data);
      $attend = '';   
      $out_time = '';                                     
      if($em_id == @$result->UserId)
      {               
          $bio_att_day = date('d',strtotime($result->DownloadDate));
          $today = date('Y-m-d',strtotime($result->DownloadDate));
          $time = date("h:i:sa",strtotime($result->DownloadDate));    
          $out_time = date("h:i:sa",strtotime($result->DownloadDate));    
          $status = "P"; //P for present
      }else{
         $bio_att_day = date('d');
         $today = date('Y-m-d');
         $time = date("h:i:sa"); 
         $status = "A"; //A for absent
        
      }                                 
      foreach ($attendance_data_decode as $att_data) {
          if($att_data->day == $bio_att_day){
			/// for out time  check 'attendance_time' 
			  if(empty($att_data->attendance_time)){
				$attend[] = array('day'=>$bio_att_day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$time,'out_time'=>'');
			  }else{
				  $attend[] = array('day'=>$bio_att_day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$att_data->attendance_time,'out_time'=>$out_time);
			  }
          }else{
              $attend[] = $att_data;
          }
      }
      $attendance_record = json_encode($attend);   
	  // echo "<pre>";
	  // print_r($attendance_record);
      $this->m_bio_att->update_attandance($attendance_record,$time,$condition,$type);
	  if(!empty($st_name)){
		  if($type == "student"){
			foreach(json_decode($attendance_record) as $value) {
			  // if($value->attendance == "P"){
				// $message_bodysms= 'Dear  : - ' .$st_name." today is present";                      
				// $urlencode = urlencode($message_bodysms);          
				// send_sms($snd_sms_no,$urlencode);  
			  // }
			  if($value->attendance == "A"){
				$message_bodysms= 'Dear  : - ' .$st_name." today is absent";                      
				$urlencode = urlencode($message_bodysms);           
				send_sms($snd_sms_no,$urlencode);
			  }
			}
		  }
	  }
    }
}