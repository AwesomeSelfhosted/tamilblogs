<?php

/*Tamilblogs blogs aggregator/archiver
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
require_once('inc/auth.php');
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
<div id="main"><h1>தமிழ்பதிவுகளில் அங்கத்திணராக...</h1>
<?PHP 
if($_REQUEST['nu']){
		if(newUser($_REQUEST['nu'],$_REQUEST['p1'],$_REQUEST['p2'])){ 
			addUserForm();
		}
}
else {
	addUserForm();
}

function newUser($nu,$p1,$p2) {

	if (checkUserName($nu)){
		msg('User name "'.$nu.'" already exists. Choose another user name',-1);
		return 1;
	}
	if(empty($p1)){
		msg('Empty Passwords forbidden',-1);
		return 1;
	}
	if($p1 != $p2){
		msg('Passwords do not match',-1);
		return 1;
	}
	if(!$nu){
		msg('No user given',-1);
		return 1;
	}

	addUser($nu,$p1);
	msg('User Name created... please login.');
	return 0;
}


function addUserForm() {
	global $lang;
	print '<form method="post" action="register.php">'.NL;
	print '<fieldset class="useradd">'.NL;
	print '<legend><img src="img/user_add.png"> '.$lang['newuser'].'</legend>'.NL;

	print '<input type="hidden" name="do" value="uadd" />'.NL;

	print '<label for="nu">'.$lang['username'].':</label>';
	print '<br />'.NL;
	print '<input type="text" id="nu" name="nu" />'.NL;
	print '<br />'.NL;

	print '<label for="p1">'.$lang['password'].':</label>';
	print '<br />'.NL;
	print '<input type="password" id="p1" name="p1" />'.NL;
	print '<br />'.NL;

	print '<label for="p2">'.$lang['pwrepeat'].':</label>';
	print '<br />'.NL;
	print '<input type="password" id="p2" name="p2" />'.NL;
	print '<br />'.NL;

	print '<input type="submit" value="'.$lang['newuserbutton'].'" />'.NL;

	print '</fieldset>'.NL;
	print '</form>'.NL;
}

?>


</div> 
<?php
getFeedsCount();
html_foot();
?>
