<?php
//echo $_POST["username"];
//echo "666";
require_once("../config/constants.php");
require_once("../helper/utility_helper.php");
error_reporting( error_reporting() & ~E_NOTICE );
if($_POST['username'] != "" && $_POST['password'] != ""){
	index();
}

if ($_POST['logout'] != "")
    {
        //echo "ddd"; die();
        logout();
    }



function index() {
	
	//echo $_POST['username'];
	//echo $_POST['password'];
	
	if(@$_POST['username'] && @$_POST['password']){
		$url=API_URL.'surachit/fileserver/signin';
		//echo $url;
		$curl=curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		$headers = array(
			'Content-Type:application/json',
			'Authorization: Basic '. base64_encode("{$_POST['username']}:{$_POST['password']}")
			);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$curl_response=curl_exec($curl);
		$data_obj = json_decode($curl_response);
		print_r($data_obj);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		// if($httpcode == "401"){
		// 	redirect('login?message=An active session for this user already exists', 'refresh');
		// }

		$token = $data_obj->{'token'};

		if($token){
			echo "777";
			echo $_POST['username'];
			echo $token;
			$roleName = getRoleName($_POST['username'], trim($token));

			setcookie('username', $_POST['username'], time() + (3600*24), '/');
			setcookie('token', trim($token), time() + (3600*24), '/');
			setcookie('rolename', $roleName, time() + (3600*24), '/');
			
		}
	}
	header('location: http://localhost/fileserver/web/');
	exit();
}
function logout() {
	$url=API_URL.'surachit/fileserver/signout/'.$_COOKIE["username"].'/'.$_COOKIE["token"];

	//echo $url; die();
	getapi($url);
	//die();

	setcookie('username', '', time() - (3600*24), '/');
	setcookie('token', '', time() - (3600*24), '/');
	setcookie('rolename', '', time() - (3600*24), '/');

	header('location: http://localhost/fileserver/web/login.php');
	exit();
}
function profile() {
	$profile=check_login();

	$data['result']=$profile->data;
	$this->load->view('login/profile', $data);
}

/**
* @author : lennon
*/
function getRoleName($username, $token) {
	$url = API_URL.'surachit/fileserver/account/'.$username;
    echo "\n".$url."\n";
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authentication: {$username};{$token}"));
	echo $xmlResponse_eree=curl_error($ch);
	$curl_response=curl_exec($ch);

	$data_obj = json_decode($curl_response);
	//print_r($data_obj); die();
	curl_close($ch);

// console($data_obj, true);
	return $data_obj->data->roleName;
}

?>
