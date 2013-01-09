<?
// URLs

define("url_profile", $forumurl . "profile.php?mode=viewprofile");
define("url_topicview", $forumurl . "viewtopic.php");


// tables

define("post_table", $tableprefix . "posts");
define("post_txt_table", $tableprefix . "posts_text");
define("forum_table", $tableprefix . "forums");
define("user_table", $tableprefix . "users");
define("topic_table", $tableprefix . "topics");
define("config_table", $tableprefix . "config");

// columns

define("pst_postid", "post_id");
define("pst_postuser", "post_username");
define("pst_topicid", "topic_id");
define("pst_forumid", "forum_id");
define("pst_userid", "poster_id");
define("pst_posttime", "post_time");
define("pst_postsub", "post_subject");
define("pst_posttxt", "post_text");
define("frm_forumname", "forum_name");
define("frm_forumid", "forum_id");
define("frm_catid", "cat_id");
define("usr_username", "username");
define("usr_userid", "user_id");
define("usr_avatar", "user_avatar");
define("usr_avtype", "user_avatar_type");
define("tpc_lastpid", "topic_last_post_id");
define("tpc_firstpid", "topic_first_post_id");
define("tpc_title", "topic_title");
define("tpc_replies", "topic_replies");
define("tpc_postid", "topic_poster");
define("tpc_movedid", "topic_moved_id");
define("tpc_time", "topic_time");
define("tpc_fid", "forum_id");

define("cfg_name", "config_name");
define("cfg_val", "config_value");
define("cfg_avmxw", "avatar_max_width");
define("cfg_avmxh", "avatar_max_height");
define("cfg_avpath", "avatar_path");
define("cfg_avgalpath", "avatar_gallery_path");
define("cfg_allowavloc", "allow_avatar_local");
define("cfg_allowavrem", "allow_avatar_remote");
define("cfg_allowavup", "allow_avatar_upload");

define("av_upload", 1);
define("av_remote", 2);
define("av_gallery", 3);

if ($firstlast==0) {
  
  $topicthread = tpc_firstpid;
  
} else {
  
  $topicthread = tpc_lastpid;
  
}

  // Because MS Access is awkward, we need to do a slightly different query

  if ($dbsystem!="access") {

  $sql  = "select " . tpc_title . ", " . usr_username . ", " . usr_userid . ", " . usr_avatar . ", " . usr_avtype . ", " . pst_posttime . ", " . tpc_replies . ", " . post_txt_table . "." . pst_postid . ", " . pst_postsub . ", " . pst_posttxt;
  $sql .= " from " . topic_table . " inner join " . user_table;
  $sql .= " on " . topic_table . "." . tpc_postid . "=" . user_table . "." . usr_userid;
  $sql .= " inner join " . post_txt_table;
  $sql .= " on " . topic_table . "." . $GLOBALS['topicthread'] . "=" . post_txt_table . "." . pst_postid;
  $sql .= " inner join " . post_table;
  $sql .= " on " . post_txt_table . "." . pst_postid . "=" . post_table . "." . pst_postid;
  $sql .= " where " . topic_table . "." . tpc_fid . "=" . $forumid . " and " . tpc_movedid . "=0 order by " . post_table . "." . pst_posttime . " desc limit " . $numposts . ";";
  
  } else {
  
  $sql  = "select top " . $postno . " " . tpc_title . ", " . usr_username . ", " . usr_userid . ", " . usr_avatar . ", " . usr_avtype . ", " . pst_posttime . ", " . tpc_replies . ", " . post_txt_table . "." . pst_postid . ", " . pst_postsub . ", " . pst_posttxt;
  $sql .= " from ((" . topic_table . " inner join " . user_table;
  $sql .= " on " . topic_table . "." . tpc_postid . "=" . user_table . "." . usr_userid;
  $sql .= ") inner join " . post_txt_table;
  $sql .= " on " . topic_table . "." . $topicthread . "=" . post_txt_table . "." . pst_postid;
  $sql .= ") inner join " . post_table;
  $sql .= " on " . post_txt_table . "." . pst_postid . "=" . post_table . "." . pst_postid;
  $sql .= " where " . topic_table . "." . tpc_fid . "=" . $forumid . " and " . tpc_movedid . "=0 order by " . post_table . "." . pst_posttime . " desc;";  
  }

function getprofileurl($uid) {

  return url_profile . "&u=" . $uid;

}

function getposturl($pid) {

  return url_topicview . "?p=" . $pid . "#" . $pid;

}

function gettopicurl($pid) {

  return url_topicview . "?p=" . $pid;
  
}

function getavatar($avatar, $avtype) {

  global $dbconn, $forumurl;

  $sql = "select " . cfg_val . ", " . cfg_name . " from " . config_table . " where " . cfg_name . " like 'allow_avatar_%';";
  
  //cfg_allowavloc . ", " . cfg_allowavrem . ", " . cfg_allowavup . " from " . config_table . ";";
  
  $cres = doquery($sql, $dbconn);
  
  $allowres = getresults($cres);
  
  for($i=0; $i < count($allowres); $i++) {
  
    $confarr[$allowres[$i][cfg_name]] = $allowres[$i][cfg_val];
  
  }
  
  unset($allowres);

  $imgpath = "";

  switch ($avtype) {
  
    case av_upload:
    
      if ($confarr[cfg_allowavup]==1) {

        $sql = "select " . cfg_val . " from " . config_table . " where " . cfg_name . "='" . cfg_avpath . "';";
  
        $qres = doquery($sql, $dbconn);
        
        $avpath = getsingleresult($qres, cfg_val);
      
        $imgpath = $avpath . "/" . $avatar;
      
      }
    
    break;
    
    case av_remote:
    
      if ($confarr[cfg_allowavrem]==1) {
      
        $imgpath = $avatar;
      
      }
    
    break;
    
    case av_gallery:
    
      if ($confarr[cfg_allowavloc]==1) {
        
        $sql = "select " . cfg_val . " from " . config_table . " where " . cfg_name . "='" . cfg_avgalpath . "';";
	  
	$qres = doquery($sql, $dbconn);
	        
        $avgalpath = getsingleresult($qres, cfg_val);
        
        $imgpath = $avgalpath . "/" . $avatar;
      
      }
    
    break;
  
  }
    
  return $imgpath;

}

function getmaxwidth() {

  global $dbconn;

  $sql = "select " . cfg_val . " from " . config_table . " where " . cfg_name . "='" . cfg_avmxw . "';";
  
  $qres = doquery($sql, $dbconn);
  
  if ($qres) {
  
    return getsingleresult($qres, cfg_val);
    
  }

}

?>
