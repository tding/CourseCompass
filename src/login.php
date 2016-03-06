<?php
	session_start();
	require("connection/db.php");
	$obj = new db();
	var_dump($obj->select("SELECT * FROM Student"));
	var_dump("test");
?>
