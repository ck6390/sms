  <?php 
  function create_new_page($page_name)
  {
	  // Create Controller
  	$full_page = $page_name.".php";
  	$get_page_name = scandir(APPPATH.'config/');
  	//var_dump(expression)
  	if(!in_array($full_page,$get_page_name)){
  	  $page_create = fopen(APPPATH.'config/'.$full_page, "w")
	  or die("Unable to open file!");
	  $page_content ="<?php 
	    \$config['my_report']['report']['1'] = '1|1|1|1';
		\$config['my_certificate']['certificate']['1'] = '1|1|1|1';
		\$config['my_exam']['resultsms']['1'] = '1|1|1|1';
		\$config['my_exam']['resultemail']['1'] = '1|1|1|1';
		\$config['my_exam']['text']['1'] = '1|1|1|1';
		\$config['my_exam']['mail']['1'] = '1|1|1|1';
		\$config['my_exam']['resultcard']['1'] = '1|1|1|1';
		\$config['my_exam']['marksheet']['1'] = '1|1|1|1';
		\$config['my_exam']['meritlist']['1'] = '1|1|1|1';
		\$config['my_exam']['finalresult']['1'] = '1|1|1|1';
		\$config['my_exam']['examresult']['1'] = '1|1|1|1';
		\$config['my_exam']['mark']['1'] = '1|1|1|1';
		\$config['my_exam']['attendance']['1'] = '1|1|1|1';
		\$config['my_exam']['suggestion']['1'] = '1|1|1|1';
		\$config['my_exam']['examhallticket']['1'] = '1|1|1|1';
		\$config['my_exam']['schedule']['1'] = '1|1|1|1';
		\$config['my_exam']['exam']['1'] = '1|1|1|1';
		\$config['my_exam']['grade']['1'] = '1|1|1|1';
		\$config['my_hostel']['member']['1'] = '1|1|1|1';
		\$config['my_hostel']['room']['1'] = '1|1|1|1';
		\$config['my_hostel']['hostel']['1'] = '1|1|1|1';
		\$config['my_transport']['member']['1'] = '1|1|1|1';
		\$config['my_transport']['route']['1'] = '1|1|1|1';
		\$config['my_transport']['vehicle']['1'] = '1|1|1|1';
		\$config['my_library']['issue']['1'] = '1|1|1|1';
		\$config['my_library']['member']['1'] = '1|1|1|1';
		\$config['my_library']['book']['1'] = '1|1|1|1';
		\$config['my_assignment']['assignment']['1'] = '1|1|1|1';
		\$config['my_event']['event']['1'] = '1|1|1|1';
		\$config['my_announcement']['holiday']['1'] = '1|1|1|1';
		\$config['my_announcement']['news']['1'] = '1|1|1|1';
		\$config['my_hrm']['designation']['1'] = '1|1|1|1';
		\$config['my_announcement']['notice']['1'] = '1|1|1|1';
		\$config['my_message']['text']['1'] = '1|1|1|1';
		\$config['my_message']['mail']['1'] = '1|1|1|1';
		\$config['my_message']['message']['1'] = '1|1|1|1';
		\$config['my_accounting']['expenditure']['1'] = '1|1|1|1';
		\$config['my_accounting']['exphead']['1'] = '1|1|1|1';
		\$config['my_accounting']['income']['1'] = '1|1|1|1';
		\$config['my_accounting']['incomehead']['1'] = '1|1|1|1';
		\$config['my_accounting']['duefeesms']['1'] = '1|1|1|1';
		\$config['my_accounting']['duefeeemail']['1'] = '1|1|1|1';
		\$config['my_accounting']['invoice']['1'] = '1|1|1|1';
		\$config['my_accounting']['feetype']['1'] = '1|1|1|1';
		\$config['my_accounting']['discount']['1'] = '1|1|1|1';
		\$config['my_payroll']['history']['1'] = '1|1|1|1';
		\$config['my_payroll']['payment']['1'] = '1|1|1|1';
		\$config['my_payroll']['grade']['1'] = '1|1|1|1';
		\$config['my_visitor']['visitor']['1'] = '1|1|1|1';
		\$config['my_hrm']['employee']['1'] = '1|1|1|1';
		\$config['my_attendance']['absentsms']['1'] = '1|1|1|1';
		\$config['my_attendance']['absentemail']['1'] = '1|1|1|1';
		\$config['my_attendance']['employee']['1'] = '1|1|1|1';
		\$config['my_attendance']['teacher']['1'] = '1|1|1|1';
		\$config['my_attendance']['student']['1'] = '1|1|1|1';
		\$config['my_student']['student']['1'] = '1|1|1|1';
		\$config['my_guardian']['guardian']['1'] = '1|1|1|1';
		\$config['my_academic']['promotion']['1'] = '1|1|1|1';
		\$config['my_academic']['routine']['1'] = '1|1|1|1';
		\$config['my_academic']['syllabus']['1'] = '1|1|1|1';
		\$config['my_academic']['subject']['1'] = '1|1|1|1';
		\$config['my_academic']['section']['1'] = '1|1|1|1';
		\$config['my_academic']['classes']['1'] = '1|1|1|1';
		\$config['my_teacher']['teacher']['1'] = '1|1|1|1';
		\$config['my_administrator']['permission']['1'] = '1|1|1|1';
		\$config['my_administrator']['activitylog']['1'] = '1|1|1|1';
		\$config['my_administrator']['smstemplate']['1'] = '1|1|1|1';
		\$config['my_administrator']['emailtemplate']['1'] = '1|1|1|1';
		\$config['my_administrator']['email']['1'] = '1|1|1|1';
		\$config['my_administrator']['password']['1'] = '1|1|1|1';
		\$config['my_administrator']['user']['1'] = '1|1|1|1';
		\$config['my_administrator']['role']['1'] = '1|0|0|0';
		\$config['my_administrator']['year']['1'] = '1|1|1|1';
		\$config['my_setting']['sms']['1'] = '1|1|1|1';
		\$config['my_setting']['payment']['1'] = '1|1|1|1';
		\$config['my_setting']['setting']['1'] = '1|1|1|1';
		\$config['my_dashboard']['dashboard']['1'] = '1|1|1|1';";
	  fwrite($page_create, "\n". $page_content);
	  fclose($page_create);
  	}else{
		return true;
	}
}