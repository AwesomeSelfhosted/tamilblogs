<?php
/* 
Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

Contains code from lylina news aggregator:
Copyright (C) 2006 Eric Harmon

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
require_once('inc/MysqlSearch.php');
require_once('inc/display.php');

doSetup();

$UID = checkAuth($_REQUEST);

if(!$UID) 
{
	header("HTTP/1.1 403 Forbidden");
	die('Forbidden');
}

writeHeaders();
html_head(true);

msg($lang['searchresults'].' <i>'.$_REQUEST['q'].'</i>');

$search = new MysqlSearch;
$search->setidentifier("id");
$search->settable("tamilblogs_items");
$results = $search->find($_REQUEST['q']);

$test = implode(", ",$results);

$sql = "SELECT DISTINCT A.id as id, A.url as url, A.title as title, A.body as body, B.name as name, B.url as feedurl,
                       DATE_FORMAT(A.dt, '%H:%i') as time,
                       DATE_FORMAT(A.dt, '%d-%m-%Y') as date,
					   A.hits as hits					   
			FROM tamilblogs_items A, tamilblogs_feeds B, tamilblogs_userfeeds C
             WHERE B.id = A.feed_id
               AND B.id = C.feed_id
               AND C.user_id = $UID
               AND A.id IN($test)
             ORDER BY A.dt DESC, A.title	  		  
	     LIMIT 50";
$items = runSQL($sql);

for($n = 0; $n < count($items); $n++)
	formatItem($items[$n],$n);
		
html_foot();

?>
