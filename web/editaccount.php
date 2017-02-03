<?php 
error_reporting( error_reporting() & ~E_NOTICE );
$username = $_GET['username'];
require_once("helper/utility_helper.php");
require_once("config/constants.php");

    $feed=API_URL.'surachit/fileserver/account/'.$username;
//    echo $feed; die();
    $data_obj=json_decode(getapi($feed,TRUE));
    $data = $data_obj->data;

  //  echo "<pre>"; echo print_r($data);  echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/website.css" rel="stylesheet">
  <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="../js/website.js"></script> 
</head>
<body>
  <form name="login" method="post" action="controller/accountcontroller.php">
    <div class="container">

      <div id="header"></div>
      <div id="menu"></div>

      <h1>Edit Profile</h1>
      <hr>
      <div class="row">

      <!-- left column 
      <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div> -->
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">

        <h3>Personal info</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="updatename" value="<?php echo $data->name; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="updatelastname" value="<?php echo $data->name; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="updateemail" value="<?php echo $data->email; ?>">
            </div>
          </div>

          


          <div class="form-group">
            <!--<label class="col-md-3 control-label">Password:</label>-->
            <div class="col-md-8">
              <input class="form-control" type="hidden" name="updatepassword" value="<?php echo $data->password; ?>">
              <input class="form-control" type="hidden" name="username" value="<?php echo $data->userName; ?>">
              <input class="form-control" type="hidden" name="update" value="update">
              
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-primary" value="Cancel" onClick="window.location.href='accountList.php'">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div id="footer"></div>
  </div>
  <hr>
</form>
</body>
</html>