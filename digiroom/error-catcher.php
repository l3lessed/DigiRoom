<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

//Assigns normal variables.
$_SESSION['errormsg'];

$_SESSION['errormsg'] = 'test';
?>
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		 <link rel="stylesheet" type="text/css" href="style.css">
        <title>Sean's Submission Software 1.0</title>
    </head>

<html>
<Center>
<div id="contain" class="menu">
<ul>
<li><a href="">Home</a></li>
<li><a href="">News</a></li>
<li><a href="">Contact</a></li>
<li><a href="">About</a></li>
</ul>
</div>

<body>
<div id="content" class="page" style="background-color:#F2DDDC;color:red;" div align="left">

<div id="footer"  class="footer" style="width:150px;float:right;background-color:#E6B9B8;">
<I> Beta: Under revisions</I>
</div>

<Div style="border-bottom-style:solid;border-bottom-width:1px;border-color:red;"><font size=5px><B>Error Catcher</font></B></div>
<Font size=4px>
<P>
Readout: <?php echo $_SESSION['errormsg'] ?>
</div>
</font>
</Center>
</body>
</html>

</div>
</body>
</html>