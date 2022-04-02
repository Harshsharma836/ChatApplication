<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $emailerr = "";
    include("Connection.php");
    $email=$_POST['email'];
    $flag=false;

    // Checking email is enter or not
    if(isset($email)) {        
        
        if(empty($email)) {

            $emailerr="<li>Email can't be null</li>";
            $flag = true;         
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //echo"Invalid email format<br>"; 
            $emailerr = "<li>Invalid email format</li>";
            $flag = true;
        }
    }

    $errMsg=array("emailerr"=>$emailerr);
    
    if($flag == true) {  

        echo json_encode($errMsg);
    }

    if($flag == false) {

        $sql = "SELECT * from registration where email = '".$email."';";
        $obj = new Connection("localhost","root","","harshchatbox");
        $result = $obj1->connreturn();
        $res=mysqli_query($result,$sql);
        
        $rows = mysqli_num_rows($res);

        $dbdata = mysqli_fetch_assoc($res);
        if($rows)
        {
            echo json_encode(array("state"=>"1"));
        }
        else {
            echo json_encode(array("state"=>"0"));
        }
    }
?>