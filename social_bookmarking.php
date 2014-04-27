<?php
// social bookmarking
// what is?
/*
Social bookmarking is a method for Internet users to share, organize, search, and manage bookmarks of web resources. 
Unlike file sharing, the resources themselves aren't shared, merely bookmarks that reference them.
*/
// http://en.wikipedia.org/wiki/Social_bookmarking

// define the correct link
function selfURL()
{
$s = empty($_SERVER["HTTPS"]) ? ''
: ($_SERVER["HTTPS"] == "on") ? "s"
: "";
$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
: (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2)
{
return substr($s1, 0, strpos($s1, $s2));
}

// store this for backup if selfURL dont work
//$l = $_SERVER['QUERY_STRING'];
//$l = selfURL();

// define title of site
// this definition is valid for some sites
// $t = "my+title";
// to define your link must use $l into function

// function for each site
// twitter
function twitter()
{     
    
    $l = selfURL();
     //example
     //http://twitter.com/home?status=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //real link - your link
     //http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //result
     //http://twitter.com/home?status=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     $social = "<a href=\"http://twitter.com/home?status=$l\"/><img src=\"/images/social/twitter.png\" align =\"middle\" border =\"0\" width =\"16\" height =\"16\" alt =\"twitter\" /></a>";
      return $social;
}

// how to call twitter on your page?
// place echo twitter(); below your post in forum,site index,forum zone,chat,etc...

function facebook()
{     
     $l = selfURL();
     //example
     //http://www.facebook.com/share.php?u=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //real link - your link
     //http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //result
     //http://www.facebook.com/share.php?u=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     $social = "<a href=\"http://www.facebook.com/share.php?u=$l\"/><img src=\"/images/social/fb.png\" align =\"middle\" border =\"0\" width =\"16\" height =\"16\" alt =\"facebook\" /></a>";
      return $social;
}
// how to call facebook on your page?
// place echo facebook(); below your post in forum,site index,forum zone,chat,etc...

function digg()
{     
     $l = selfURL();
     $t = "my+title";
     //example
     //http://digg.com/submit?phase=2&url=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935&title=my+title
     //real link
     //http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //result
     //http://digg.com/submit?phase=2&url=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935/&title=my+title
     $social = "<a href=\"http://digg.com/submit?phase=2&url=$l/&title=$t\"/><img src=\"/images/social/digg.png\" align =\"middle\" border =\"0\" width =\"16\" height =\"16\" alt =\"digg\" /></a>";
      return $social;
}

// how to call digg on your page?
// place echo digg(); below your post in forum,site index,forum zone,chat,etc...

function delicious()
{     
     $l = selfURL();
     //example
     //http://del.icio.us/save?url=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //real link - your link
     //http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     //result
     //http://del.icio.us/save?url=http://ngeo.ro/index.php?type=forums&mobile=read&forum=auto&fifty-ugliest-cars-of-the-past-50-years&Valter&id=935
     $social = "<a href=\"http://del.icio.us/save?url=$l\"/><img src=\"/images/social/delicious.png\" align =\"middle\" border =\"0\" width =\"16\" height =\"16\" alt =\"delicious\" /></a>";
      return $social;
}
// how to call delicious on your page?
// place echo delicious(); below your post in forum,site index,forum zone,chat,etc...

?>