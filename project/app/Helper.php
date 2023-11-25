<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function sendMail($to,$subject,$message){
		$from = "no-reply@dryclean.io";
		$fromName = "No-reply";
		// To send HTML mail, the Content-type header must be set
		$headers  = "";		
		$headers .= "Reply-To: <".$to.">\r\n";
  		$headers .= "Return-Path: <".$from.">\r\n";
  		$headers .= "From: <".$from.">\r\n"; 
		
		$headers .= "Organization: DryClean\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
		 
    	mail($to,$subject,$message,$headers);    
    }	
	
	public static function checkPostParams($array){
		$return = true;
		if(is_array($array)){
			foreach ($array as $key => $value) {
				if(isset($_POST[$value])){
					if(trim($_POST[$value])==""){
						$return = false;
					}
				}else{
					$return = false;
				}
			}
		}
		return $return;
	}
	
	public static function findInPost($key,$array){
		if(is_array($array) && $key!="" && array_key_exists($key, $array)){
			return $array[$key];
		}
		return "";
	}
	
}
