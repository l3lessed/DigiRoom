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

//session variables

//runs following code when submit button posts
if ($_POST) {
//Check if fields are filled
	if ($_POST['firstname'] == NULL) {
		echo ' I need your first name to rename the file for you.';
	} elseif ($_POST['lastname'] == NULL) {
		echo $_POST['firstname'] . ' I need your last name to rename the file for you.';
	} elseif ($_POST['section'] == NULL) {
		echo $_POST['firstname'] . ' I need your class section to insure your packet gets to the proper folder.';
	} elseif ($_POST['section'] == NULL) {
		echo $_POST['firstname'] . ' I need the work packet number to insure your packet gets to the proper folder.';
	} elseif ($_POST['email'] == NULL) {
		echo $_POST['firstname'] . ' I need the work packet number to insure your packet gets to the proper folder.';
	} elseif ($_POST['studentid'] == NULL) {
		echo $_POST['firstname'] . ' I need the work packet number to insure your packet gets to the proper folder.';
	//Posts user input to session variable and moves user selected file into created tmp directory for future use by verify.php
	} else {
		$_SESSION['studentid'] = $_POST['studentid'];
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['lastname'] = $_POST['lastname'];
		$_SESSION['section'] = $_POST['section'];
		$_SESSION['email'] = $_POST['email'];
		header('Location: RegistrationVerify.php');    
	} 
}
?>

<!--Sets Background Color and Net Nuetrality Widget-->
<body bgcolor="#D3DFEE">
<div style="float:right"><script src="//fightforthefuture.github.io/countdown-widget/widget.min.js"></script></div>

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
<Div style="border-bottom-style:solid;border-bottom-width:1px;"><font size =5px><B>English 149 Registration</B></font size></div>

<!--Body content: directions & submission options-->
<P>
<b>Insert in and verify your course information.</b>
<hr>
<form method="POST" enctype="multipart/form-data">
<U><B>Select your class section and the packet number.</B></U><BR>
Class Section:
<select name="section">
  <option value="">Select...</option>
  <option value="Section 13">Section 13 (2:10 - 3:00)</option>
  <option value="Section 14">Section 14 (4:10 - 5:00)</option>
  <option value="Section 15">Section 15 (5:10 - 6:00)</option>
</select>
<br>
<U><B>Insert your first and last name into the form below.</B></U><BR>
		First Name: <input type="text" name="firstname"><br>
		Last Name: <input type="text" name="lastname"><br>
		Student ID: <input type="text" name="studentid"><br>
		Email: <input type="text" name="email"><br>
		<input type="submit" value="Verify Registration" />
</form>
</div>

</Center>
</body>
</html>

</div>
</body>
</html>
			