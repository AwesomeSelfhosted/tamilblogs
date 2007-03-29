<?php
/* 
tamilblogs news aggregator
Copyright (C) 2007 Mugunth

Contains code from lylina news aggregator:
Copyright (C) 2005 Andreas Gohr
Copyright (C) 2006 Eric Harmon

Contains code from 'lilina':
Copyright (C) 2004-2005 Panayotis Vryonis

tamilblogs is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

tamilblogs is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with tamilblogs; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define('NL',"\n");

/**
 * Prints the global message array
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */
function html_msgarea() {
	global $MSG;

	if(!isset($MSG)) return;

	foreach($MSG as $msg) {
		print '<div class="'.$msg['lvl'].'"><img src="img/information.png" alt="" /> ';
		print $msg['msg'];
		print '</div>'; 
  	} 
} 


function html_head($news_page) {
	global $conf;
	global $lang;
	global $UID;
	print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.NL;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/1">
    <title><? echo $conf['page_title']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<? echo $lang['CHARSET']; ?>" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <link rel="stylesheet" type="text/css" href="style/<? echo $conf['page_style']; ?>" media="screen" />
	<link rel="stylesheet" type="text/css" href="style/tabs.css" media="screen"/>	
    <link rel="stylesheet" type="text/css" href="style/mobile.css" media="handheld" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <!--<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php/<?php echo md5($UID) . '/' . $UID . '.xml'; ?>">-->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php">
    <script language="JavaScript" type="text/javascript">
    <!--
        var showDetails = false;
        var markID = '' ;
    //-->
    </script>
    <script language="JavaScript" type="text/javascript" src="js/engine.js"></script>

	<!-- Javascripts related to technorati and google	-->
	<script type="text/javascript" src="http://embed.technorati.com/embed/edqw2dr76i.js"></script>
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
	</script>
	<script type="text/javascript">
	_uacct = "UA-294888-2";
	urchinTracker();
	</script>	
	
	
</head>
<body onLoad="visible_mode(showDetails)">

<?php
	html_navigation($news_page);
	html_msgarea();
	print '<div id="main">';
}

function html_foot() {
	global $lang;
	global $version;
	global $UID;
	global $totalfeeds;

	print '</div>';
	print '<div id="sources"> <b><a href="sources.php"> '.$totalfeeds.' </b>பதிவுகளிலிருந்து</a>, புதிய இடுகைகள் 2 மணி நேரத்திற்கு ஒருமுறை திரட்டப்படுகின்றன! | <a href="submit_blog.php">உங்கள் பதிவுகளை சேர்க்க</a> <br></div>';	
	// We're sure you'd love to remove the 'powered by' logo, but please consider leaving it here to support the project!
	print '<div id="footer"> hosted by:<a href="http://webspace2host.com/">webspace2host.com</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['powered'].' <a href="http://code.google.com/p/tamilblogs/"><img src="img/logo.png" alt="tamilblogs" /></a> v'.$version;
	//print '<div class="feedico"><a href="rss.php"><img src="img/feed.png" alt="RSS feed" /></a> </div>';
	print '</div>';
	print '</body>';
	print '</html>';
}

function html_navigation($news_page) {
	global $conf;
	global $UID;
	global $lang;
	global $UserName;
	print '<div id="navigation">'.NL;
	//print '<a href="index.php"><img src="'.$conf['page_logo'].'" alt="'.$conf['page_title'].'" /></a> ';

	if(!$UID) {
		print '<form method="post" action="index.php" class="login">'.NL;
		print $lang['login'].NL;
		print '<img src="img/users.png" alt="user" /> <input type="text" name="u" />'.NL;
		print '<img src="img/password.png" alt="password" /> <input type="password" name="p" />'.NL;
		print '<input type="submit" value="'.$lang['login'].'" />'.NL;
		print '<br>want to join? <a href="register.php"> register</a>'.NL;
		print '</form>'.NL;

	} else {
		print '<form method="get" action="search.php" class="login">'.NL;
		print '<b>வணக்கம் _/\_ '.$UserName.'</b><br>';
		print $lang['search'].NL;
		print '<img src="img/search.png" alt="search" /> <input type="text" name="q" />'.NL;
		print '<input type="submit" value="'.$lang['search'].'" />'.NL;
		print '</form>'.NL;
	}

	print '<a href="index.php"><img src="'.$conf['page_logo'].'" alt="'.$conf['page_title'].'" /></a> ';
	print '<img src="img/spacer.gif" width="5" height="1" alt="" />';
	//print '<img src="img/calendar.png" alt="" /> ';
	print '<a href="rss.php"><img src="img/rss_feed.gif" alt="RSS செய்தியோடை" title="RSS செய்தியோடை" /></a> &nbsp;';
	
	
	print ' <div id="tabsF">';	  
	print '<ul> <li><a title="கடந்த 24 மணி நேரத்தில் எழுதப்பட்ட பதிவுகள்" href="index.php?hours=24"><span>24மணி</span> </a></li>';
    print '<li><a title="கடந்த 48 மணி நேரத்தில் எழுதப்பட்ட பதிவுகள்" href="index.php?hours=48"><span>48மணி</span> </a></li>';
    print '<li><a title="கடந்த ஒரு வாரத்தில் எழுதப்பட்ட பதிவுகள்" href="index.php?hours=168"><span>ஒரு வாரம் </span></a></li>';
    print '</ul>    </div>';
	print '<a href="javascript:visible_mode(true);"> <img src="img/arrow_out.png" alt="விரிவாக்குக" title="விரிவாக்குக" /></a> &nbsp; ';
    print '<a href="javascript:visible_mode(false);"><img src="img/arrow_in.png" alt="சுருக்குக" title="சுருக்குக" /></a>';
	//print ' | <a href="sources.php">பதிவுகளின் பட்டியல்</a>';
	
	
	//print '<a href="index.php?hours=4">';
	//print $lang['4hours'];
	//print '</a>'.NL;

	//print '<a href="index.php?hours=8">';
	//print $lang['8hours'] . ' (' . $lang['default'] . ')';
	//print '</a>'.NL;

	//print '<a href="index.php?hours=16">';
	//print $lang['16hours'];
	//print '</a>'.NL;

	//print '<a href="index.php?hours=24">';
	//print $lang['1day'];
	//print '</a>'.NL;

	//print '<a href="index.php?hours=168">';
	//print $lang['1week'];
	//print '</a>'.NL;

/**	if($news_page == true) {
		print '<img src="img/spacer.gif" width="50" height="1" alt="" />';

		print '<img src="img/toggle.png" alt="" /> ';

		print '<a href="javascript:visible_mode(true);">';
		print $lang['expand'];
		print '</a>'.NL;

		print '<a href="javascript:visible_mode(false);">';
		print $lang['collapse'];
		print '</a>'.NL;
	}
**/		
	if($UID) {
		print '<img src="img/spacer.gif" width="50" height="1" alt="" />';
		print '<img src="img/preferences.png" alt="" /> ';

        	print '<a href="edit.php">';
        	print $lang['preferences'];
       		print '</a>'.NL;

		print '<img src="img/spacer.gif" width="50" height="1" alt="" />';
		print '<img src="img/logout.png" alt="" /> ';

        	print '<a href="index.php?logout=1">';
        	print $lang['logout'];
       		print '</a>'.NL;
	}

	print '</div>';
}

//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
