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
require_once('inc/html.php');
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

| <a href="sources.php">பதிவுகளின் பட்டியல்</a></div>
<div id="main"><h1>உங்கள் வலைப்பதிவை தமிழ்ப்பதிவுகள் திரட்டியில் இணைக்க... </h1>
<form action="mail.php" method="post">

<table width='80%' align='center' cellspacing=1 cellpadding=4>

<tr >
 <td>உங்கள் பெயர்: </td>
</td>
<td colspan=2 bgcolor="#ffffcc"><input type="text" size="60" name="name" />  
</tr>

<tr>
 <td>உங்கள் மின்னஞ்சல்: </td>
 <td colspan="2"><input type="text"  size="60" name = "email"> </td>
</tr>

<tr>
 <td>வலைப்பதிவு முகவரி: </td>
 <td colspan="2"><input type="text" size="60" name="blogurl" /> </td>
</tr>
</table>
<input type="submit" value="அளி">
</form>

</div> 
<?php
getFeedsCount();
html_foot();
?>
