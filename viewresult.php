<?php
require_once("crud6.php");
$id = $_GET['$id'];
if($id)
{
    $crudobj = new crud;
    $resultArr = $crudobj->view($id);
}
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="/css/bootstreap.min.css">
    </head>
    <title>Student Information</title>
        <body>
            <div class="col-sm-offset-9">
            </div>
            <div class="clearfix">&nbsp;</div>
            
            <div class="col-sm-offset-3 col-sm-6 text-center">
<table class="table table-striped table-bordered table-hover table-responsive"> <!--starting of table-->
                
<h3 style="float:left;width:70%">Student Details</h3>
<a href="studentlist1.php" class="btn btn-primary" style="margin-top:15px;">manage student</a>
            <tr>
                    <th>Profile pic</th>
                    <td><img src="<?php echo $resultArr['profilepic'];?>" height="100px"> </td>
            </tr>
            <tr>
                    <th>Student Name</th>
                    <td><?php echo $resultArr['fname']." ".$resultArr['lname'];?></td>
            </tr>
            <tr>
                    <th>Gender</th>
                    <td><?php echo $resultArr['gender'];?></td>
            </tr>
            <tr>
                    <th>Address</th>
                    <td><?php echo $resultArr['address'];?></td>
            </tr>
            <tr>
                    <th>Mobile No</th>
                    <td><?php echo $resultArr['mobile'];?></td>
            </tr>
            <tr>
                    <th>Batch</th>
                    <td><?php echo $resultArr['batch'];?></td>
            </tr>
            <tr>
                    <th>Fees</th>
                    <td><?php echo $resultArr['fees'];?></td>
            </tr>
    </table>                            <!--end of table-->
            </div>
    </body>
</html>