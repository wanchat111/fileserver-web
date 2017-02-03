<?php

error_reporting( error_reporting() & ~E_NOTICE );
require_once("../helper/utility_helper.php");
require_once("../config/constants.php");
	
	//function export($id=0, $name=null){
	//	check_login();

	// private int uploadId;
	// private String userName;
	// private int fileId;
	// private String description;
	// private String createBy;
	// private Date createDate;
	// private String lastModify;
	// private Date dateModify;
	// private String filePath;
	// private String fileName;
		$upload = $_POST['uploadvalue'];
		$userName = $_POST['name'];
		$description = $_POST['description'];
		$createBy = $_COOKIE['username'];
		$createDate= date("Y-m-d");

		//echo $id; die();
		
		$arrUserInfo=array(
			'userName' => $userName,
			'description' => $description,
			'email' => $email,
			'password' => $password
			);
		
		$feed=API_URL.'surachit/fileserver/upload';

		//echo $feed; die();
		$result_data=uploadapi($feed,$data_array,$filesize);
		
		$data_obj=json_decode($result_data);
				//console($data_obj,true);
		if($data_obj->status->code=='Success'){
			echo 'Upload success '.$data_obj->data.' records.';
		}

		header('location: http://localhost/fileserver/web/');
		exit();
	//}

?>
