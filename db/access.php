<?
/*

  access.php - MS Access info
  -- seepies.net Forumnews --
  
  This work is copyrighted to Phil Barbier (c) 2003 - 2005.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code and do not
  distribute this software without permission from the author.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  Phil Barbier - flimflam@gmail.com  

*/

$dbconn = @odbc_connect($dbhostname, $dbuser, $dbpassword);

function doquery($querystring, $dbconn) {

  $qres = @odbc_exec($dbconn, $querystring);

  return $qres;

}

function getresults($result) {

  if(empty($fn[$result])) {
    for($i = 1; $i < @odbc_num_fields($result) + 1; $i++) {
      $fn[$result][] = @odbc_field_name($result, $i);
    }
  }

  $res_limit = ( isset($row_offset) ) ? $row_offset + 1 : 1;
  $res_limit_max = ( isset($num_rows) ) ? $row_offset + $num_rows + 1 : 1E9;
  $res_inner = 0;

  while(@odbc_fetch_row($result, $res_limit) && $res_limit < $res_limit_max) {
    for($z = 0; $z < count($fn[$result]); $z++) {
      $resarr[$res_inner][$fn[$result][$z]] = stripslashes(@odbc_result($result, $z + 1));      
    }

    $res_limit++;
    $res_inner++;

  }

  $num_rows = count($resarr);

  @odbc_free_result($result);

  return $resarr;

}

function closedb($dbconn) {

  @odbc_free_result($dbconn);

  $close = @odbc_close($dbconn);

  return $close;

}

?>