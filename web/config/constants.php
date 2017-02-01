<?php

if($_SERVER['SERVER_ADDR']=='127.0.0.1' || $_SERVER['SERVER_ADDR']=='::1'){
	//define('API_URL','http://172.17.181.195:28080/');
	define('API_URL','http://localhost:8080/');
}
else{
	define('API_URL','http://pushad-dev-api.truelife.com/');
}

?>