<?php 
require_once("helper/utility_helper.php");
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
    <h1>Create Account</h1>
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
      
      <!-- Create form column -->
      <div class="col-md-9 personal-info">
        
        <h3>Account info</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="firstname">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="lastname">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="email">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">role:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="role" class="form-control" name="role">
                  <option value="admin">admin</option>
                  <option value="useradmin">useradmin</option>   
                  <option value="user">user</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">branch:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="branch" class="form-control" name="branch">
                  <option value="1">ส่วนกลาง</option>
                  <option value="2">ทวีรัตน์</option>   
                  <option value="3">ท่าจีน</option>
                  <option value="4">บ้านคลองนกกระทุง</option>
                  <option value="5">เผยอิง</option>
                  <option value="6">ศิริพงศ์วิทยา</option>

                  <option value="7">สมานคุณ</option>
                  <option value="8">อนุบาลธิดาเมตตาธรรม</option>
                  
                </select>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" name="username">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="passwordcheck">
              <input type="hidden" name="create" value = "create">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save">
              <span></span>
              <input type="reset" class="btn btn-primary" onClick="window.location.href='accountList.php'" value="Cancel">
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