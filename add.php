<?php
	require 'database.php';
	$name = trim(htmlspecialchars($_POST["name"]));
	$day = trim(htmlspecialchars($_POST["day"]));
	$month = trim(htmlspecialchars($_POST["month"]));
	$cats = trim(htmlspecialchars($_POST["cat"]));
	$row = array();
	$db = new Database();
	if (!$name=="" || !$day=="" || !$month=="" || !$cats=="") {
		$db->exec("INSERT INTO todos VALUES (NULL,\"" . $name . "\",\"" . $day . " " . $month . "\",\"" . $cats . "\");");
	}
	$result = $db->query("SELECT * FROM todos");
	$i = 0;
	while($res = $result->fetchArray(SQLITE3_ASSOC)){
		if(!isset($res['idno'])) continue;
		$row[$i]['idno'] = $res['idno'];
		echo $row[$i]['idno'] . " ";
		$row[$i]['name'] = $res['name'];
		echo $row[$i]['name'] . " ";
		$row[$i]['dat'] = $res['dat'];
		echo $row[$i]['dat'] . " ";
		$row[$i]['cats'] = $res['cats'];
		echo $row[$i]['cats'] . " ";
		echo "<br>";
		$i++;
	}
	header("Location: index.php");
	//print_r($row);
?>
