<?

// URLs

define("url_profile", $forumurl . "index.php?showuser=");
define("url_topicview", $forumurl . "index.php?showtopic=");


// tables

define("post_table", $tableprefix . "posts");
define("post_txt_table", $tableprefix . "posts_text");
define("forum_table", $tableprefix . "forums");
define("user_table", $tableprefix . "members");
define("topic_table", $tableprefix . "topics");

// columns

define("pst_postid", "pid");
define("pst_postuser", "author_name");
define("pst_topicid", "topic_id");
define("pst_forumid", "forum_id");
define("pst_userid", "author_id");
define("pst_posttime", "post_date");
define("pst_postsub", "post_title");
define("pst_posttxt", "post");
/*
Don't need - yet
define("frm_forumname", "forum_name");
define("frm_forumid", "forum_id");
define("frm_catid", "cat_id");
*/
define("usr_username", "name");
define("usr_userid", "id");

/*
OK, note about first/last post - because of the
way IB do it, we have to take the first and last 
date stamp instead and work with that.
*/

define("tpc_lastpid", "last_post");
define("tpc_firstpid", "start_date");
define("tpc_title", "title");
define("tpc_replies", "posts");
define("tpc_postid", "topic_poster");
define("tpc_movedid", "moved_to");
//define("tpc_time", "topic_time");
define("tpc_fid", "forum_id");
define("tpc_tid", "tid");

  $sql  = "select " . tpc_tid . " as " . pst_postid . ", " . pst_userid . ", " . usr_username . ", " . pst_posttime . ", " . pst_posttxt . ", " . pst_topicid . ", " . post_table . "." . pst_forumid . ", " . pst_postsub . ", " . topic_table . "." . tpc_replies . ", " . tpc_movedid . ", " . usr_userid . ", " . topic_table . "." . tpc_title;
  $sql .= " from " . topic_table . " inner join " . post_table;
  $sql .= " on " . topic_table . "." . tpc_tid . "=" . post_table . "." . pst_topicid . " inner join " . user_table;
  $sql .= " on " . post_table . "." . pst_userid . "=" . user_table . "." . usr_userid;
  $sql .= " where " . post_table . "." . pst_forumid . "=" . $forumid . " and " . tpc_movedid . " is NULL group by " . topic_table . "." . tpc_tid . " order by " . post_table . "." . pst_posttime . " desc limit " . $numposts . ";";

function getprofileurl($uid) {

  return url_profile . $uid;

}

function getposturl($pid) {

  return url_topicview . $pid;

}

function gettopicurl($pid) {

  return url_topicview . $pid;
  
}

?>
