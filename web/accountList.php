<?php 
error_reporting( error_reporting() & ~E_NOTICE );
require_once("helper/utility_helper.php");
require_once("config/constants.php");

$feed=API_URL.'surachit/fileserver/accounts';
    //echo $feed; die();
$data_obj=json_decode(getapi($feed,TRUE));
$data = $data_obj->data;

    // echo "<pre>"; echo print_r($data);  echo "</pre>";

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
        <button type="button" class="btn btn-primary vcenter" onClick="window.location.href='createaccount.php'">Create account</button>
      </div>
      <div class="row">


        <div class="col-md-12">
          <h4>File list</h4>
          <div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">

             <thead>


               <th>Name</th>
               <th>Surname</th>
               <th>Role</th>
               <th>Email</th>
               
               <th>Edit</th>
               <th>Delete</th>
             </thead>
             <tbody>
              <?php
              foreach($data as $row) {
                ?>

                <tr>

                  <td><?php echo $row->name;?></td>
                  <td><?php echo $row->surname;?></td>
                  <td><?php echo $row->roleName;?></td>  
                  <td><?php 
                    $role = $row->branchId;
                    $rolename="";
                //echo $role;
                    if($role==1){

                      $rolename = 'ส่วนกลาง';
                    } if($role==2){
                      $rolename = 'ทวีรัตน์';
                    } if($role==3){
                      $rolename = 'ท่าจีน';
                    } if($role==4){
                      $rolename = 'บ้านคลองนกกระทุง';
                    } if($role==5){
                      $rolename = 'เผยอิง';
                    } if($role==6){
                      $rolename = 'ศิริพงศ์วิทยา';
                    } if($role==7){
                      $rolename = 'สมานคุณ';
                    } if($role==8){
                      $rolename = 'อนุบาลธิดาเมตตาธรรม';
                    }

                    echo $rolename;
                    ?></td>               

                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onClick="window.location.href='editaccount.php?username=<?php echo $row->userName;?>'" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  ><span class="glyphicon glyphicon-remove"></span></button></p></td>
                  </tr>

                  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                          <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                        </div>
                        <div class="modal-body">

                         <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                       </div>
                       <div class="modal-footer ">
                       <button type="button" class="btn btn-success" onClick="window.location.href='controller/deletecontroller.php?username=<?php echo $row->userName;?>'"><span class="glyphicon glyphicon-ok-sign" ></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                      </div>
                    </div>
                    <!-- /.modal-content --> 

                  </div>
                  <!-- /.modal-dialog --> 

                </div>
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

<!--
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input class="form-control " type="text" placeholder="Mohsin">
          </div>
          <div class="form-group">

            <input class="form-control " type="text" placeholder="Irshad">
          </div>
          <div class="form-group">
            <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


          </div>
        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
        </div>
      </div>
      
    </div>
    
  </div>

-->

 <!-- <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
        </div>
        <div class="modal-body">

         <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

       </div>
       <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
    </div>
    <!-- /.modal-content --> 
    <!--
  </div>
  <!-- /.modal-dialog --> 
  <!--
</div>
-->

<div id="footer"></div>
</div>
</body>
</html>