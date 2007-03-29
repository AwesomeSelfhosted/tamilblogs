<?php
/*
Tamilblogs blogs aggregator/archiver
Copyright (C) 2007 Mugunth

Contains code from lylina news aggregator:
Copyright (C) 2006 Eric Harmon
Contains a patch by Michael Wenzl:
Copyright (C) 2006 Michael Wenzl

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
require_once('inc/safehtml/safehtml.php');
require_once('inc/rss2writer/rss2writer.php');

function doRSS () {
	global $conf;
	global $lang;
	
	$request = $_SERVER['REQUEST_URI'];
	$temp = explode('/',$request);
	$user_hash = $temp[2];
	$temp = explode('.',$temp[3]);
	$user = $temp[0];
	
	if(md5($user) == $user_hash)
		$UID = $user;
	else
		$UID = 0;

// try to find a place in conf.php or create conf_rss.php
	$description = $conf['rss_desc'];
	$link = "http://tamilblogs.com";
	$max_rss_items = 20;

	if(!$hours) $hours = 48;

        $sql = "SELECT DISTINCT A.id as id, A.url as url, A.title as title, A.body as body, B.name as name, B.url as feedurl,
                       UNIX_TIMESTAMP(A.dt) as timestamp
                 FROM tamilblogs_items A, tamilblogs_feeds B, tamilblogs_userfeeds C
                WHERE B.id = A.feed_id
                  AND B.id = C.feed_id
                  AND C.user_id = $UID
                  AND UNIX_TIMESTAMP(A.dt) >  UNIX_TIMESTAMP()-($hours*60*60)
             ORDER BY A.dt DESC, A.title";
    $items = runSQL($sql);
	$rss = new RSS2Writer($link,$conf['page_title'],$description);

	//for($n = 0; $n < count($items); $n++) {
	for($n = 0; $n < 25; $n++) {
		$item_title = $items[$n]['name'].": ".htmlspecialchars($items[$n]['title']);
		$safehtml =& new safehtml();
		$item_body = $safehtml->parse($items[$n]['body']);
		$custom_url = 'http://tamilblogs.com/redirect.php?pathivu='.$items[$n]['url'];
		$rss->addItem($custom_url,$item_title,$item_body
// Mugunth - need to understand the below code and enable it check: http://daniel.lorch.cc/projects/rss2writer/doc/RSS2Writer/RSS2Writer.html
// also check: http://rss-extensions.org/wiki/Main_Page		
//			array(
//				'dc:date' => date('Y-m-d\TH:m:s\Z', $items[$n]['timestamp']),
//				'guid' => md5(getFaviconURL($items[$n]['feedurl'])) . ':' . md5($items[$n]['url'])
//			)
		);
	}
	$rss->output($lang['CHARSET']);
	return;
}

doRSS();

?>
