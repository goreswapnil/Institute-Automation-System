<?php
require_once("db6.php");
class crud
{
    public $id;
    
    //function for inserting record in to database
    public function insert($studentArr)
    {
        $fname=$studentArr['fname'];
        $lname=$studentArr['lname'];
        $address=$studentArr['address'];
        $mobile=$studentArr['mobile'];
        $age=$studentArr['age'];
        $dob=$studentArr['dob'];
        $gender=$studentArr['gender'];
        $std=$studentArr['batch'];
        $fees=$studentArr['fees'];
        $profile=$_FILES["profilepic"]["name"];
        $filename = NULL;
        
        if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"]))
        {
            $target_dir = "uploads/";
            $imageFileType = pathinfo($_FILES["profilepic"]["name"],PATHINFO_EXTENSION);
            $allowedExtArr = array('gif','png','jpg','jpeg');
            
            //Check if image file is actual image or fake image
            if(!in_array($imageFileType,$allowedExtArr))
            {
                $errorMsg .= "Please Select png,gif,jpg,jpeg Files only.";
            }
            if($profile)
            {
                $fileName = "photo_" . time().".".$imageFileType;
                $target_dir .= $fileName;
                if(!move_uploaded_file($_FILES["profilepic"]["tmp-name"], $target_dir))
                {
                    $errorMsg .= "Error in uploading file,";
                }
            }
        }
        
        
    $sql = "INSERT INFO 'student'('fname','lname','gender','batch','address','mobile','age','dob','profilepic','fees') VALUES(:fname,:lname,:gender,:batch,:address:,:mobile,:age,:dob,:profilepic,:fees)";
        
        $db = db::getinstance();
        $result = $db->prepare($sql);
        
        $pdoresult = $result->execute(array(":fname"=>$fname,
                                            ":lname"=>$lname,
                                            ":gender"=>$gender,
                                            ":batch"=>$std,
                                            ":address"=>$address,
                                            ":mobile"=>$mobile,
                                            ":age"=>$age,
                                            ":dob"=>$dob,
                                            ":fees"=>$fees,
                                            ":profile"=>$target_dir
                                           ));
        if($pdoresult)
        {
            $lastid = $db->lastInsertId();
            $this->id = $lastid;
        }
    }
    
    //function for view the record on viewresult page
    
    public function view($id)
    {
        $sql ="SELECT * FROM 'student' WHERE id = $id";
        $db = db::getinstance();
        $result =$db->prepare($sql);
        $pdoresult = $result->execute();
        $result =$result->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    //function for view all record on studentlist page
   public function viewall()
    {
        $sql ="SELECT * FROM 'student' WHERE 1";
        $db = db::getinstance();
        $result =$db->prepare($sql);
        $pdoresult = $result->execute();
        $result =$result->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    //function for upadate the record on studentlist page
    
    public function update($studentArr,$id,$oldimage) 
    {
        $fname=$studentArr['fname'];
        $lname=$studentArr['lname'];
        $address=$studentArr['address'];
        $mobile=$studentArr['mobile'];
        $age=$studentArr['age'];
        $dob=$studentArr['dob'];
        $gender=$studentArr['gender'];
        $std=$studentArr['batch'];
        $fees=$studentArr['fees'];
        
        if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"]))
        {
            //parent if start
            
            $target_dir = "uploads/";
            $imageFileType = pathinfo($_FILES["profilepic"]["name"],PATHINFO_EXTENSION);
            $allowedExtArr = array('gif','png','jpg','jpeg');
            
            //Check if image file is actual image or fake image
            if(!in_array($imageFileType,$allowedExtArr))
            {
                $errorMsg .= "Please Select png,gif,jpg,jpeg Files only.";
            }
            if($_POST['fname'])
            {
                $fileName = "photo_" . time().".".$imageFileType;
                $target_dir .= $fileName;
                if(!move_uploaded_file($_FILES["profilepic"]["tmp-name"], $target_dir))
                {
                    $errorMsg .= "Error in uploading file,";
                }
            }
        }
        else
        {
            $target_dir = $oldimage;
        }
        
        $db = db::getinstance();
        
        $sql1 = "UPDATE student SET fname='$fname',lname='$lname',gender='$gender',batch='$std',address='$address',moblie='$mobile','age='$age',dob='$dob',profilepic='$target_dir',fees='$fees' where id = $id";
        
        $result =$db->prepare($sql1);
        $pdoresult = $result->execute();
        $last_id = $db->lastInsertId();
        $this->id=$last_id;
        
        if($pdoresult)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function viewdata($fname)
    {
        $sql ="SELECT * FROM 'student' WHERE fname LIKE '%$fname%'";
        $db = db::getinstance();
        $result =$db->prepare($sql);
        $pdoresult = $result->execute();
        $result =$result->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    function getAllStudent($fName = "")
    {
        $db = db::getinstance();
        $whereClause ="";
        $sql = "SELECT * FROM student";
        
        if($fName != "")
        {
            $sql .= "where fname LIKE '%$fName%'";
        }
        else
        {
            $sql .= "whwere 1";
        }
        
        $recordset = $db->prepare($sql);
        $recordset->execute();
        return $recordset;
    }
}
?>
    