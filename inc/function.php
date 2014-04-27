<?php
function get_setting($name) {
   $sql = mysql_query("select * from setting where name='" . $name . "' limit 1");
   $setting = mysql_fetch_assoc($sql);
   return $setting ? $setting['value'] : '';
}
function get_time($timestamp) {
   $timeshift = get_setting('timeshift') * 3600;
   return date("d M Y - H:i", ($timestamp == '' ? time() : $timestamp) + $timeshift);
}
function get_post($post_id, $column) {
   $res_post = mysql_fetch_assoc(mysql_query("select * from post where id='" . $post_id . "' limit 1"));
   switch ($column) {
      case 'content' :
         return filter($res_post['content']);
         break;
      case 'title' :
         return htmlentities(filter($res_post['title']));
         break;
      case 'permalink' :
         return get_setting('blogurl') . '/' . $res_post['permalink'];
         break;
      case 'author' :
         $res_user = mysql_fetch_assoc(mysql_query("select nick from user where id='" . $res_post['author'] . "'"));
         return $res_user['nick'];
         break;
      case 'category' :
         $res_category = mysql_fetch_assoc(mysql_query("select * from category where id='" . $res_post['category'] . "'"));
         return filter($res_category['name']);
         break;
      case 'categoryurl' :
         $res_category = mysql_fetch_assoc(mysql_query("select * from category where id='" . $res_post['category'] . "'"));
         return get_setting('blogurl') . '/category/' . $res_category['url'];
         break;
      case 'createtime' :
         return get_time($res_post['createtime']);
         break;
      case 'related' :
         $res_category = mysql_fetch_assoc(mysql_query("select * from category where id='" . $res_post['category'] . "'"));
         $sql = mysql_query("select * from post where category='" . $res_category['id'] . "' and id<>'$post_id' and draft='0' order by rand() limit 5");
         if (mysql_num_rows($sql)) {
            rt('tm');
            echo '<div class="list-head">Read Also</div>';
            while ($res_related = mysql_fetch_assoc($sql)) {
               echo '<div class="list"><a href="' . get_post($res_related['id'], 'permalink') . '">' . htmlentities(filter($res_related['title'])) . '</a></div>';
            }
            rb('b');
         }
         break;
      default :
         return $res_post[$column];
   }
}
function get_comment($post_id, $page) {
   if ($post_id) {
      $npost = mysql_num_rows(mysql_query("select * from comment where post_id='" . $post_id . "'"));
      $start = get_setting('list') * ($page -1);
      $sql = mysql_query("select * from comment where post_id='" . $post_id . "' order by time DESC limit $start," . get_setting('list'));
   } else {
      $npost = mysql_num_rows(mysql_query("select * from comment"));
      $start = get_setting('list') * ($page -1);
      $sql = mysql_query("select * from comment order by time DESC limit $start," . get_setting('list'));
   }
   if ($n = mysql_num_rows($sql) > 0) {
      rt('tm');
      echo '<a name="commentlist"></a><div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/comments.png"/> Recent' . (!$post_id ? ' comments' : '') . '</div>';
      while ($res_comment = mysql_fetch_assoc($sql)) {
         echo '<div class="list-comment' . (isset ($_SESSION['com_new']) ? '-new' : ($res_comment['adm'] == 1 ? '-admin' : '')) . '">' .
          ($res_comment['website'] ? '<a href="http://' . $res_comment['website'] . '" rel="external nofollow" target="_blank"><b>' . filter($res_comment['name']) . '</b></a>' : '<b>' . ($res_comment['adm'] == 1 ? get_admin('nick') : filter($res_comment['name'])) . '</b>') . ' (' . get_time($res_comment['time']) . ')<br />' .
         smiley(nl2br(htmlentities(filter($res_comment['content'])))) .
          (!$post_id ? '<br />From: <a href="' . get_post($res_comment['post_id'], 'permalink') . '">' . get_post($res_comment['post_id'], 'title') . '</a>' : '') . '</div>';
         if (isset ($_SESSION['com_new']))
            unset ($_SESSION['com_new']);
      }

      if ($npost > get_setting('list')) {
         if ($post_id)
            show_paging(get_post($post_id, 'permalink') . '/c', $page, $npost);
         else
            show_paging(get_setting('blogurl') . '/comment/p', $page, $npost);
      }
      rb('b');
   } else {
      if (!$post_id) {
         rt('tm');
         echo '<a name="commentlist"></a><div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/comments.png"/> Recent comments</div>' .
         '<div class="list"> No comment available</div>';

         rb('b');
      }
   }
}

