<?PHP
date_default_timezone_set("Asia/Bangkok");
ini_set('upload_max_filesize', '20M');

	function memcache($type='set',$key='',$value='',$expire=3600){
		if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
			return false;	
		}
			
		$key='pushads_'.$key;
		$memcache_obj = new Memcache;
		$memcache_server=$memcache_obj->connect(MEMCACHE_SERVER, MEMCACHE_PORT);
		if($memcache_server===true){
			if($type=='set')
				return $memcache_obj->set($key, $value, 0, $expire);
			elseif($type=='get')
				return @$memcache_obj->get($key);
			elseif($type=='del')
				return $memcache_obj->flush();
		}
	}

	function ClassLoad($class_name=NULL,$type=".php"){
		$path = "controllers/";
		$className = ucfirst($class_name);
		if(trim($className)!=NULL)
		{
			/* autoload library classes */
			if(is_file(APPPATH.$path.$className.$type))
			{
				@include_once( APPPATH.$path.$className.$type );
					
				return new $className;
					
			}else{
				echo "Can't load class : ".APPPATH.$path.$className.$type;exit();
			}
		}
	}
	
	function nocache(){
		if($_SERVER['SERVER_ADDR']!='127.0.0.1'){
			return false;	
		}
		
		$CI =& get_instance();
		$CI->output->nocache();
	}

	function console($data=NULL,$stop=FALSE){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	
		if($stop)
			exit();
	}

	function getapi($url=NULL, $send_cookie=NULL){
		if(!$url)
			return false;

		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		
		if($send_cookie){
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authentication: {$_COOKIE['username']};{$_COOKIE['token']}"));
		}
		$xmlResponse_eree=curl_error($ch);
		$xmlResponse=curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$xmlResponse = addHttpCode($xmlResponse, $httpcode);

		return 	 $xmlResponse;
	}
	
	function postapi($url=NULL, $post_data=NULL, $header=NULL){
		if(!$url){
			return false;
		}
		
		if($header==NULL){
			$header='Content-Type: application/json';
		}

		//echo $url; die();
	
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		$header,
		'Content-Length: ' . strlen($post_data),
		"Authentication: {$_COOKIE['username']};{$_COOKIE['token']}"
		));
	
		$xmlResponse=curl_exec($ch);

		//echo $xmlResponse; die();
	
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		curl_close($ch);

		$xmlResponse = addHttpCode($xmlResponse, $httpcode);
	
		return $xmlResponse;
	}

	function getCurlValue($filename, $contentType, $postname){
	   // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
	   // See: https://wiki.php.net/rfc/curl-file-upload
	   if (function_exists('curl_file_create')) {
	       return curl_file_create($filename, $contentType, $postname);
	   }

	   // Use the old style if using an older version of PHP
	   $value = "@{$filename};filename=" . $postname;
	   if ($contentType) {
	       $value .= ';type=' . $contentType;
	   }

	   return $value;
	}

	function uploadapi($url=NULL, $post_data=NULL,$filesize){
		if(!$url){
			return false;
		}
		$data_string=json_encode($post_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");   
	    curl_setopt($ch, CURLOPT_HTTPHEADER,
	    	array(
	    	"Content-Type: multipart/form-data",
	  //   	"Accept-Encoding: ",
			// "Content-Length: ". $filesize,
			// "Content-Transfer-Encoding: binary",
			// 'Content-Disposition: form-data; name="myfile"; filename="test"',
			"Authentication: {$_COOKIE['username']};{$_COOKIE['token']}"
			)
		);
	    //curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);   
	    //curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);  
	    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	    //curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );

	    $result = curl_exec ($ch);
	    if ($result === FALSE) {
	        echo "Error sending" . $fname .  " " . curl_error($ch);
	        curl_close ($ch);
	    }else{
	        curl_close ($ch);
	        //echo  "Result: " . $result;
	    }

	    return $result;
	}
	
	function putapi($url=NULL, $post_data=NULL){
		if(!$url)
			return false;
	
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($post_data),
		"Authentication: {$_COOKIE['username']};{$_COOKIE['token']}"
		));
	
		$xmlResponse = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
		curl_close($ch);

		$xmlResponse = addHttpCode($xmlResponse, $httpcode);
	
		return $xmlResponse;
	}
	
	function class_active($url_active=NULL){
		if(empty($url_active)){
			return false;
		}
		
		$CI =& get_instance();
		$url_segment=($CI->uri->segment(2))?$CI->uri->segment(2):$CI->uri->segment(1);
		if(in_array($url_segment, $url_active)){
			return 'active';
		}
	}
	
	function check_login(){
		if(!isset($_COOKIE['username']) && !isset($_COOKIE['token'])){
			redirect('login', 'refresh');
		}

		$result=getapi(API_URL.'push-ad/1.0/account/?name='.$_COOKIE['username'], TRUE);

		$result_data=json_decode($result);
	
		if($result_data->status->httpCode==401){
			redirect('login', 'refresh');
		}
		else{
			return $result_data;
		}
	}

	/**
	 * Recursively delete a directory
	 *
	 * @param string $dir Directory name
	 * @param boolean $deleteRootToo Delete specified top-level directory as well
	 */
	function unlinkRecursive($dir, $deleteRootToo)
	{
	    if(!$dh = @opendir($dir))
	    {
	        return;
	    }
	    while (false !== ($obj = readdir($dh)))
	    {
	        if($obj == '.' || $obj == '..')
	        {
	            continue;
	        }

	        if (!@unlink($dir . '/' . $obj))
	        {
	            unlinkRecursive($dir.'/'.$obj, true);
	        }
	    }

	    closedir($dh);

	    if ($deleteRootToo)
	    {
	        @rmdir($dir);
	    }

	    return;
	}

	function addHttpCode($xmlResponse, $httpcode){
		//print_r($xmlResponse);
		//echo $xmlResponse;
		$xmlResponse = json_decode($xmlResponse);
		$xmlResponse->status->httpCode = $httpcode;

		return json_encode($xmlResponse);
	}

?>