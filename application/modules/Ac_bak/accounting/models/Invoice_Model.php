<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
      public function get_fee_type(){
        
        $this->db->select('IH.*,FA.fee_amount');
        $this->db->from('income_heads AS IH'); 
        $this->db->join('fees_amount AS FA', 'IH.id = FA.income_head_id', 'left');
        $this->db->where('IH.head_type', 'fee'); 
        $this->db->where('IH.school_id', $this->session->userdata('school_id'));
        $this->db->or_where('IH.head_type', 'hostel'); 
        $this->db->or_where('IH.head_type', 'transport'); 
        $this->db->group_by('IH.id'); 
             
        return $this->db->get()->result();  
    }
    
    public function get_hostel_fee($student_id){
        
        $this->db->select('R.cost');
        $this->db->from('students AS S'); 
        $this->db->join('hostel_members AS HM', 'HM.user_id = S.user_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('S.id', $student_id); 
        $this->db->where('S.is_hostel_member', 1);
        $this->db->where('S.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row(); 
    }
    
    public function get_transport_fee($student_id){
        
        $this->db->select('RS.stop_fare');
        $this->db->from('students AS S'); 
        $this->db->join('transport_members AS TM', 'TM.user_id = S.user_id', 'left');
        $this->db->join('route_stops AS RS', 'RS.id = TM.route_stop_id', 'left');
        $this->db->where('S.id', $student_id); 
        $this->db->where('S.is_transport_member', 1);
        $this->db->where('S.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->row(); 
    }

    public function get_student_discount($student_id){
        
        $this->db->select('D.*');
        $this->db->from('students AS S'); 
        $this->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
        $this->db->where('S.id', $student_id);  
        $this->db->where('S.school_id', $this->session->userdata('school_id'));       
        return $this->db->get()->row();
    }

    public function get_invoice_list($due = null){
        
        $this->db->select('I.*, group_concat( DISTINCT IH.title separator ",") AS head, S.name AS student_name, AY.session_year, C.name AS class_name, SUM(I.net_amount) as net_amount, SUM(I.gross_amount) as gross_amount, group_concat(I.paid_status separator ",") as status, group_concat( DISTINCT I.month separator ",") AS month');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.school_id', $this->session->userdata('school_id'));
        $this->db->where('I.invoice_type !=', 'income'); 
        if($due){
            $this->db->where('I.paid_status !=', 'paid');  
        }
        
        //$this->db->or_where('I.invoice_type', 'hostel'); 
        //$this->db->or_where('I.invoice_type', 'transport'); 
       
        if($this->session->userdata('role_id') == 4){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
        }        
        //$this->db->where('I.academic_year_id', $this->academic_year_id);       
        $this->db->order_by('I.id', 'DESC');
        $this->db->group_by('I.custom_invoice_id');
        return $this->db->get()->result();        
    }
    
    public function get_single_invoice($id){
        
        $this->db->select('I.*, IH.title AS head, I.discount AS inv_discount, I.id AS inv_id , S.*,SR.*, AY.session_year, C.name AS class_name, I.created_at AS created_at');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('student_register AS SR', 'I.id = SR.invoice_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.school_id', $this->session->userdata('school_id'));
       // $this->db->where('I.invoice_type', 'fee'); 
       // $this->db->or_where('I.invoice_type', 'hostel'); 
       // $this->db->or_where('I.invoice_type', 'transport');
        $this->db->where('I.id', $id);       
       
        return $this->db->get()->row();        
    }
    public function get_invoice_by_custom_invoice_id($custom_invoice_id = null){
        
        $this->db->select('I.*, IH.title AS head, I.discount AS inv_discount, I.id AS inv_id , S.*, AY.session_year, C.name AS class_name','I.id AS inv_id');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.school_id', $this->session->userdata('school_id'));
       // $this->db->where('I.invoice_type', 'fee'); 
       // $this->db->or_where('I.invoice_type', 'hostel'); 
       // $this->db->or_where('I.invoice_type', 'transport');
        $this->db->where('I.custom_invoice_id', $custom_invoice_id); 
       return $this->db->get()->result(); 
    }
    public function get_invoice_single_by_custom_invoice_id($custom_invoice_id = null){
        
        $this->db->select('I.*, IH.title AS head, I.discount AS inv_discount, I.id AS inv_id , S.*, AY.session_year, C.name AS class_name,I.id AS inv_id, group_concat(I.paid_status separator ",") as payment_status, SUM(T.amount) AS paid_amount, (SELECT SUM(net_amount) FROM invoices where custom_invoice_id = "'.$custom_invoice_id.'" GROUP BY custom_invoice_id) AS net_amount');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('transactions AS T', 'T.invoice_id = I.id and T.status = 1', 'left');
        $this->db->where('I.school_id', $this->session->userdata('school_id'));
       // $this->db->where('I.invoice_type', 'fee'); 
       // $this->db->or_where('I.invoice_type', 'hostel'); 
       // $this->db->or_where('I.invoice_type', 'transport');
        $this->db->where('I.custom_invoice_id', $custom_invoice_id); 
        $this->db->group_by('I.custom_invoice_id');
        return $this->db->get()->row();
    }
    
    public function get_student_list($class_id){
        
        $this->db->select('E.roll_no,  S.id, S.user_id, S.discount_id, S.name, S.is_hostel_member, S.is_transport_member');
        $this->db->from('enrollments AS E');        
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);       
        $this->db->where('E.class_id', $class_id); 
        $this->db->where('E.school_id', $this->session->userdata('school_id'));
        return $this->db->get()->result();         
    }
    
    public function get_student_hostel_cost($user_id){
         $this->db->select('R.cost');
        $this->db->from('hostel_members AS HM');        
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('HM.user_id', $user_id); 
        $this->db->where('HM.school_id', $this->session->userdata('school_id'));                 
        return $this->db->get()->row();
    }
    
    public function get_student_transport_fare($user_id){
        
        
        $this->db->select('R.fare');
        $this->db->from('transport_members AS TM');        
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('TM.user_id', $user_id);   
        $this->db->where('TM.school_id', $this->session->userdata('school_id'));               
        return $this->db->get()->row();
    }
    
    public function get_invoice_log_list($invoice_id){
                
        $this->db->select('IL.*, IH.title');
        $this->db->from('invoice_logs AS IL');        
        $this->db->join('income_heads AS IH', 'IH.id = IL.income_head_id', 'left');
        $this->db->where('IL.invoice_id', $invoice_id); 
        $this->db->where('IL.school_id', $this->session->userdata('school_id'));                 
        return $this->db->get()->result();
    }

    public function get_single_invoice_by_student_month($class_id,$month,$student_id,$income_head_id,$paid_status){
        $this->db->select('I.id AS inv_id');
        $this->db->from('invoices AS I');
        $this->db->where('I.school_id', $this->session->userdata('school_id'));
        $this->db->where('I.academic_year_id', $this->academic_year_id);
        $this->db->where('I.class_id', $class_id);
        $this->db->where('I.month', $month);
        $this->db->where('I.student_id', $student_id);
        $this->db->where('I.income_head_id ', $income_head_id);
        $this->db->where('I.paid_status', $paid_status); 
        return $this->db->get()->row();        
    }
    

    public function get_single_student($id, $adv = null){
        
        $this->db->select('S.*, D.amount, D.title AS discount_title, G.name as guardian, E.roll_no, E.class_id, E.section_id, E.academic_year_id, U.email, U.role_id,U.unique_id, R.name AS role,  C.name AS class_name, SE.name AS section');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->join('guardians AS G', 'G.id = S.guardian_id', 'left');
        $this->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
        $this->db->where('S.school_id', $this->session->userdata('school_id'));
        if(!$adv){
            $this->db->where('E.academic_year_id', $this->academic_year_id);
        }
        
        $this->db->where('S.id', $id);
        return $this->db->get()->row();
        
    }
    public function get_fee_type_by_class($class_id = null){
        $this->db->select('IH.*,FA.fee_amount');
        $this->db->from('income_heads AS IH'); 
        $this->db->join('fees_amount AS FA', 'IH.id = FA.income_head_id', 'left');
        $this->db->where('IH.head_type', 'fee'); 
        $this->db->where('FA.class_id', $class_id); 
        $this->db->where('IH.school_id', $this->session->userdata('school_id'));
        $this->db->or_where('IH.head_type', 'hostel'); 
        $this->db->or_where('IH.head_type', 'transport'); 
        $this->db->group_by('IH.id'); 
        return $this->db->get()->result();  
    }
    
}
