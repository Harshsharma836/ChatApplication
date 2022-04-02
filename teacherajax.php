<?php

    include_once('Connection.php');
    $senderid = $receiverid = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

		$response = array();

		if(empty($_POST["senderid"])) {	
	        $flag = true;
	    }
	    else {
	        $senderid= ($_POST["senderid"]);
	    }

	    if(empty($_POST["recieverid"])) {
	    	$flag = true;
	    }
	    else {
	        $recieverid = ($_POST["recieverid"]);
	    }
	}    
	    $result = $obj1->connreturn();
            $sql = "select * from messages where senderid='".$senderid."' and receiverid ='".$receiverid."' or senderid='".$receiverid."' and receiverid ='".$senderid."'     ";
           print_r($sql);
           die; 

?>