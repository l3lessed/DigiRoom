<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

ini_set('display_errors', 'off');
error_reporting(E_ALL | E_STRICT);

//Assigns normal variables.
if (!isset($_POST['run'])) 
{
//If not isset -> set with dumy value 
$_POST['run'] = "undefine"; 
}

$tmpfile = $_SESSION['tmpfile'];
$tmpdir = $_SESSION['tmpdir'];
$date = date_format(date_create(), 'Y m_d H-i-s');
$newname = $_SESSION['lname'] . "_" .  $_SESSION['fname'] . " " . $_SESSION['type'] . " " . $date . "." . $_SESSION['fileInfo']['extension'];
$newfile = $newname;
$uploaddir = "School Work/Tech Writing, Engl 149/Quarters/Spring 2016/" . $_SESSION['section'] . "/" . $_SESSION['packet'];
	
//Calls dropbox uploading software.
error_reporting(E_ALL);
require_once("DropboxClient.php");

//Grants access to Sean's Uploader app (https://www.dropbox.com/developers/apps):
$dropbox = new DropboxClient(array(
	'app_key' => "jxvrsvjd2sj01bj", 
	'app_secret' => "i4pqro3jkgfe9wu",
	'app_full_access' => true,
),'en');

handle_dropbox_auth($dropbox); // see below
// Functions to handle tokens (handle_dropbox_auth is required to access Sean's Uploader).
// store_token, load_token, delete_token are SAMPLE functions! please replace with your own!
function store_token($token, $name)
{
	file_put_contents("tokens/$name.token", serialize($token));
}

function load_token($name)
{
	if(!file_exists("tokens/$name.token")) return null;
	return @unserialize(@file_get_contents("tokens/$name.token"));
}

function delete_token($name)
{
	@unlink("tokens/$name.token");
}
// ================================================================================

function handle_dropbox_auth($dropbox)
{
	// first try to load existing access token
	$access_token = load_token("access");
	if(!empty($access_token)) {
		$dropbox->SetAccessToken($access_token);
	}
	elseif(!empty($_GET['auth_callback'])) // are we coming from dropbox's auth page?
	{
		// then load our previosly created request token
		$request_token = load_token($_GET['oauth_token']);
		if(empty($request_token)) die('Request token not found!');
		
		// get & store access token, the request token is not needed anymore
		$access_token = $dropbox->GetAccessToken($request_token);	
		store_token($access_token, "access");
		delete_token($_GET['oauth_token']);
	}

	// checks if access token is required
	if(!$dropbox->IsAuthorized())
	{
		// redirect user to dropbox auth page
		$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
		$auth_url = $dropbox->BuildAuthorizeUrl($return_url);
		$request_token = $dropbox->GetRequestToken();
		store_token($request_token, $request_token['t']);
		die("Authentication required. <a href='$auth_url'>Click here.</a>");
	}
}

//checks to insure the file is readable.
if (is_readable($tmpdir . $tmpfile)) {
    $readable = "<font color=#347C17>Yes</font>";
} else {
    $readable = "<font color='red'>No</font>";
	header("refresh:20;url=index.php" );
	exit('You file isn\'t readable. Insure the file is saved and all programs using it are fully shut down.' . "\n" . 'You\'ll be redirected to the <a href="index.php">submission page</a> in 20 seconds or click the hyperlink now.');
}


if(is_file($tmpdir . $tmpfile)) {
	$verifyfile = "<font color=#347C17>Yes</font>";
	} else {
	 $verifyfile = "<font color='red'>No</font>";
	 header("refresh:20;url=index.php" );
	exit('You file isn\'t verifiable. Insure the file is saved and all programs using it are fully shut down.' . "\n" . 'You\'ll be redirected to the <a href="index.php">submission page</a> in 20 seconds or click the hyperlink now.');
	}

//function to run upload program.
if($_POST['run'] and $_SERVER['REQUEST_METHOD'] == "POST"){
	try {
		// renames and moves temp uploaded file.
		rename ($tmpdir . $tmpfile, $tmpdir . $newfile);
		
		// Enter your Dropbox account credentials here

			$dropbox->UploadFile($tmpdir . $newfile, $uploaddir);

			echo '<span style="color: green;font-weight:bold;margin-left:393px;">File successfully uploaded to my Dropbox! </span>' ;
		} catch(Exception $e) {
			echo '<span style="color: red;font-weight:bold;margin-left:393px;">Error: ' . htmlspecialchars($e->getMessage()) . '</span>';
		}

		// Clean up user uploaded files
		unlink($tmpdir . $tmpfile);
		unlink($tmpdir . $newfile);
		rmdir($tmpdir);
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
  <td>First Name:</td>
  <td><?php Echo $_SESSION['fname'];?></td>		
 </tr>
<tr>
  <td>Last Name:</td>
  <td><?php Echo $_SESSION['lname'];?></td>		
</tr>
<tr>
  <td>Section:</td>
  <td><?php Echo $_SESSION['section'];?></td>		
</tr>
<tr>
  <td>Packet Number:</td>
  <td><?php Echo $_SESSION['packet'];?></td>		
 </tr>
<tr>
<tr>
  <td>Packet Type:</td>
  <td><?php Echo $_SESSION['type'];?></td>		
</tr>
<tr>
  <td>Original File:</td>
  <td><?php Echo $_SESSION['file_display'];?></td>		
</tr>
<tr>
  <td>File Type: </td>
  <td><?php Echo $_SESSION ['fileInfo']['extension'];?></td>		
</tr>
<tr>
  <td>Temp. File Name:</td>
  <td><?php Echo $_SESSION['tmpfile'];?></td>		
</tr>
<tr>
  <td>Temp Directory:</td>
  <td><?php Echo $tmpdir;?></td>		
</tr>
<tr>
  <td>New File Name:</td>
  <td><?php Echo $newname;?></td>		
</tr>
<tr>
  <td>File Readable:</td>
  <td><?php Echo $readable;?></td>		
</tr>
<tr style="border-bottom-style:solid;">
  <td>File Verified:</td>
  <td><?php Echo $verifyfile;?></td>		
</tr>
</table>

<div id="Submit" style="padding-top:15px;">
<FORM Method="post">
<input type="submit" class="button" name="run"  value="Yes, Turn in Work Packet!"/>
</form>
</div>
</div>
</body>
</html>