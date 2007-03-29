<!--Tamilblogs blogs aggregator/archiver
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
-->

<?php
header("Location:".$_GET['pathivu']);
//echo $_GET['site'];
echo "வலைப்பதிவின் பக்கம் ஏற்றப்படுகிறது.தயவுசெய்து காத்திருக்கவும்...";
require_once('inc/common.php');
incrementReadCount($_GET['pathivu'],$_SERVER["REMOTE_ADDR"]);
exit;
?>
