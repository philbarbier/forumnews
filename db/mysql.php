<?
/*

  mysql.php - mysql info
  -- seepies.net Forumnews --

  (Name is a work in progress ;))
  
  This work is copyrighted to Phil Barbier (c) 2003 - 2004.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code and do not
  distribute this software without permission from the author.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  Phil Barbier - coder@seepies.net  

*/

$dbconn = @mysql_connect($dbhostname . ":" . $dbport, $dbuser, $dbpassword);

$dbsel = @mysql_select_db($dbname);

function doquery($querystring, $dbconn) {

  $qres = @mysql_query($querystring, $dbconn);

  return $qres;

}

function getresults($result) {

  for($i=0; $i < @mysql_numrows($result); $i++) {
  
    $resarr[] = @mysql_fetch_assoc($result);

  }

  return $resarr;

}

function getsingleresult($result, $fname) {

  return mysql_result($result, 0, $fname);

}

function closedb($dbconn) {

  $close = @mysql_close($dbconn);

  return $close;

}

?>
