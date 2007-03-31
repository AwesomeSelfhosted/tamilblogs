<?php
/* 
Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

contains code from lylina news aggregator:
Copyright (C) 2005 Andreas Gohr
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

doSetup();

// This will prevent scripts from colliding with each other, as this system now *waits* for previous update to finish.
ini_set("max_execution_time",600);

//This will prevent the warning messages from getting displayed in the webpage.

if($_REQUEST['error'] == 'Yes'){
	ini_set('display_errors', 1);
	}
else if($_REQUEST['error'] == 'Yes1'){
	ini_set('display_errors', 1);
}
else if($_REQUEST['error'] == 'Yes2'){
	ini_set('display_errors', 1);
}
else{
	ini_set('display_errors', 0);
}

/** commenting this as i dont know what this does.. .need to understand it first and decide if it is really needed.... - Mugunth
if(!@mkdir('lockdir')){
	print $lang['lockdir'];
	exit;
}
**********************************/

//Send mail to tamilblogs admin to notify the updation has started.
mail("mugunth@gmail.com", "tamilblogs update started " , "tamilblogs update started");

$fp = fopen('lockfile',w) or die($lang['lockdir']);
flock($fp,LOCK_EX) or die($lang['lockdir']);

if (!extension_loaded('mysql')){
	dl('mysql.so');
}

set_time_limit (0);
ignore_user_abort(true);

require_once('inc/magpie/rss_fetch.inc');

$sql   = 'SELECT * FROM tamilblogs_feeds';
$feeds = runSQL($sql);

foreach($feeds as $feed){
	if($conf['debug'] == 'true') print 'Fetching '. $feed['url'] . "\n";
	$enc = '';
	
	if($_REQUEST['error'] == 'Yes2'){
		echo $feed['url']."\n";
	}				
	
	$data = fetch_rss($feed['url']);
	updateFeedItems($feed,$data);
	if($conf['debug'] == 'true') print "updated\n";
	if($conf['debug'] == 'true') print "\n";
}

fclose($fp);
//Send mail to tamilblogs admin to notify the updation has ended.
mail("mugunth@gmail.com", "tamilblogs update ended" , "tamilblogs update ended");

function updateFeedItems($feed,$rss){
        global $conf;
	if((empty($feed['name']) || empty($feed['website'])) && !empty($rss->channel['title'])){
		$sql = "UPDATE tamilblogs_feeds
                SET name = '".addslashes($rss->channel['title'])."',
                   website = '".addslashes($rss->channel['link'])."'
			 WHERE   id = '".addslashes($feed['id'])."'";

	if($_REQUEST['error'] == 'Yes1'){
		echo $sql;
	}			 
        	runSQL($sql);
	}
    
	foreach($rss->items as $item){
		//if($item[date_timestamp]){
		//	$item[date_timestamp]= date("Y-m-d H:i:s",$item[date_timestamp]);
		//	}
		//print_r($item);
		
		//if(!$item['pubdate'])
		//	$item['pubdate'] = time();

//atom format date which comes in  $item['published'] is not formated to timestamp by strtrotime function in some versions of PHP. So substr option was used . here possible error can happen since we are not taking into account the time offset (eg -+6.00 etc..)- Mugunth
		if((!$item['pubdate'])&&($item['published'])){
			$item['pubdate'] = date("Y-m-d H:i:s",strtotime(substr($item['published'], 0, 10).' '.substr($item['published'], 11, 8 )));
			}
// some atom feeds from blogspot dont have published date, they have issued date instead (and modified date and created dates)
		if((!$item['pubdate'])&&($item['issued'])){
			$item['pubdate'] = date("Y-m-d H:i:s",strtotime(substr($item['issued'], 0, 10).' '.substr($item['issued'], 11, 8 )));
			}
		
		if((!$item['pubdate'])&&(!$item['published'])&&($item[date_timestamp])){
			$item['pubdate'] = date("Y-m-d H:i:s",$item[date_timestamp]);
			}
			
		if(!$item['summary'])
			$item['summary'] = $item['atom_content'];

		$sql = "INSERT IGNORE INTO tamilblogs_items
			   SET feed_id = '".$feed['id']."',
				   url = '".addslashes($item['link'])."',
				 title = '".addslashes($item['title'])."',
				  body = '".addslashes($item['summary'])."',
				    dt = '".date("Y-m-d H:i:s",strtotime($item['pubdate']))."'";
			
		runSQL($sql);
		
		if($conf['debug'] == 'true') print ".";
		flush();

    	}
}

//Setup VIM: ex: et ts=4 enc=utf-8 :
?>
