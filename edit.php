<?php
session_start();
?>

<?php
    $pageTitle = 'Info Edit';
    include "header.php";
    include "Connection.php";

    // Php validation
    $fname= $lname = $phone =$email  = $file = $role  = "";
    $fnameError = $lnameError = $emailError = $fileError = $phoneError = $passwordError =     $roleError= "";
    $flag = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["fname"])) {
            $fnameError = "first name is required";
            $flag = true;
        } 
        else 
        {
            $fname = ($_POST["fname"]);
        }

        if (empty($_POST["lname"])) {
            $lnameError = "lastname is required";
            $flag = true;
        } 
        else 
        {
            $lname= ($_POST["lname"]);
        }

        if (empty($_POST["email"])) {
            $emailError = "email is required";
            $flag = true;
        }
        else {
            $email = ($_POST["email"]);
        }

        if (empty($_POST["phone"])) {
            $phoneError = "phone is required";
            $flag = true;
        }
        else {
            $phone = ($_POST["phone"]);
        }

        if (empty($_POST["password"])) {
            $passwordError = "Password is required";
            $flag = true;
        }
        else {
            $password = ($_POST["password"]);
        }

        if (empty($_POST["role"])) {
            $roleError = "role is required";
            $flag = true;
        }
        else {
            $role = ($_POST["role"]);
        }
    }   


    if(isset($_GET['id'])){

        $id =  $_GET['id'];

        $obj = new Connection("localhost","root","","harshchatbox");
        $result = $obj1->connreturn();

        $sql = "select * from registration where ID = '$ID' ";
        $res = mysqli_query($result,$sql);

        $row_user = mysqli_fetch_assoc($res);
        
        $fname = $row_user["fname"];
        $lname = $row_user["lname"];
        $email = $row_user["email"];
        $password = $row_user["password"];
        $phone = $row_user["phone"];
        $role = $row_user["role"];
    }

?>
<div>
<div>
<h4><b>Edit Yours Data</b></h4>
<form id="form" method="post" enctype="multipart/form-data" >
    
    <div>
        <div>
            <label for="name"><b>Name</b></label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your name"
                value="<?php echo $fname?>">
            <span style="color: red"><?php echo $fnameError;?></span>     
        </div>

        <div>
            <label for="lastname"><b>LastName</b></label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter your last name"
                value="<?php echo $lname?>">
            <span style="color: red"><?php echo $lnameError;?></span>     
        </div>

        <div>
            <label for="file"><b>Profile Image</b></label>
            <input type="file" name="file" id="file" required="Profile image is require">
        </div>

        <div>
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                value="<?php echo $email?>">
            <span style="color: red"><?php echo $emailError;?></span>     
        </div>
        
         <div>
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter the password"
                value="<?php echo $password?>">
            <span style="color: red"><?php echo $passwordError;?></span>     
        </div>

        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="123-45-678" value="<?php echo $phone ?>"> 
            <span style="color: red"><?php echo $phoneError;?></span>
        </div>

        <div class="form-group">
        <label for="role">Roles:</label>
            <select name="role" id="role">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select> 
        </div>

        <div>
            <input type="submit" id="submit" name="submit" class="btn btn-success" value="submit">
        </div>
</form>
</div>
</div>

<?php

    $fileName = "";
    if($flag == false){

        if(isset($_POST['submit'])){

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $status = 1;

            $targetDir = "/var/www/html/oct-batch/harsh/regirstrationFormMain/image/";
            $fileName=$_FILES["file"]["name"];
            $targetFilePath = $targetDir.$fileName;
            $fileType = pathinfo($targetFilePath ,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg');

            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

                    // Insert image file name into database
                    $obj->update('registration',['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone,'password'=>$password,'image'=>$fileName,'status'=>$status,'role'=>$role],"id = $id");

                    if($obj){
                        echo "Data is inserted";
                        header("location:myaccountstudent.php");
                    }
                    else{
                        echo "Failed";
                    }
                }
            }    
        }
    }

?>
<div>
    <button onclick="window.location.href='studentDashboard.php';" class="btn btn-primary">Back to Home Page</button>
</div>

<?php include('footer.php');  ?>  <!-- Including fotter file -->