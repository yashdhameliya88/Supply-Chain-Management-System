<?php

//	$conn = mysqli_connect("localhost","root","","test") or die("Connection failed");
        include './sqlConnection.php';

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM tblstate";

		$query = mysqli_query($connect,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['stateId']}'>{$row['stateName']}</option>";
		}
	}else if($_POST['type'] == "cityData"){

		$sql = "SELECT * FROM tblcity WHERE stateId = {$_POST['id']}";

		$query = mysqli_query($connect,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['cityId']}'>{$row['cityName']}</option>";
		}
	}

	echo $str;
 ?>