<?php
require_once("crud6.php");
$id=$_GET['$id'];

$crudobj = new crud;
$resultArr = $crudobj->view($id);
$oldimage = $resultArr['profilepic'];

if(isset($_POST['submit'])&& $_POST['submit'] == "update")
{
    $crudobj->update($_POST,$id,$oldimage);
    header("location:viewresult.php?id=$id");
}

?>

<html>
   <head>
     <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
     <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
     <script type="text/javascript" src="js/jquery.validate.min.js"></script>
   </head>
   <title>Student Information</title>
   <body>
     <div class="pull-right">
     <a href="studentlist1.php" class="btn btn-primary" style="margin-top: 15px;">Manage student</a>
     </div>
     <div class="clearfix">&nbsp;</div>
        
     <form action="" method="POST" enctype="multipart/form-data" id="user">  <!--starting of the form-->
         <h4 class="text-center">student personal information</h4>
         <div class="form-group clearfix">
                <div class="col-sm-4">
                    <label class="label-control">First Name</label>
                    <input type="text" name="fname" class="form-control" id="firstname" value="<?php echo $resultArr['fname'];?>">
                    <p id="p1"></p>
                </div>
                <div class="col-sm-4">
                    <label class="label-control">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="lastname" value="<?php echo $resultArr['lname'];?>">
                    <p id="p2"></p>
                </div>
                <div class="col-sm-4">
                    <label class="label-control">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?php echo $resultArr['address'];?>">
                    <p id="p3"></p>
                </div>
         </div> 
         <div class="form-group clearfix">
                <div class="col-sm-4">
                    <label class="label-control">Birth Date</label>
                    <input type="text" name="dob" class="form-control" id="birth_date" value="<?php echo $resultArr['dob'];?>">
                    <p id="p4"></p>
                </div>
                <div class="col-sm-4">
                    <label class="label-control">Age</label>
                    <input type="number" name="age" class="form-control" id="student_age" value="<?php echo $resultArr['age'];?>">
                    <p id="p5"></p>
                </div>
                <div class="col-sm-4">
                    <label class="label-control">Mobile</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" value="<?php echo $resultArr['mobile'];?>">
                    <p id="p6"></p>
                </div>
         </div> 
         <div class="form-group clearfix">
                <div class="col-sm-4" style="margin-top: 40px;"><!-- code for the gender -->
                    <label class="label-control">Gender</label>
Male:<input type="radio" name="gender" value="Male" <?php echo ($resultArr['gender']=='Male')?'checked':""?>>
Female:<input type="radio" name="gender" value="Female" <?php echo ($resultArr['gender']=='Female')?'checked':""?>>  
                </div>
            <div class="col-sm-4"> <!--code for the dropdown of batch name-->
                <label class="label-control">Standared</label> 
                    <select class="form-control" name="batch">
                        <?php
                        $batch=$resultArr['batch'];
                        echo $batch;
$batch_Arr=array('MULTI_OS','LSP','UNIX_Internals','PPA','Logic_Building','win32_SDK');
            
                        foreach($batch_Arr as $batch_id => $batch_name)
                        {
                            echo"<option value='$batch_name'";
                            if($resultArr['batch'] === $batch_name)
                            {
                                echo "selected = selected";
                            }
                            echo">$batch_name</option>";
                        }
                        ?>
                </select>
            </div> 
            <div class="col-sm-4">
                    <label class="label-control">Fees</label>
<input type="text" name="fees" class="form-control" id="fees" value="<?php echo $resultArr['fees'];?>">
                <p id="p7"></p>
            </div>
            <div class="col-sm-4"> <!--code for the profile picture-->
                <label class="label-control">Profile Picture</label>
                    <?php
                    if($resultArr['profilepic'])
                    {?>
            <img src="<?php echo $resultArr['profilepic'];?>" height="80px" width="100px">
                    <?php
                    }
                    ?>
                <input type="file" name="profilepic">
            </div>
        </div>
             <div class="form-group clearfix text-center">
<input type="submit" name="submit" value="update" style="margin-top: 15px;" onclick="return validate();">
             </div>
       </form> <!--ending of the form-->
    </body>
</html>

<script type="text/javascript">

function validate()
{
    var name_regex = /^[a-zA-Z]+$/;
    var add_regex = /^[0-9a-zA-Z]+$/;
    var fees_regex = /^\d+$/;
    var ph =/^[789][0-9]{9}$/;
    var fname = $('#firstname').val();
    var lname = $('#lastname').val();
    var address = $('#address').val();
    var fees = $('#fees').val();
    var mobile = $('#mobile').val();
    var age = $('#student_age').val();
    var birth_date = $('#birth_date').val();
    var flag = 0;
    
    document.getElementById("p1").innerHTML="";
    document.getElementById("p2").innerHTML="";
    document.getElementById("p3").innerHTML="";
    document.getElementById("p4").innerHTML="";
    document.getElementById("p5").innerHTML="";
    document.getElementById("p6").innerHTML="";
    document.getElementById("p7").innerHTML="";
    
    if(fname=="")
    {
        $('#p1').text("* first Name must be filled out*");
        $("#firstname").focus();
        flag = 1;
    }
    else if(!fname.match(name_regex))
    {
        $('#p1').text("* first Name must contain alphabet*");  //segment Display validation rule for name
        $("#firstname").focus();
        flag = 1;
    }
    
    if(lname=="")
    {
        $('#p2').text("* Last Name must be filled out*");
        flag = 1;
    }
    else if(!lname.match(name_regex))
    {
        $('#p2').text("* Last Name must contain alphabet*");   //segment Display validation rule for name
        $("#lastname").focus();
        flag = 1;
    }
     
    if(address=="")
    {
        $('#p3').text("* Address must be filled out*");
        flag = 1;
    }
    else if(!address.match(add_regex))
    {
        $('#p3').text("* Address must contain alphabet or Number*");   //segment Display validation rule for name
        $("#address").focus();
        flag = 1;
    }
     
    if(fees=="")
    {
        $('#p7').text("* Fees must be filled out*");
        flag = 1;
    }
    else if(!fees.match(fees_regex))
    {
        $('#p7').text("* Fees must contain Number*");   //segment Display validation rule for name
        $("#fees").focus();
        flag = 1;
    }
     
    if(mobile=="")
    {
        $('#p6').text("* mobile number must be filled out*");
        flag = 1;
    }
    else if(!mobile.match(ph))
    {
        $('#p6').text("* mobile must contain numbers *");   //segment Display validation rule for name
        $("#mobile").focus();
        flag = 1;
    }
     
    if(age=="")
    {
        $('#p5').text("* Age must be filled out*");
        flag = 1;
    }
    else if(!age.match(fees_regex))
    {
        $('#p5').text("* Age must contain Numbers*");   //segment Display validation rule for name
        $("#student_age").focus();
        flag = 1;
    }
     
    if(birth_date=="")
    {
        $('#p4').text("* Birth date must be filled out*");
        flag = 1;
    }
    
    if(flag == 1)
    {
        return false;
    }
    else
    {
        return true;        
    }
}
</script>
         
            
   
