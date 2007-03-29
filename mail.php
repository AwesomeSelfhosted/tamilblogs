<!--Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

tamilblogs is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

tamilblogs is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License 2.0 for more details.

You should have received a copy of the GNU General Public License
along with tamilblogs; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/1">
    <title>தமிழ்ப் பதிவுகள்</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <link rel="stylesheet" type="text/css" href="style/default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style/tabs.css" media="screen"/>	
    <link rel="stylesheet" type="text/css" href="style/mobile.css" media="handheld" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <!--<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php/cfcd208495d565ef66e7dff9f98764da/0.xml">-->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php">
    <script language="JavaScript" type="text/javascript">
    <!--
        var showDetails = false;
        var markID = '' ;
    //-->
    </script>
    <script language="JavaScript" type="text/javascript" src="js/engine.js"></script>
</head>
<body onLoad="visible_mode(showDetails)">

<div id="navigation">
<form method="post" action="index.php" class="login">

Login
<img src="img/users.png" alt="user" /> <input type="text" name="u" />
<img src="img/password.png" alt="password" /> <input type="password" name="p" />
<input type="submit" value="Login" />
</form>
<a href="index.php"><img src="img/logo.gif" alt="தமிழ்ப் பதிவுகள்" /></a> <img src="img/spacer.gif" width="5" height="1" alt="" /><a href="rss.php"><img src="img/rss_feed.gif" alt="RSS செய்தியோடை" title="RSS செய்தியோடை" /></a> &nbsp; 
| <a href="sources.php">பதிவுகளின் பட்டியல்</a></div>
<div id="main"><h1>Blog submission done... </h1>
<br>
<?php
function checkOK($field)
{
if (eregi("\r",$field) || eregi("\n",$field)){
die("Invalid Input!");
}
}

$name=$_POST['name'];
checkOK($name);
$email=$_POST['email'];
checkOK($email);
$blogurl=$_POST['blogurl'];
checkOK($blogurl);
$to="mugunth@gmail.com";
$message="$name just sent his blog submission. Their blog url is:\n $blogurl\n\nTheir e-mail address was: $email";

if(mail($to,"Blog submission for tamilblogs.com",$message,"From: $email\n")) {
echo "<html> உங்கள் வலைப்பதிவை அளித்தமைக்கு நன்றி!. உங்கள் வலைப்பதிவை பார்வையிட்டு தமிழ்புளாக்ஸ்.காம் தளத்திற்கு உகந்ததாக இருப்பின் விரைவில் திரட்டியில் இணைத்துவிடுகிறோம். <br><br>";
echo "மீண்டும் தமிழ்ப்பதிவுகள் திரட்டிக்கு செல்ல <a href=\"index.php\">  இங்கே சொடுக்கவும்<a> </html>";
} else {
echo "<div>There was a problem sending the mail. Please check that you filled in the form correctly. </div>";
}
?>
<br><br>
</div> 
<div id="sources"> <b><a href="sources.php">  </b>பதிவுகளிலிருந்து</a>, புதிய இடுகைகள் 2 மணி நேரத்திற்கு ஒருமுறை திரட்டப்படுகின்றன! <br></div><div id="footer"> hosted by:<a href="http://webspace2host.com/">webspace2host.com</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></body></html>
