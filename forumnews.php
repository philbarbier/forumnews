<? require("funcs.php"); 
$res = getlastposts($numposts);
/*

debug_array($res);

*/
?>
<table>

<?
for($i=0; $i<count($res); $i++) {
?>
  <tr>
    <td>
      <table width="100%">
        <tr>
	  <td><b>Post:</b> <a target="_blank" href="<?=getposturl($res[$i][pst_postid]) ?>"><?=$res[$i][tpc_title] ?></a>
	    <br><? if ($res[$i][pst_postsub]!=$res[$i][tpc_title] && $res[$i][pst_postsub]!="") { print "<b>Subject</b>: <a href=\"" . getposturl($res[$i][pst_postid]) . "\">" . $res[$i][pst_postsub] . "</a>"; } ?>
	  </td>
	  <td valign="top"align="right">By: <a target="_blank" href="<?=getprofileurl($res[$i][usr_userid]) ?>"><?=$res[$i][usr_username] ?></a></td>
	</tr>
	<tr>
	  <?
	  if ($avatarsupport==1) {
	  ?>
	  <td width="750"><?=get_post_text($GLOBALS['numchar'], $res[$i][pst_posttxt], $res[$i][pst_postid]) ?></td>
	  <td width="<?=getmaxwidth() ?>" align="right"><img src="<?=getavatar($res[$i][usr_avatar], $res[$i][usr_avtype]) ?>" alt="<?=$res[$i][usr_username] ?>s avatar" border="0"></td>
	  <?
	  } else {
	  ?>
	  <td colspan="2"><?=get_post_text($GLOBALS['numchar'], $res[$i][pst_posttxt], $res[$i][pst_postid]) ?></td>
	  <?
	  }
	  ?>
	</tr>
	<tr>
	  <td align="left"><a target="_blank" href="<?=gettopicurl($res[$i][pst_postid]) ?>">Comments (<?=$res[$i][tpc_replies] ?>)</a></td>
	  <td align="right">Date: <?=fmt_date($res[$i][pst_posttime], datefmt) ?></td>
	</tr>
      </table>
      <hr>
    </td>
  </tr>
<?
}
?>
  <tr>
    <td>
      <center>
        <h5>
          <a target="_blank" href="<?=supporturl ?>">seepies.net Forumnews</a> - <?=versioninfo ?> - <?=copyright ?>
        </h5>
      </center>
    </td>
  </tr>
</table>
