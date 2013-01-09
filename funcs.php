<?
/*

  $Id: funcs.php,v 1.9 2006/05/12 19:30:07 philb Exp $

  funcs.php - Functions file
  -- seepies.net Forumnews --

  (Name is a work in progress ;))

  This file contains all the functions, conditions on
  changing any of this are below.

  This work is copyrighted to Phil Barbier (c) 2003 - 2006.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code and do not
  distribute this software without permission from the author.

  If you want to change anything, just drop me an e-mail with details
  and an explanation so that I can perhaps extend the software further.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  Phil Barbier - flimflam@gmail.com

*/

/**********************************

Latest:

Hopefully URL parsing should be working properly now
 - Mar. 1st, 2005.

Things to fix:

avatar retrieval SQL for phpBB
poster/username for top/last post correctness (see above)

Do:

IB avatar support

**********************************/

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

define("versioninfo", "Revision: 1.6");

// copyright info

define("copyright", "&copy; Phil Barbier 2003-2006 seepies.net");

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

    print "<br />Data is not an array.<br />";

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

  //debug_sqlfnc($sql, mysql_error());

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

  //$ftext = addurls($ftext);

//  print "<pre>sl1: " . strlen($ftext) . "\nsl2: " . strlen(strip_tags($ftext)) . "\nsp: " . $sp;

//  print "\n\n". $ftext . "\n*********************\n" . strip_tags($ftext) . "\n</pre>";

  if (strlen($ftext)<=$sp) {

    $spos = strlen($ftext);
    $ftext = substr($ftext, 0, $spos);

  } else {

    // strip tags from text to get strlen?

    $spos = strpos($ftext, " ", $sp);

    if ($spos == "" || is_null($spos)) {

        $spos = strlen($ftext) - strpos(strrev($ftext), " ");

        $ftext = substr($ftext, 0, $spos) . "&nbsp;<a href=\"" . gettopicurl($pid) . "\">(cont...)</a>";

    } else {

        $ftext = substr($ftext, 0, $spos) . "&nbsp;<a href=\"" . gettopicurl($pid) . "\">(cont...)</a>";

    }

  }

  $ftext = addurls($ftext);
  
  $ftext = addimgs($ftext);    // uses the img parser submitted by chuckp
  $ftext = forum2news($ftext); // uses the user submitted italic/bold/underline parser by aden

  $ftext = nl2br($ftext);

  return $ftext;

}

function addurls($post) {

  $urlformat = "<a href=\"{URL}\">{DESCRIPTION}</a>";

  $url['1'] = str_replace('{URL}', '\1\2', $urlformat);
  $url['1'] = str_replace('{DESCRIPTION}', '\1\2', $url['1']);

  $url['2'] = str_replace('{URL}', 'http://\\1', $urlformat);
  $url['2'] = str_replace('{DESCRIPTION}', '\\1', $url['2']);

  $url['3'] = str_replace('{URL}', '\\1\\2', $urlformat);
  $url['3'] = str_replace('{DESCRIPTION}', '\\6', $url['3']);

  $url['4'] = str_replace('{URL}', 'http://\\1', $urlformat);
  $url['4'] = str_replace('{DESCRIPTION}', '\\5', $url['4']);

  $urlpattern[] = "#\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]#is";
  $urlstr[]     = $url['1'];

  $urlpattern[] = "#\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]#si";
  $urlstr[]     = $url['2'];

  $urlpattern[] = "#\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]#si";
  $urlstr[]     = $url['3'];

  $urlpattern[] = "#\[url=(([\w\-]+\.)*?[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\](.*?)\[/url\]#si";
  $urlstr[]     = $url['4'];

  $post = preg_replace($urlpattern, $urlstr, $post);

  return $post;

}

/*

  User submitted function.

  Parses IMG tags.

  Written by chuckp.

*/

function addimgs($post) {

  $imgformat = "<img src=\"{URL}\" alt=\"{DESCRIPTION}\"/>";

  $img['1'] = str_replace('{URL}', 'http://\\3', $imgformat);
  $img['1'] = str_replace('{DESCRIPTION}', '\\6', $img['1']);

  $img['2'] = str_replace('{URL}', 'http://\\3', $imgformat);
  $img['2'] = str_replace('{DESCRIPTION}', '\\6', $img['2']);

  $img['3'] = str_replace('{URL}', '\\1\\2', $imgformat);
  $img['3'] = str_replace('{DESCRIPTION}', '\\6', $img['3']);

  $img['4'] = str_replace('{URL}', 'http://\\1', $imgformat);
  $img['4'] = str_replace('{DESCRIPTION}', '\\5', $img['4']);

  $imgpattern[] = "#\\[img:([a-z0-9]{1,})\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/img:([a-z0-9]{1,})\]#is";
  $imgstr[]     = $img['1'];

  $imgpattern[] = "#\[img:([a-z0-9]{1,})\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/img:([a-z0-9]{1,})\]#si";
  $imgstr[]     = $img['2'];

  $imgpattern[] = "#\[img=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/img\]#si";
  $imgstr[]     = $img['3'];

  $imgpattern[] = "#\[img=(([\w\-]+\.)*?[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\](.*?)\[/img\]#si";
  $imgstr[]     = $img['4'];

  $post = preg_replace($imgpattern, $imgstr, $post);

  return $post;

}

/*

  User submitted function.

  Parses italic, bolded and underlined text.

  Written by aden.

*/

function forum2news($text)
{
   $text = eregi_replace("\[b:[[:alnum:]]+\]" . '([[:print:]]+)' . "\[/b:[[:alnum:]]+\]", "<b>" . "\\1" . "</b>", $text);
   $text = eregi_replace("\[i:[[:alnum:]]+\]" . '([[:print:]]+)' . "\[/i:[[:alnum:]]+\]", "<i>" . "\\1" . "</i>", $text);
   $text = eregi_replace("\[u:[[:alnum:]]+\]" . '([[:print:]]+)' . "\[/u:[[:alnum:]]+\]", "<u>" . "\\1" . "</u>", $text);
   //$text = eregi_replace("\[url=" . '([[:print:]]+)' . "\]" . '([[:print:]]+)' . "\[/url\]", "<a href=\"" . "\\1" . "\">" . "\\2" . "</a>", $text);
   return $text;
}

?>
