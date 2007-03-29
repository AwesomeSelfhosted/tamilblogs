<?php
/* 
Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

Contains code from lylina news aggregator:
Copyright (C) 2005 Andreas Gohr
Copyright (C) 2006 Eric Harmon

Contains code from 'lilina':
Copyright (C) 2004-2005 Panayotis Vryonis

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
require_once('inc/auth.php');
require_once('inc/safehtml/safehtml.php');
require_once('inc/html.php');
require_once('inc/display.php');

/**
if($conf['usecron'] == 'false') {
	// Debug must be off on page load updates.
	$conf['debug'] = false;
	require_once('fetch.php');
}
**/

doSetup();

$UID = checkAuth($_REQUEST);
getUserName($UID);

writeHeaders();
html_head(true);

if($conf['mode'] == 'single')
	$UID = 0;
//printGoogleAdsense();	
if($conf['mode'] == 'normal' || $conf['mode'] == 'single' || ($conf['mode'] == 'login' && $UID != 0)) {
	printItems($UID,$_REQUEST['hours']);
	if($conf['sources'] == 'true') printSources($UID);
}
getFeedsCount();		
html_foot();

/* --------------------------------------------- */

function printItems($UID,$hours) {
	if(!is_numeric($hours)) $hours =0;
	if(!$hours) $hours = 12;

	$sql = "SELECT DISTINCT A.id as id, A.url as url, A.title as title, A.body as body, B.name as name, B.url as feedurl,
                       DATE_FORMAT(A.dt, '%H:%i') as time,
                       DATE_FORMAT(A.dt, '%d-%m-%Y') as date,
					   A.hits as hits
                 FROM tamilblogs_items A, tamilblogs_feeds B, tamilblogs_userfeeds C
                WHERE B.id = A.feed_id
                  AND B.id = C.feed_id
                  AND C.user_id = $UID
                  AND UNIX_TIMESTAMP(A.dt) > UNIX_TIMESTAMP()-($hours*60*60)				  
             ORDER BY A.dt DESC, A.title";	  
	$items = runSQL($sql);

	for($n = 0; $n < count($items); $n++){
		//print_r($items[$n]);
		formatItem($items[$n],$n);
		}
}

function formatSource($source) {
	print '<li><a href="'.$source['url'].'">';
	print '<img src="'.channelFavicon($source['url']).'" width="16" height="16" class="icon" alt="" /> ';
	print $source['name'];
	print '</a></li>';
}

function printSources($uid) {
	global $lang;
	$sql = "SELECT B.name, B.url
                  FROM tamilblogs_feeds B, tamilblogs_userfeeds C
                 WHERE B.id = C.feed_id
                   AND C.user_id = $uid
	      ORDER BY B.name";
	$sources = runSQL($sql);
	print '<div id="sources"> <b>'.$lang['sources'].'</b><ul>';
	for($n = 0; $n < count($sources); $n++)
		formatSource($sources[$n]);
	print '</div>';
}


//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
