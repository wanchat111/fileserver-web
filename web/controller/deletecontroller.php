<?php

error_reporting( error_reporting() & ~E_NOTICE );
require_once("../helper/utility_helper.php");
require_once("../config/constants.php");
	
	//function export($id=0, $name=null){
	//	check_login();
		$username = $_GET['username'];
		//echo $_GET['username']; die();
		//echo $_POST['username']; die();
		
		if(!$username){
			return false;
		}
		
		$feed=API_URL.'surachit/fileserver/account/'.$username;
		//echo $feed; die();
		$ch=curl_init($feed);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Authentication: {$_COOKIE['username']};{$_COOKIE['token']}"
		));
		
		$xmlResponse=curl_exec($ch);
		
		curl_close($ch);

		$data_obj=json_decode($xmlResponse);

		if($data_obj->status->code=='Success'){
			//echo '<script> alert(" '.$data_obj->status->code.' "); </script>';
			header('location: http://localhost/fileserver/web/accountList.php');
		exit();
		}
		else{
			echo '<script> alert(" '.$data_obj->status->message.' "); </script>';
		}

		
	

		
	//}

?>
