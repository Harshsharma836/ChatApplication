<?php
	include_once 'Connection.php';
	
	$fname= $lname = $email = $password = $phone = $image = $role = "";
		$flag = false;
		
	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$response = array();

		if(empty($_POST["fname"])) {	
	        //$response['fname'] = 'firstname is required';
	        $flag = true;
	    }
	    else {
	        $fname= ($_POST["fname"]);
	    }

	    if(empty($_POST["lname"])) {
	    	//$response['lname'] = 'lname is required';
	    	$flag = true;
	    }
	    else {
	        $lname = ($_POST["lname"]);
	    }

	    if(empty($_POST["email"])) {	      
	    	//$response['email'] = 'email is required';
	    	$flag = true;
	    }
	    else {
	        $email= ($_POST["email"]);        
	    }

	    if(empty($_POST['password'])) {	    	
	    	//$response['password'] = 'password is required';
	    	$flag = true;
	    }
	    else{
	    	$password = ($_POST['password']);
	    }

	    if(empty($_POST['phone'])) {	    	
	    	//$response['phone'] = 'phone is required';
	    	$flag = true;
	    }
	    else{
	    	$phone = ($_POST['phone']);
	    }

	}	    
	
	if(empty($fname) || empty($lname) || empty($email) || empty($password))  {
		$flag = true;
		$response['status']='';
	}
	else {

			error_reporting(E_ALL);
			ini_set("display_errors",1);
		
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$role = $_POST['role'];
			$status = 1;

			// Image Sending 
			$targetDir = "/xampp/htdocs/StudentResultManagmentSystem/images";
            $fileName=$_FILES["image"]["name"];
            $targetFilePath = $targetDir.$fileName;
            $fileType = pathinfo($targetFilePath ,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg');

			// Checking email exist or not
			$result = $obj1->connreturn();
			$sqlcheck = "select email from registration where email = '".$email."' ";

			$query=mysqli_query($result,$sqlcheck);
		
			if($query->num_rows != 0) {	
				$response['email'] = 'email is already exist';
			} 
			
			elseif($flag == false) {

				// Inserting data into student table
				if(in_array($fileType, $allowTypes)){
            
		            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
		                	// Insert image file name into database
		                	$obj1->insert('registration',['fname'=>$fname,'lname'=>$lname,'email'=>$email,'password'=>$password,'phone'=>$phone,'image'=>$fileName,'role'=>$role,'status'=>$status]);
		               		$resultsql = $obj1->getResult();

						if($resultsql) {
							$response['status']='Data is successfullly  inserted';
							$response['empty']='';
						}
		            }
            	}  
			}
	}		
	echo json_encode($response);
?>
