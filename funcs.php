<?
/*

  funcs.php,v 1.1 2004/07/24 05:31:09 philb Exp

  funcs.php - Functions file
  -- seepies.net Forumnews --

  (Name is a work in progress ;))

  This file contains all the functions, conditions on
  changing any of this are below.

  This work is copyrighted to Phil Barbier (c) 2003 - 2004.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code and do not
  distribute this software without permission from the author.
  
  If you want to change anything, just drop me an e-mail with details
  and an explanation so that I can perhaps extend the software further.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  Phil Barbier - coder@seepies.net  

*/

require_once("config.php");

if(!isset($dbsystem)) {

  // can't carry on - can't assume this one

  print "Database type not selected in your configuration, please correct this.";

  exit;

}

if ($dbsystem != "mysql" && $dbsystem != "postgres" && $dbsystem != "access") {

  // Can't process any other db type either atm.
  print "Invalid database type selected, please correct this in your configuration.";
  exit;

}

if ($dbsystem == "postgres") {

  require("db/pgsql.php");

} elseif ($dbsystem == "mysql") {

  require("db/mysql.php");

} elseif ($dbsystem == "access") {

  require("db/access.php");

}

if ($dbconn == false) {

  // Can't carry on here either.

  print "Database connection error";
  exit;

}

// Set some sensible boundaries on the number of posts to get

if ($numposts > 10) {

  $numposts = 10;

} elseif($numposts < 0) {

  $numposts = 5;

}

// OK, we've got a database handler and things are going well...
// Time to introduce specific forum variables into the relationship

if ($forumtype == "phpbb") {

  require("phpbb.php");

} elseif ($forumtype == "ib") {

  require("ib.php");

} else {

  // Action stations, no supported forum entered!
  
  print "<br><font color=\"#FF0000\">Error: no supported forum entered, please correct your <b>config.php</b> and try again.</font><br>";
  exit;

}


// OK, now to set some globals

// Firstly, the support forum URL that we want
// everyone to go to for any support issues (outlined in readme)

define("supporturl", "http://www.seepies.net/forum/viewforum.php?f=4");

// version no

define("versioninfo", "1.1");

// date formats

define("datefmt", $datestring);

/********************************************

Function to print out a formatted array

********************************************/

function debug_array($a) {

  if (is_array($a)) {

    print "<br /><pre>";
    print_r($a);
    print "</pre><br />";
    
  } else {
  
    print "<br />" . $a . " is not an array.<br />";
    
  }
  
}

/*******************************************

Function to check if a variable is empty,
set, null or an empty string

********************************************/

function check_empty($v) {

  if(empty($v) || $v == "" || !isset($v) || is_null($v)) {
  
    return true;
    
  } else {
  
    return false;
    
  }

}

/******************************************

Function to help debug a function that
uses SQL

********************************************/

function debug_sqlfnc($sql, $dberr) {

  print "<br /><br /><pre>error: " . $dberr . "<br />";
  print "SQL is: " . $sql;
  print "</pre><br /><br />";
  
}

// by now, we should be able to allow queries to the database, so... :)

function getlastposts($postno) {

  global $dbconn, $forumid, $firstlast, $dbsystem;
  
  $sql = $GLOBALS['sql'];
  
  // Below is handy for debugging

  // print "executing SQL: " . $sql;

  $queryresult = doquery($sql, $dbconn);

  if ($queryresult) {
  
    $posts = getresults($queryresult);
    
    return $posts;
  
  } else {

    return $queryresult;

  }
  
  // closedb($dbconn);

}

function fmt_date($str, $datestr) {

  return date($datestr, $str);

}

function get_post_text($sp, $ftext, $pid) {

  if (strlen($ftext)<=$sp) {
  
    $spos = strlen($ftext);
    $ftext = substr($ftext, 0, $spos);
  
  } else {
  
    $spos = strpos($ftext, " ", $sp);
    $ftext = substr($ftext, 0, $spos) . " <a href=\"" . gettopicurl($pid) . "\">(cont...)</a>";
    
  }
  
  // $ftext = addurls($ftext);  
  $ftext = nl2br($ftext);
  
  return $ftext;
  
}

function addurls($post) {

  $strstart = strpos($post, "http://");

  $strend = $strstart + strpos(substr($post, $strstart), " ");
  //$strend = $strstart + strpos(substr($post, $strstart), "]");

  $url = substr($post, $strstart, $strend - $strstart);

  $badpos = strpos($url, "]");

  if ($badpos) {
  
    $url = substr($url, 0, $badpos);
          
  }

  $post = str_replace($url, "<a target=\"_blank\" href=\"$url\">$url</a>", $post);

  return $post;

}

/*
function addurls($post) {

  $post = preg_replace("#([\t\r\n ])([a-z0-9]+?){1}://([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="\2://\3" target="_blank">\2://\3</a>', $post);

  $post = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3" target="_blank">\2.\3</a>', $post);
  
  return $post;

}
*/

?>
