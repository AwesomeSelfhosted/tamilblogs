<?php
mb_internal_encoding("UTF-8");
/* 
Tamilblogs blog aggregator/archiver
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
GNU General Public License 2.0 for more details.

You should have received a copy of the GNU General Public License
along with tamilblogs; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

function getFaviconURL($location) {
	if(!$location){
		return false;
	} else {
		$url_parts = parse_url($location);
		$full_url = "http://$url_parts[host]";
		if(isset($url_parts['port']))
			$full_url .= ":$url_parts[port]";
		$favicon_url = $full_url . "/favicon.ico" ;
	}
	return $favicon_url;
}

function channelFavicon($location) {
	$empty_ico_data = base64_decode(
	'AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAQAEAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAA////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
	'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AAD//wAA//8AAP//AAD//wAA//8AAP//' .
	'AAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA//8AAP//AAA=') ;
	
	$ico_url = getFaviconURL($location) ;
	if(!$ico_url) {
		return false ;
	}
	$cached_ico = './favicons/' . md5($ico_url) . ".ico" ;
	$cachetime = 7 * 24 * 60 * 60; // 7 days
    	// echo "<br> $ico_url , $cached_ico " ;
	// Serve from the cache if it is younger than $cachetime
	if (file_exists($cached_ico) && (time() - $cachetime < filemtime($cached_ico))) return $cached_ico ;
	if (!$data = @file_get_contents($ico_url)) $data=$empty_ico_data ;
	if (stristr($data,'html')) $data=$empty_ico_data ;
	$fp = fopen($cached_ico,'w') ;
	fputs($fp,$data) ;
	fclose($fp) ;
	return $cached_ico ;
}

function formatItem($item,$number) {
	global $conf;
	global $lang;
	static $date='';
	//print_r($item);
	
	// tamil date conversion related 
	$tamilweeks = array("Sun"=>"ஞாயிறு", "Mon"=>"திங்கள்", "Tue"=>"செவ்வாய்", "Wed"=>"புதன்", "Thu"=>"வியாழன்", "Fri"=>"வெள்ளி", "Sat"=>"சனி");
	$tamilmonths = array("January"=>"ஜனவரி","February"=>"பிப்ரவரி","March"=>"மார்ச்","April"=>"ஏப்ரல்","May"=>"மே","June"=>"ஜூன்","July"=>"ஜூலை","August"=>"ஆகஸ்ட்","September"=>"செப்டம்பர்","October"=>"அக்டோபர்","November"=>"நவம்பர்","December"=>"டிசம்பர்");
	
	if($item['date'] != $date) {
		$date = $item['date'];

		list($day, $month, $year) = explode('-', $date);
		$timestamp = mktime(0, 0, 0, $month, $day, $year);
		
		//values required for converting to tamil dates
		$dateweek = date('D',$timestamp);
	    $datemonth = date('F',$timestamp);		
		$this_date = date('D d F, Y', $timestamp ) ;

		//changing the date format to tamil
		$date_in_tamil = str_replace($datemonth, $tamilmonths[$datemonth],str_replace($dateweek, $tamilweeks[$dateweek], $this_date));
		
		print '<h1>'.$date_in_tamil.'</h1>';
	}

	if($number == 15){
		printGoogleAdsense();	
	}
	
	print '<div class="feed">';
//	print '<div class="item" id="IITEM-'.$item['id'].'">';
	print '<div class="item" id="IITEM-'.md5($item['url']).'">';
	//print '<img src="'.channelFavicon($item['feedurl']).'" width="16" height="16" class="icon" alt="" />';
	print '<img src="img/mark_off.gif" width="16" height="16" class="icon" alt="" />';	
	print '<span class="time">'.$item['time'].'</span> ';
	print '<span class="title" id="TITLE'.$number.'">';
	print htmlspecialchars($item['title']);
	print '</span> ';
	if ($item['hits'] > 0){
		if ($item['hits'] == 1) print '<span class="time">('.$item['hits'].' பார்வை)</span>';
		else print '<span class="time">('.$item['hits'].' பார்வைகள்)</span>';
		}
	print '<span class="source">';
	if($conf['new_window'] == 'true') 
		print '<a href="redirect.php?pathivu='.$item['url'].'" target="_new">&raquo;';
	else 
		print '<a href="redirect.php?pathivu='.$item['url'].'">&raquo;';
	print htmlspecialchars($item['name']);
	print '</a>';
	print '</span>';
	print '<div class="excerpt" id="ICONT'.$number.'">';
	$safehtml =& new safehtml();
	print $safehtml->parse($item['body']);
	//print $safehtml->parse(mb_substr($item['body'],0,500));
	//print '<a href="redirect.php?pathivu='.$item['url'].'" target="_new">&raquo; மேலும் படிக்க...</a>';
	print '<div class="integration">';

	if($conf['digg'] == 'true' && !stristr(getHost($item['url']),'digg'))
		print '<a href="http://digg.com/submit?phase=3&amp;url='.$item['url'].'&amp;title='.$item['title'].'" target="_new"><img src="img/digg.gif" alt="" /> '.$lang['digg'].'</a> ';
		
	if($conf['del.icio.us'] == 'true')
		print '<a href="http://del.icio.us/post?url='.$item['url'].'&amp;title='.$item['title'].'" target="_new"><img src="img/del.icio.us.gif" alt="" /> '.$lang['delicious'].'</a> ';
		
	if($conf['reddit'] == 'true' && !stristr(getHost($item['feedurl']),'reddit'))
		print '<a href="http://www.reddit.com/submit?url='.$item['url'].'&amp;title='.$item['title'].'" target="_new"><img src="img/reddit.png" alt="" /> '.$lang['reddit'].'</a> ';
		
	if($conf['furl'] == 'true')
		print '<a href="javascript:furlPost(\''.$item['url'].'\',\''.$item['title'].'\');"><img src="img/furl.gif" alt="" /> '.$lang['furl'].'</a> ';
		
	if($conf['newsvine'] == 'true')
		print '<a href="javascript:void(window.open(\'http://www.newsvine.com/_wine/save?u='.$item['url'].'&h='.$item['title'].'\',\'newsvine\',\'toolbar=no,width=590,height=480\'));"><img src="img/newsvine.gif" alt="" /> '.$lang['newsvine'].'</a> ';
		
	print '</div>';
	print '</div>';
	print '</div>';
	print '</div>';
	flush();
}

?>
