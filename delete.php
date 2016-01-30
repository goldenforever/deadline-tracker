<?php
	require 'database.php';
	$id = $_GET["id"];
	$db = new Database();
	$db->exec("DELETE FROM todos WHERE idno = " . $id . ";");
	header("Location: index.php");
	//print_r($row);
?>
