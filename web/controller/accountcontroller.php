<?php
error_reporting( error_reporting() & ~E_NOTICE );
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

echo $_POST['updatename'];
echo $_POST['updatelastname'];
echo $_POST['updateemail'];
echo $_POST['updatepassword'];

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
	

		echo "<pre>"; print_r($data_string); echo "</pre>"; die();

	$feed=API_URL.'push-ad/1.0/account';

	
	$result_data=postapi($feed,$data_string);
	$data_obj=json_decode($result_data);
// console($data_obj, true);
	if($data_obj->status->code=='Success'){
			//console($data_obj);
			//redirect('advertisement/settings', 'refresh');
		$datamessage = $data_obj->status->code;
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

		$feed=API_URL.'push-ad/1.0/account/'.$_POST['userName'];

		$arrUserInfo=array(
			'name' => $firstname,
			'surname' => $lastname,
			'email' => $email,
			'password' => $password
			);

		$data_string=json_encode($arrUserInfo);
		echo "<pre>"; print_r($data_string); echo "</pre>"; die();
		$result_data=putapi($feed,$data_string);
		$data_obj=json_decode($result_data);

		console($data_obj);

		### pagination ###
		$page=(!@$page)?1:$page;
		$limit=10;
		### pagination ###
		
		$feed=API_URL.'push-ad/1.0/accounts/?limit='.$limit.'&page='.$page;
		//$feed=API_URL.'push-ad/1.0/advert-setups?limit='.$limit.'&page='.$page;
		$data_obj=json_decode(getapi($feed,TRUE));

		### pagination ###
		$total=(@$data_obj->pagination->grandTotal)?$data_obj->pagination->grandTotal:0;
		if($total%$limit)
			$total_page=floor($total/$limit)+1;
		else
			$total_page=floor($total/$limit);
		
		$data['total']=$total;
		$data['total_page']=$total_page;
		$data['page']=$page;
		$data['limit']=$limit;
		### pagination ###

		$data['result']=$data_obj->data;
		$data['page_view']='advertisement/settings';
		$this->load->view('layouts/default', $data);
	}


	?>
