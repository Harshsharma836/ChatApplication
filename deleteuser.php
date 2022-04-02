<?php
	include_once 'Connection.php';
	include "header.php";
	
	$id = $_GET['id'];
	echo $id;
	    
	$obj = new Connection("localhost","root","","harshchatbox");
	     
	$obj->delete('registration',"id = $id"); // Deleting User by id.
	   
	echo "Data is deleted";
	header("location:adminDashboard.php");
?>
