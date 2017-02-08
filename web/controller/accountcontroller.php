<?php
error_reporting( error_reporting() & ~E_NOTICE );
require_once("../helper/utility_helper.php");
require_once("../config/constants.php");
//echo $_POST["username"];
// echo $_POST['firstname'];
// echo $_POST['lastname'];
// echo $_POST['email'];
// echo $_POST['role'];
// echo $_POST['branch'];
// echo $_POST['username'];
// echo $_POST['password'];
 echo $_POST['create'];
if($_POST['create'] != ""){
	createaccount();
}

//echo $_POST['updatename'];
//echo $_POST['updatelastname'];
//echo $_POST['updateemail'];
//echo $_POST['updatepassword'];

if($_POST['update'] != ""){
	editaccount();
}

function createaccount() {
	//check_login();

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$roleid = $_POST['role'];
	$branchid = $_POST['branch'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$data_array=array(
		'name' => $firstname,
		'surname' => $lastname,
		'email' => $email,
		'roleName'	=>	$roleid,
		'branchId'	=>	$branchid,
	
		'userName'	=> 	$username,
		'password'	=>	$password
		);

	$data_string=json_encode($data_array);
	

		//echo "<pre>"; print_r($data_string); echo "</pre>"; die();

	$feed=API_URL.'surachit/fileserver/account';

	
	$result_data=postapi($feed,$data_string);
	$data_obj=json_decode($result_data);
// console($data_obj, true);
	if($data_obj->status->code=='Success'){
			//console($data_obj);
			//redirect('advertisement/settings', 'refresh');
		$datamessage = $data_obj->status->code;
		header('location: http://localhost/fileserver/web/accountlist.php');
		exit();
	}
	else{
			//console($data_obj);
		$datamessage = $data_obj->status->message;
	}
	echo $datamessage;
		//console($datamessage);
		//echo json_encode($data_obj);
		/*$data['userinfo'] = $arrUserInfo;
		$data['page_view']='advertisement/adduser';
		$this->load->view('layouts/default', $datamessage);*/
		
	}

	function deleteuser($userName=NULL) {
		check_login();
		
		if(!$userName){
			return false;
		}
		
		$feed=API_URL.'push-ad/1.0/account/'.$userName;
		
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
			header('location: http://localhost/fileserver/web/');
			exit();
		}
		else{
			echo '<script> alert(" '.$data_obj->status->message.' "); </script>';
		}
		
	}

	function editaccount() {
		//check_login();

		$firstname =  $_POST['updatename'];
		$lastname =  $_POST['updatelastname'];
		$email = $_POST['updateemail'];
		$password = $_POST['updatepassword'];


		$feed=API_URL.'surachit/fileserver/account/'.$_POST['username'];
		//echo $feed; die();
		$arrUserInfo=array(
			'name' => $firstname,
			'surname' => $lastname,
			'email' => $email,
			'password' => $password
			);

		$data_string=json_encode($arrUserInfo);
		//echo "<pre>"; print_r($data_string); echo "</pre>"; die();


		$result_data=putapi($feed,$data_string);

		$data_obj=json_decode($result_data);

		// echo "<pre>";
		// print_r($data_obj);
		// echo "</pre>";
		// die();

		// print_r($result_data); die();
		//console($data_obj);
		// header('location: http://localhost/fileserver/web/accountlist.php');
		// exit();
		//echo "sssss";
		if($data_obj->status->code =='Success'){
			//echo '<script> alert(" '.$data_obj->status->code.' "); </script>';
			//echo "::::::";
			header('location: http://localhost/fileserver/web/accountList.php');
		exit();
		//echo "-------";
		}
		else{
			//echo '<script> alert(" '.$data_obj->status->message.' "); </script>';
		}

	
	
		
	}


	?>
