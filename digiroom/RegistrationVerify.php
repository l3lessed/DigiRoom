<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
//MySQL Database Variables: NEED TO MOVE TO INI FILE FOR SECURITY.
$servername = "sql306.cuccfree.com";
$username = "cucch_14583318";
$password = "4VHXvBY1BpJd";
$dbname = "cucch_14583318_Winter_2015";
//routine variables: NEED TO FIND A WAY TO SECURE SESSION VARIABLES.
$studentid = $_SESSION['studentid'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$section = $_SESSION['section'];
$email = $_SESSION['email'];
//run code when verify is clicked.
if ($_POST) {
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {	
		//prepares $sql insertion code for student information.
		$sql = $conn->prepare("INSERT INTO Students (FirstName, LastName, Email, StudentID, Section)
		VALUES ('$firstname', '$lastname', '$email', '$studentid', '$section')");
		//executes and verifies prepared $sql code
		if ($sql->execute() === TRUE) {
			echo "New record created successfully:";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		//Closes $sql prepared code and $conn server connection.
		$sql->close();
		$conn->close();
	}
}
?>
<html>
<head>
<style>
.center{
	margin:auto;
	width:70%;
	background-color:#D0D0D0;
}

.h1{
	font-size:35px;
	text-align:Center;
}

table, th, td{
	border:1px;
	border-collapse:collapse;
}
td {
	border-top-style:dashed;
	border-bottom-style:dashed;
	padding-top:3px;
	padding-bottom:3px;
}

td:nth-child(odd) {
    width:125px;
	font-weight:bold;
}

tr:nth-child(even) {
    background-color: #E6E6FA;
}

tr:nth-child(odd) {
    background-color: #99CCFF;
}
</style>

<body>
<div id="readout" class="center" style="border-top-style:solid;border-bottom-style:solid;border-width:1px;width:550;height:auto;" div align="left">
<div class="h1" style="border-bottom-style:solid;">
	Is The Below Information Correct?
</div>
<table id="ReadoutDisplay" style="width:550px">
<tr style="border-top-style:hidden;">
  <td>Student ID:</td>
  <td><?php Echo $_SESSION['studentid'];?></td>		
 </tr>
<tr>
  <td>First Name:</td>
  <td><?php Echo $_SESSION['firstname'];?></td>		
 </tr>
<tr>
  <td>Last Name:</td>
  <td><?php Echo $_SESSION['lastname'];?></td>		
</tr>
<tr>
  <td>Section:</td>
  <td><?php Echo $_SESSION['section'];?></td>		
</tr>
<tr>
  <td>Email:</td>
  <td><?php Echo $_SESSION['email'];?></td>		
 </tr>
<tr>
</table>

<div id="Submit" style="padding-top:15px;">
<FORM Method="post">
<input type="submit" class="button" name="run"  value="Yes, Register Me for DigiRoom!"/>
</form>
</div>
</div>
</body>
</html>