<?php
//echo $_POST["username"];
//echo "666";

if($_POST['username'] != "" && $_POST['password'] != ""){
	index();
}

public function createaccount() {
	check_login();

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$roleid = $_POST['role'];
	$branchid = $_POST['branch'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$data_array=array(
		'name' => $_POST['firstname'],
		'surname' => $_POST['lastname'],
		'email' => $_POST['email'],
		'roleName'	=>	$_POST['role'];,
		'branchId'	=>	$_POST['branch'];,
				//'deletedDate'	=> null,

		'userName'	=> 	$_POST['username'];,
		'password'	=>	$_POST['password'];
		);

	$data_string=json_encode($data_array);
	

		//echo "<pre>"; print_r($arrUserInfo); echo "</pre>"; die();

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


	?>