function get_comment_form($post_id, $admin) {
   $name = isset ($_SESSION['com_name']) ? $_SESSION['com_name'] : '';
   $website = isset ($_SESSION['com_website']) ? $_SESSION['com_website'] : '';
   $content = isset ($_SESSION['com_content']) ? $_SESSION['com_content'] : '';
   if (isset ($_SESSION['com_err_msg'])) {
      rt('tw');
      echo '<div class="list-warning">' . $_SESSION['com_err_msg'] . '</div>';
      rb('bw');
   }
   rt('tm');
   echo '<div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/comment-add.png"/> Add comment</div><div class="content">' .
   '<form method="post" action="' . get_setting('blogurl') . '/comment/?action=post">';
   if ($admin) {
      echo ' Name : (' . get_admin('nick') . ') <a href="?logout"> Logout</a> <hr />';
   } else {
      echo 'Name: *<br /><input type="text" maxlength="40" name="name" value="' . htmlentities($name) . '"/><hr />' .
      'Website:<br /><input type="text" name="website" value="' . $website . '"/><hr />';
   }
   echo 'Comment: *<br /><textarea rows="5" name="content">' . $content . '</textarea><hr />';
   if (!$admin) {
      echo '<img src="' . get_setting('blogurl') . '/captcha.php" style="border:1px solid #bbb;"/>*<br />' .
      '<input type="text" maxlength="3" name="captcha" value=""/><hr />';
   }
   echo '<input type="hidden" name="post_id" value="' . $post_id . '"/>' .
   '<input type="submit" value="Send"/> | <a href="' . get_setting('blogurl') . '/smiley.php">Smiley</a></form></div>';
   if (isset ($_SESSION['com_err_msg'])) {
      unset ($_SESSION['com_err_msg']);
      echo '<div class="list-nobullet-head"><a href="' . get_post($post_id, 'permalink') . '"><< Back</a></div>';
      rb('bm');
   } else {
      rb('b');
   }
}
function create_permalink($str) {
   $str = trim(preg_replace('/([^A-Za-z0-9_]+)/', ' ', $str));
   $str = mb_strtolower(str_replace(' ', '-', $str));
   if (mysql_fetch_assoc(mysql_query("select * from post where permalink='$str'"))) {
      $i = 2;
      while (mysql_fetch_assoc(mysql_query("select * from post where permalink='" . $str . '-' . $i . "'"))) {
         $i++;
      }
      return $str . '-' . $i;
   } else {
      return $str;
   }
}

//function for rounded corner
function rt($style) {
   echo '<p class="' . $style . '1"></p><p class="' . $style . '2"></p><p class="' . $style . '3"></p><p class="' . $style . '4"></p><div class="bs">';
}
function rb($style) {
   echo '</div><p class="' . $style . '1"></p><p class="' . $style . '2"></p><p class="' . $style . '3"></p><p class="' . $style . '4"></p>';
}

