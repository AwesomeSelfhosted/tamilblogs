<?php
/*
Tamilblogs blogs aggregator/archiver
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
*/

require_once('inc/common.php');
?>

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
<form method="post" action="index.php" class="login">Login
<img src="img/users.png" alt="user" /> <input type="text" name="u" />
<img src="img/password.png" alt="password" /> <input type="password" name="p" />
<input type="submit" value="Login" />
</form>
<a href="index.php"><img src="img/logo.gif" alt="தமிழ்ப் பதிவுகள்" /></a> <img src="img/spacer.gif" width="5" height="1" alt="" /><a href="rss.php"><img src="img/rss_feed.gif" alt="RSS செய்தியோடை" title="RSS செய்தியோடை" /></a> &nbsp; 
</div>

<div id="main"><h1><center>திரட்டப்படும் பதிவுகளின் பட்டியல்:</center></h1>

<table width='80%' align='center' cellspacing=1 cellpadding=4>
<tr><td><b>எண்</b> </td> <td> <b>முகவரி</b> </td> <td><b>தலைப்பு </b></td> </tr>

<?php
	$sql = "SELECT id, url, name FROM tamilblogs_feeds";	  
 	$items = runSQL($sql);
	$totalitems = count($items);
	
	for($n = 0; $n < $totalitems; $n++){
	//print_r($items[$n]);
	echo "<tr><td>".($n+1)."</td> <td>".$items[$n][url]."</td> <td>".$items[$n][name]."</td> </tr>";
	}
?>

</table>
</div> 

<div id="sources"> <b><a href="sources.php"> <? echo $totalitems; ?> </b>பதிவுகளிலிருந்து</a>, புதிய இடுகைகள் 2 மணி நேரத்திற்கு ஒருமுறை திரட்டப்படுகின்றன! | <a href="submit_blog.php">உங்கள் பதிவுகளை சேர்க்க</a> <br></div><div id="footer"> hosted by:<a href="http://webspace2host.com/">webspace2host.com</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;powered by <a href="http://code.google.com/p/tamilblogs/"><img src="img/logo.png" alt="tamilblogs" /></a> v1.20</div></body></html>
