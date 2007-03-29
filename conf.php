<?php

// Welcome to tamilblogs

// =============================================================
//
// The following options MUST be changed in order for tamilblogs to
// work correctly.
//
// =============================================================

// -------------------- MySQL Configuration --------------------
// This tells tamilblogs which database to store information in.

$conf['db_host']     = 'localhost';
$conf['db_user']     = 'xxxxx';
$conf['db_pass']     = 'xxxxx';
$conf['db_database'] = 'xxxxx';

// =============================================================
//
// The following options allow you to futher customize tamilblogs
//
// =============================================================

// ----------------------- Display Mode  -----------------------
// This will allow you to configure which "display mode" to use
// with tamilblogs. Valid settings are: "normal" - multiuser system,
// "login" - multiuser requiring login to use, "single" - a
// single user system requiring login only to edit sources.

$conf['mode']        = 'normal';

// ------------------------ Page Title -------------------------
// Sets the titlebar for the page

$conf['page_title']  = 'தமிழ்ப் பதிவுகள்';

// ---------------------- RSS Description ----------------------
// Chooses the description for the RSS feed

$conf['rss_desc']    = 'தமிழ்ப் பதிவுகள்';

// ------------------------- Page Logo -------------------------
// Allows you to change the logo seen in the page

$conf['page_logo']   = 'img/logo.gif';

// -------------------------- Language -------------------------
// Contols the language used by tamilblogs.
// Languages must be in the 'lang' folder, and must use the
// ISO language code, ie: 'en.inc.php'

$conf['language']    = 'ta';

// -------------------------- Use Cron -------------------------
// Set this option to false if you are not using a cron job.
// Set to true only when you have added the cron job, otherwise
// feeds will not update.
// Note that setting 'false' slows page loading speeds
// drastically.

$conf['usecron']     = 'false';

// ------------------------- Page Style ------------------------
// Allows you to choose the CSS skin used to theme the page.
// This file MUST be in the 'style' folder.

$conf['page_style']  = 'default.css';

// -------------------------- Sources --------------------------
// Controls the display of sources at the bottom of the page

$conf['sources']     = 'false';

// -------------------- Digg.com integration -------------------
// Adds a "submit to digg" link to each post, letting you
// quickly post it to digg.com

$conf['digg']        = 'false';

// ------------------- del.icio.us integration -----------------
// Adds an "add to del.icio.us" link to each post, letting you
// post it quickly to your social bookmarks.

$conf['del.icio.us'] = 'true';

// --------------------- reddit integration --------------------
// Adds a "submit to reddit" link to each post, letting you
// post it quickly to reddit

$conf['reddit']      = 'false';

// ---------------------- furl integration ---------------------
// Adds an "add to furl" link to each post, letting you submit
// the item to your furl bookmarks

$conf['furl']        = 'false';

// -------------------- newsvine integration -------------------
// Adds a "seed at newsvine" link to each post, letting you 
// easy seed the newsvine.

$conf['newsvine']        = 'false';

// ---------------- Open News Links in New Window --------------
// Turn this on to force links to news items to open in new
// browser windows.

$conf['new_window']  = 'true';

// -------------------------- Search ---------------------------
// Enabled or disable the search function

$conf['search']      = 'false';

// =============================================================
//
// The following options ARE FOR ADVANCED USERS ONLY.
// These options allow for powerful adjustments to how tamilblogs
// works, and should only be used by advanced users.
//
// =============================================================

// ------------------------- Debug Mode ------------------------
// This setting will turn on debugging mode for item fetching.

$conf['debug']       = 'false';

// --------------------- Password Encryption -------------------
// This sets the password encryption scheme in tamilblogs. DO NOT
// CHANGE THIS SETTING AFTER YOU SETUP USERS IN LYLINA. No users
// will be able to login. By default tamilblogs sets up the admin
// user with a smd5 encrypted password, thus, you will have to
// change this manually in MySQL. It is not suggested you change
// this setting.
// 
// Valid encryption schemes: smb5, md5, sha1, ssha, crypt, mysql,
// my411

$conf['passcrypt']   = 'smd5';

// ---------------------- HTMLSax3 location --------------------
// Specifies the location of the HTMLSax3 library. This is
// installed by tamilblogs, thus, should not require modification.

define('XML_HTMLSAX3','inc/safehtml/');

// ------------------ MagpieRSS Cache Directory ----------------
// Specifies the location where MagpieRSS should cache feeds.
// This should never require modification.
define('MAGPIE_CACHE_ON', 0);
define('MAGPIE_CACHE_DIR', 'cache');

?>
