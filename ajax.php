<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

include "Connection.php";
	
	extract($_POST);

  $obj = new Connection("localhost","root","","harshchatbox");
 	$result = $obj->connreturn();

 	$id=$result->real_escape_string($id);
	$status=$result->real_escape_string($status);

    // Updating the Status of User.
    $sql = "UPDATE registration SET status = '$status' WHERE id = '$id'";

    if(!$res=mysqli_query($result,$sql)){  	
        echo "Query Execution Failed";
    }
    else{
      	echo "Successfully completed";
    }

?>
