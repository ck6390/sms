<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');
/**

 * Codeigniter-SMS-API : Codeigniter Library to Send SMS

**/
function get_sms_gateway()
{
	$ci = & get_instance();
    $ci->db->select('S.*');
    $ci->db->from('sms_settings AS S');
	$ci->db->where('S.school_id',$ci->session->userdata('school_id'));
    return $ci->db->get()->row();
}
function send_sms($number,$message_body,$return='0')
{
	
    //var_dump($setting);
	//Gateway URl
	$smsGatewayUrl='http://66.70.200.49';
	//api element
	$apiElement='/rest/services/sendSMS/sendGroupSms';
	//Your authentication key
	$authKey= get_sms_gateway()->msgclub_auth_key;
	//Your message to send, Add URL encoding here.
	$message=$message_body;
	//Sender ID
	$senderId=get_sms_gateway()->msgclub_sender_id;
	//Define route 
	$routeId='1';
	//Multiple mobiles numbers separated by comma
	$mobileNumber=$number;
	//SMS content type
	$smsContentType='';
	//api parameters
	$api_params=$apiElement.'?AUTH_KEY='.$authKey.'&message='.$message.'&senderId='.$senderId.'&routeId='.$routeId.'&mobileNos='.$mobileNumber.'&smsContentType='.$smsContentType;
	$smsgatewaydata=$smsGatewayUrl.$api_params;
	$url = $smsgatewaydata;
	//var_dump($url);
	//die();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, urldecode($url));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
	curl_close($ch);
	if(!$output)
	{
		$output = file_get_contents($smsgatewaydata);
	}
	if($return == '1')
	{
		return $output;
	}
	else
	{
		return true; 
	}

}

	///

	function check_sms(){
		$url = "http://66.70.200.49/rest/services/sendSMS/getClientRouteBalance?AUTH_KEY=".get_sms_gateway()->msgclub_auth_key."&clientName=".get_sms_gateway()->msgclub_sender_id.'"';
		//var_dump($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_URL, urldecode($url));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
		curl_close($ch);
		// if($output)
		// {
			return $output;
		// }else{
			// return 0;
		// }
	}