<?
/*

  pgsql.php - pgsql info
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

$dbconn = @pg_connect("host=" . $dbhostname . " port=" . $dbport . " dbname=" . $dbname . " user=" . $dbuser . " password=" . $dbpassword);

function doquery($querystring, $dbconn) {

  $qres = @pg_exec($dbconn, $querystring);

  return $qres;

}

function getresults($result) {

  for($i=0; $i < @pg_numrows($result); $i++) {
  
    $resarr[] = @pg_fetch_array($result, $i, PGSQL_ASSOC);

  }

  return $resarr;

}

function closedb($dbconn) {

  $close = @pg_close($dbconn);

  return $close;

}

?>
