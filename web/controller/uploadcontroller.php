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
//echo "5555";
//echo $_FILES['file']['name']; die();
//echo $_FILES['file']['type']; die();
$tmpfile = $_FILES['file']['tmp_name'];
$filename = basename($_FILES['file']['name']);



// $data = array(
//     'uploaded_file' => '@'.$tmpfile.';filename='.$filename,
// );
		$upload = $_POST['uploadvalue'];
		$userName = $_COOKIE['username'];
		$description = $_POST['description'];
		$createBy = $_COOKIE['username'];
		$createDate= date("Y-m-d");
		$filepath = $_POST['folder'];
		$filename = $_FILES['file']['name'];


		//echo $id; die();
		
		$arrUserInfo=array(
			'userName' => $userName,
			'description' => $description,
			'createBy' => $userName,
			'createDate' => $createDate,
			'fileName' => $filename,
			'filePath' => $filepath
			);
		$jsonSrting = json_encode($arrUserInfo);
		//echo $jsonSrting; die();
		$data_array = array(
			// 'uploadDto' => '{"userName":"wanchat","description":"dash;dkas;","createBy":"wanchat","createDate":"2017-02-10","fileName":"day_01.pdf","filePath":"costs"}',
			'uploadDto' => $jsonSrting,
			'file' => curl_file_create($tmpfile, $_FILES['file']['type'], $filename)

			);
		
		
		$feed=API_URL.'surachit/fileserver/upload';

		//echo $feed; die();
		$result_data=uploadapi($feed,$data_array);
		
		$data_obj=json_decode($result_data);
				//console($data_obj,true);
		if($data_obj->status->code=='Success'){
			echo 'Upload success '.$data_obj->data.' records.';
		}

		header('location: http://localhost/fileserver/web/');
		exit();
	//}

?>
