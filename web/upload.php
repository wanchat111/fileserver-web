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
<body onload ="currentDate()">

  <div class="container">

    <div id="header"></div>
    <div id="menu"></div>

    <form name="upload" method="post" action="controller/uploadcontroller.php">
      <div class="form-group">
        <label for="inputFile">File input :</label>
        <input type="file" class="form-control-file" id="inputFile">
      </div>
      <div class="form-group">
        <label for="fileName">File name :</label>
        <input class="form-control" name="fileName">
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" name="description" rows="3"></textarea>

      </div>
      <!--
      <div class="form-group">
        <label for="createBy">Create by :</label>
        <input class="form-control" id="createBy" disabled>
      </div>
      -->

      <button type="submit" class="btn btn-primary">Submit</button><span></span>
      <input type="hidden" name="uploadvalue" value="uploadvalue">
      <input type="reset" class="btn btn-primary" onClick="window.location.href='accountList.php'" value="Cancel">
    </form>

    <div id="footer"></div>
    
  </div>
</body>
</html>