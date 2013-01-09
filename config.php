<?
/*

  config.php - configuration options
  -- seepies.net Forumnews --

  (Name is a work in progress ;))

  Set your configuration options up in this file.

  For security reasons, I'd advise setting this file to
  be read only by the necessary people on the system.
  This means, yourself, and the web server and that's all.
  If you don't know how to do that, leave it or ask your
  sysadmin for guidance.

  This work is copyrighted to Phil Barbier (c) 2003 - 2005.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code and do not
  distribute this software without permission from the author.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  Phil Barbier - flimflam@gmail.com
  
  Initial release - 23 October 2003 01:23 EDT (woo)
    
  Last change: 	Altered and added in avatar support for phpBB.

  For versioning information, see $Id tag for funcs.php

*/

/********************************************************

  Don't change these var names, otherwise it'll not work.
  
********************************************************/

// Database system, can be either 'access', 'mysql' or 'postgres' at the moment.

$dbsystem 	= "mysql";

// Hostname of the server or DSN to connect to
// This is typically "localhost" - if you don't know, try localhost
// or consult your hosting company/administrator for more information

$dbhostname 	= "mysql.philnic.lan";

// Server port - 3306 is default for MySQL and 5432 is for Postgres
// if you're not sure, use the default or ask your sysadmin.
// This can also be /path/to/socket (ie, /var/run/mysql.sock)
// however, this will need to be checked with your sysadmin.

// Don't leave this empty UNLESS you're connecting to a DSN with MS Access!

$dbport		= "3306";

// Database name - name of database to connect to

$dbname		= "seepies_forum";

// Database username - username to connect to the database with

$dbuser		= "seepies";

// Database password - password for the connection, if this is empty, 
// make it "" (an empty string)

$dbpassword	= "seeps";

// Forum type - what type of forum are you using?
// Currently supported forums are phpbb and ib

$forumtype	= "phpbb";

// forum table prefix (configured in forum setup)
// default for phpBB is phpbb_ and for Invision Board, is ibf_
// If unsure, the defaults are usually fine

$tableprefix	= "phpbb_";

// URL of your forum
// Please include the full URL, including trailing slash (/) 
// as you'd see it in your browser

// Examples are: http://www.mydomain.com/phpBB2/
//		 http://www.mydomain.com/forum/
//		 http://forum.mydomain.com/

$forumurl	= "http://www.seepies.net/forum/";

// Forum ID of the forum
// To get the ID of the forum, you can either look in your phpMyAdmin area,
// or hover over the URL in a browser to the forum, which will have the
// forum ID in the URL. eg:
// http://www.mydomain.com/forum/viewforum.php?f=4 - the forum ID here is 4

$forumid	= 5;

// Number of recent posts to retrieve (default 5, min. of 1, max. of 10)

$numposts 	= 25;

// Number of characters to retrieve in the post body
// Example, if this is 200, it will retrieve all text in the post upto that
// number of characters (or the nearest, in the event of a word spanning that
// number)

// 150 or 200 is a reasonable number for this, though it entirely depends on
// your web site

$numchar	= 200;

// Do you want the first, or the last post of a topic to be displayed?
// First would be the very first post in a topic (topic starter)
// last is the latest/newest post in a topic

// 0 for first
// 1 for last 

// *** Please note, this will not have any effect for an IB forum yet ***

$firstlast	= 0;

// Whether to use forum user avatars in the post display

// *** NOTE *** This will NOT currently work for Invision Board

// 0 is no, 1 is yes.

$avatarsupport  = 1;

// Date string format for the post date/time to appear as

// For more information on format codes, see http://www.php.net/date

$datestring	= "d/M/Y H:i T";

/****************************************************

Please make sure you check this file so that you did
not mistakenly remove a ; and have each field filled
in correctly for your settings before proceeding.

If you've done the above, you're all set configuring!

*****************************************************/

?>

