<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		 <link rel="stylesheet" type="text/css" href="style.css">
        <title>Sean's Submission Software 1.0</title>
    </head>

<?php
date_default_timezone_set('America/Los_Angeles');
session_start(); 
//normal variables
$id = uniqid('tmp_', true);

//session variables
$_SESSION['file_display'] = $_FILES['file']['name'];
$_SESSION['fileInfo'] = pathinfo($_FILES["file"]["name"]);
$_SESSION['tmpdir'] = 'upload/Dir_' . $id . '/';

//runs following code when submit button posts
if ($_POST) {
	//checks for temporary folder for use. Creates it using uniqid generated.
	if (!file_exists($_SESSION['tmpdir'])) {
		mkdir('upload/Dir_' . $id);
		} 
	//insures proper fields are filled or warns user if not.
	if (!file_exists($_SESSION['tmpdir'])) {
		echo ' I could not make a folder for your packet.';
	} elseif ($_POST['fname'] == "") {
		echo ' I need your first name to rename the file for you.';
	} elseif ($_POST['lname'] == "") {
		echo $_POST['fname'] . ' I need your last name to rename the file for you.';
	} elseif ($_POST['section'] == "") {
		echo $_POST['fname'] . ' I need your class section to insure your packet gets to the proper folder.';
	} elseif ($_POST['packet'] == "") {
		echo $_POST['fname'] . ' I need the work packet number to insure your packet gets to the proper folder.';
	//Posts user input to session variable and moves user selected file into created tmp directory for future use by verify.php
	} elseif (move_uploaded_file($_FILES['file']['tmp_name'], $_SESSION['tmpdir'] . $id . '.' . $_SESSION['fileInfo']['extension'])){
		$_SESSION['fname'] = $_POST['fname'];
		$_SESSION['lname'] = $_POST['lname'];
		$_SESSION['section'] = $_POST['section'];
		$_SESSION['packet'] = $_POST['packet'];
		$_SESSION['type'] = $_POST['type'];
		$_SESSION['tmpfile'] = $id . '.' . $_SESSION['fileInfo']['extension'];
		header('Location: verify.php');    
	} else {
		echo 'I could not transfer the file to Sean\'s archive. Insure the document was selected, is in the same location, has the same name, and it\'s saved and the word processing software is closed.';
	}
}
?>

<!--Sets Background Color and Net Nuetrality Widget-->
<body bgcolor="#D3DFEE">

<!--Center align all div boxes-->
<Center>

<!--Menu div-->
<div id="contain" class="menu">
<ul>
<li><a href="https://polylearn.calpoly.edu/AY_2014-2015/">Polylearn</a></li>
<li><a href="mailto:Mountain.man.maddox@gmail.com?Subject=English 149 Email" target="_top"">Contact Me</a></li>
</ul>
</div>

<!--Body div.-->
<body>
<div id="content" class="page" div align="left">

<!--Beta widget div.-->
<div id="footer" style="background-color:#98bf21;text-align:center;border-style:solid;border-width:1px;line-height:20px;width:150px;float:right;">
<I> Beta: Under revisions</I>
</div>

<!--Header div.-->
<Div style="border-bottom-style:solid;border-bottom-width:1px;"><font size =5px><B>English 149 Turn In Area</B></font size></div>

<!--Body content: directions & submission options-->
<P>
<font size=4px><U><Font Color = "Red">*WARNING: ENSURE BELOW REQUIREMENTS ARE MET*</font color></U></font size>
<P>
<B>1. All answers are in the same file/packet.</B>
<P>
<B>2. The packet is in a word friendly format or a PDF.</B>
<P>
<B>3. Insure the file is saved and all programs using it are completely closed out.</B>
<P>
<b>Failure to do so could result in a submission error and/or an ignored grade for the packet.</b>
<hr>
<form method="POST" enctype="multipart/form-data">
<U><B>Select your class section and the packet number.</B></U><BR>
Class Section:
<select name="section">
  <option value="">Select Your Class Section</option>
  <option value="Section 02">Section 02 (7:10 - 9:00)</option>
  <option value="Section 03">Section 03 (10:10 - 12:00)</option>
  <option value="Section 27">Section 27 (8:10 - 10:00)</option>
</select>
<br>
Packet Number:
<select name="packet">
  <option value="">Select...</option>
  <option value="Work Packet 1">Work Packet 1</option>
  <option value="Work Packet 2">Work Packet 2</option>
  <option value="Work Packet 3">Work Packet 3</option>
  <option value="Work Packet 4">Work Packet 4</option>
  <option value="Work Packet 5">Work Packet 5</option>
  <option value="Work Packet 6">Work Packet 6</option>
  <option value="Work Packet 7">Work Packet 7</option>
  <option value="Work Packet 8">Work Packet 8</option>
  <option value="Work Packet 9">Work Packet 9</option>
  <option value="Work Packet 10">Work Packet 10</option>
  <option value="Work Packet 11">Work Packet 11</option>
  <option value="Optional Work Packet">Optional Work Packet</option>
  <option value="Tips Guide">In Class Game Manual</option>
  <option value="Game Notes">Individual Game Notes</option>
  <option value="Market Report">Market Report</option>
  <option value="Course Feedback">Course Feedback</option>
</select>
<P>
<U><B>Select the type of work packet your submitting; if its on time, late, or a revised work packet.</B></U><BR>
Packet Type:
<select name="type">
<option value="On_Time">On Time</option>
<option value="Late">Late</option>
<option value="Revised">Revised</option>
</select>
<p>
<U><B>Insert your first and last name into the form below.</B></U><BR>
		First Name: <input type="text" name="fname"><br>
		Last Name: <input type="text" name="lname"><br>
		<input type="file" name="file" /><br>
		<input type="submit" value="Verify Your Packet" />
</form>
</div>

</Center>
</body>
</html>

</div>

</body>
</html>
			