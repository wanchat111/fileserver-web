<?php

error_reporting( error_reporting() & ~E_NOTICE );
require_once("../helper/utility_helper.php");
require_once("../config/constants.php");
	
	//function export($id=0, $name=null){
	//	check_login();
		$id = $_GET['id'];
		//echo $id; die();
		if(!$id){
			return false;
		}
		
		$feed=API_URL.'surachit/fileserver/download/'.$id;

		//echo $feed; die();
		$data_return=getapi($feed,TRUE);
		
		header("Content-Type: text/txt");
		header("Content-Disposition: attachment; filename=" . str_replace(" ", "", rawurldecode($name)) . ".pdf");
		header("Cache-Control: no-cache, no-store, must-revalidate");
		header("Pragma: no-cache");
		header("Expires: 0");
			
		echo $data_return;

		header('location: http://localhost/fileserver/web/');
		exit();
	//}

?>