function show_warning($str) {
   rt('tw');
   echo '<div class="list-warning">' . $str . '</div>';
   rb('bw');
}
function show_notif($str) {
   rt('tn');
   echo '<div class="list-notif">' . $str . '</div>';
   rb('bn');
}
function show_paging($url, $page, $ndata) {

   $npage = ceil($ndata / get_setting('list'));
   $s = 2 - $page;
   if ($s <= 0)
      $s = 0;
   $p = 2 - ($npage - $page);
   if ($p <= 0)
      $p = 0;
   echo '<div class="list-nobullet"><center>';
   for ($i = 1; $i <= $npage; $i++) {
      if ($npage <= 6)
         if ($i == $page)
            echo '<span class="paging-current">' . $i . '</span>';
         else
            echo '<span class="paging"><a href="' . $url . $i . '">' . $i . '</a></span>';
      else
         if (($i <= $page +1 + $s) && $i >= $page -1 - $p) {
            if ($i == $page)
               echo '<span class="paging-current">' . $i . '</span>';
            else
               echo '<span class="paging"><a href="' . $url . $i . '">' . $i . '</a></span>';
         } else
            if ($i == 1) {
               if ($page < 3)
                  if ($i == $page)
                     echo '<span class="paging">' . $i . '</span>';
                  else
                     echo '<span class="paging"><a href="' . $url . $i . '">' . $i . '</a></span>';
               else
                  echo '<span class="paging"><a href="' . $url . $i . '">' . $i . '<</a></span>';

            } else
               if ($i == $npage)
                  echo '<span class="paging">><a href="' . $url . $i . '">' . $i . '</a></span>';

   }
   echo '</center></div>';
}
function show_blogroll() {
   $sql = mysql_query("select * from blogroll");
   if (mysql_num_rows($sql)) {
      rt('tm');
      echo '<div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/blogroll.png"/> Blogroll</div>';
      while ($res_blogroll = mysql_fetch_assoc($sql)) {
         echo '<div class="list"><a href="http://' . $res_blogroll['url'] . '" target="_blank">' . filter($res_blogroll['name']) . '</a></div>';
      }
      rb('b');
   }
}
function show_category() {
   $sql = mysql_query("select * from category");
   if (mysql_num_rows($sql)) {
      rt('tm');
      echo '<div class="list-nobullet-head"><img src="' . get_setting('blogurl') . '/images/category.png"/> Category</div>';
      while ($res_category = mysql_fetch_assoc($sql)) {
         echo '<div class="list"><a href="' . get_setting('blogurl') . '/category/' . $res_category['url'] . '">' . filter($res_category['name']) . '</a></div>';
  
             
      }
      rb('b');
   }
}
function get_admin($column) {
   $res_user = mysql_fetch_assoc(mysql_query("select * from user where id='1'"));
   return $res_user[$column];
}
function filter($str) {
   $search = array (
      "\\\\",
      "\\0",
      "\\n",
      "\\r",
      "\Z",
      "\'",
      '\"'
   );
   $replace = array (
      "\\",
      "\0",
      "\n",
      "\r",
      "\x1a",
      "'",
      '"'
   );
   return str_replace($search, $replace, $str);
}

function smiley($str) {
   $a = '<img src="' . get_setting('blogurl') . '/images/smilies/';
   $b = '.gif"/>';
   $smiley = array (
      ':)' => $a . 'smile' . $b,
      ':D' => $a . 'biggrin' . $b,
      ':P' => $a . 'tongue' . $b,
      'B)' => $a . 'cool' . $b,
      ':\'(' => $a . 'crying' . $b,
      ':@' => $a . 'angry' . $b,
      ':$' => $a . 'blushing' . $b,
      ':?' => $a . 'confused' . $b,
      ':(' => $a . 'sad' . $b,
      ':O' => $a . 'ohmy' . $b,
      ';)' => $a . 'wink' . $b,
      ':-)' => $a . 'smile' . $b,
      ':-D' => $a . 'biggrin' . $b,
      ':-P' => $a . 'tongue' . $b,
      'B-)' => $a . 'cool' . $b,
      ':-\'(' => $a . 'crying' . $b,
      ':-@' => $a . 'angry' . $b,
      ':-$' => $a . 'blushing' . $b,
      ':-?' => $a . 'confused' . $b,
      ':-(' => $a . 'sad' . $b,
      ':-O' => $a . 'ohmy' . $b,
      ';-)' => $a . 'wink' . $b

   );
   return strtr($str, $smiley);
}
?>