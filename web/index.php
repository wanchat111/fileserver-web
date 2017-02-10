<?php 
error_reporting( error_reporting() & ~E_NOTICE );
require_once("helper/utility_helper.php");
require_once("config/constants.php");

    $feed=API_URL.'surachit/fileserver/listuploads';
    //echo $feed; die();
    $data_obj=json_decode(getapi($feed,TRUE));

    //echo "<pre>"; echo print_r($data_obj);  echo "</pre>";

    //print_r($object_obj); die();

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

  <div class="container">

    <div id="header"></div>
    <div id="menu"></div>

    <div class="container">
    <div >
      <a href="upload.php"><button type="button" class="btn btn-primary vcenter">Upload</button></a>
    </div>
      <div class="row">
        <div class="col-md-12">
        <h4> File list </h4>
          <div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">

             <thead>

               
               <th>File Name</th>
               <th>Create By</th>
               <th>Description</th>
               
               <th>Download</th>
               
              
             </thead>
             <tbody>
              <?php
                foreach($data_obj as $row){
              ?>
              <tr>
                
                
                <td><?php echo $row->file->fileName;?></td>

                <td><?php echo $row->username;?></td>

                
                
                <td><?php echo $row->description;?></td>                
                <td><p data-placement="top" data-toggle="tooltip" title="Download0">
                <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" 
                onClick="window.location.href='controller/downloadcontroller.php?id=<?php echo $row->file->fileId;?>'"> <span class="glyphicon glyphicon-eye-open">
                </span></button></p></td>
                
                
              </tr>

              
              <?php
                }
              ?>
            </tbody>

          </table>

          <div class="clearfix"></div>
          <ul class="pagination pull-right">
            <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
            <li class="active"><a href="#">1</a></li>
            <!--<li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>-->
            <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
          </ul>

        </div>

      </div>
    </div>
  </div>



  



<div id="footer"></div>
</div>
</body>
</html>