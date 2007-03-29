<?php
/* 
Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

contains code from lylina news aggregator
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
require_once('inc/html.php');

doSetup();

$UID = checkAuth($_REQUEST);

if(!$UID) 
{
	header("HTTP/1.1 403 Forbidden");
	die('Forbidden');
}

writeHeaders();

require_once('inc/magpie/rss_fetch.inc');

$url  = trim($_REQUEST['url']);
if(substr($url,0,4) != 'http')
	$url = "http://" . $url;
$name = trim($_REQUEST['name']);
$main = trim($_REQUEST['main']);

$get_feed = file_get_contents($url);
$test = @new MagpieRSS($get_feed);

//if(@fetch_rss($url) == '')
//if($test->feed_type == '' && !stristr($get_feed,"<rss") && !stristr($get_feed,"<rdf") && !stristr($get_feed,"<feed"))
if($test->feed_type == '')
{
	html_head(false,"preferences");
	msg('Please wait while I locate your feed, this can take some time...');
	flush();
	flush();
	$eurl = escapeshellarg($url);
	
//	Execute the python script to get possible feeds
	$out = `python feedfinder.py $eurl`;
	
//	Seperate out returned data
	$feeds = explode("\n",$out);
	
//	Clean out crap entries
	while($feeds[count($feeds) - 1] == '' && count($feeds) > 0)
		array_pop($feeds);
	
	print '<br /><br />';

//	If you find no feeds, or python isn't installed
	if(count($feeds) < 1)
		print 'I couldn\'t find any feeds on this page, sorry';
		
//	If you find a single feed
//	elseif (count($feeds) == 1) {
//		print 'SINGLE RESULT FOUND!!';
//		header("Location: edit.php?do=" . $_REQUEST['do'] . "&url=". $feeds[0] . "&name=$name");
//	}

//	If multiple feeds are found
	else {
		print 'The following feeds have been found on this site, please choose a feed to add to your page:<br />';
		foreach($feeds as $feed) {
			$rss = fetch_rss($feed);
			print '<a href="edit.php?do=' . $_REQUEST['do'] . "&url=$feed&name=$name&main=$main\">" . $rss->channel['title'] . " ($feed)</a><br />";
		}
	}
}
else
	header("Location: edit.php?do=" . $_REQUEST['do'] . "&url=$url&name=$name&main=$main");
	
html_foot();

//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
