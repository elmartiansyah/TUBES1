<?
// User settings
$rater_ip_voting_restriction = true; // restrict ip address voting (true or false)
$rater_ip_vote_qty=1; // how many times an ip address can vote
$rater_already_rated_msg="Maaf anda sudah vote halaman ini.";
$rater_not_selected_msg="Nilai belum dipilih.";
$rater_thankyou_msg="Terima kasih.";
$rater_generic_text=""; // generic item text
$rater_end_of_line_char="\n"; // may want to change for different operating systems



if(!isset($rater_id)) $rater_id=1;
if(!isset($rater_item_name)) $rater_item_name=$rater_generic_text;


// DO NOT MODIFY BELOW THIS LINE
$rater_filename='rate/blog_'.$rater_id.".rating";
$rater_rating=0;
$rater_stars="";
$rater_stars_txt="";
$rater_rating=0;
$rater_votes=0;
$rater_msg="";

// Rating action
if(isset($_REQUEST["rate".$rater_id])){
 if(isset($_REQUEST["rating_".$rater_id])){
  while(list($key,$val)=each($_REQUEST["rating_".$rater_id])){
   $rater_rating=$val;
  }
  $rater_ip = getenv("REMOTE_ADDR"); 
  $rater_file=fopen($rater_filename,"a+");
  $rater_str="";
  $rater_str = rtrim(fread($rater_file, 1024*8),$rater_end_of_line_char);
  if($rater_str!=""){
   if($rater_ip_voting_restriction){
    $rater_data=explode($rater_end_of_line_char,$rater_str);
	$rater_ip_vote_count=0;
    foreach($rater_data as $d){
	 $rater_tmp=explode("|",$d);
	 $rater_oldip=str_replace($rater_end_of_line_char,"",$rater_tmp[1]);
	 if($rater_ip==$rater_oldip){
	  $rater_ip_vote_count++;
	 }
    }
	if($rater_ip_vote_count > ($rater_ip_vote_qty - 1)){
     $rater_msg=$rater_already_rated_msg;
	}else{
     fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
     $rater_msg=$rater_thankyou_msg;
	}
   }else{
    fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
    $rater_msg=$rater_thankyou_msg;
   }
  }else{
   fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
   $rater_msg=$rater_thankyou_msg;
  }
  fclose($rater_file);
 }else{
  $rater_msg=$rater_not_selected_msg;
 }
}

// Get current rating
if(is_file($rater_filename)){
 $rater_file=fopen($rater_filename,"r");
 $rater_str="";
 $rater_str = fread($rater_file, 1024*8);
 if($rater_str!=""){
  $rater_data=explode($rater_end_of_line_char,$rater_str);
  $rater_votes=count($rater_data)-1;
  $rater_sum=0;
  foreach($rater_data as $d){
   $d=explode("|",$d);
   $rater_sum+=$d[0];
  }
  $rater_rating=number_format(($rater_sum/$rater_votes), 2, '.', '');
 }
 fclose($rater_file);
}else{
 $rater_file=fopen($rater_filename,"w");
 fclose($rater_file);
}

// Assign star image
if ($rater_rating <= 0  ){$rater_stars = "./rate/img/00star.gif";$rater_stars_txt="0%";}
if ($rater_rating >= 0.5){$rater_stars = "./rate/img/05star.gif";$rater_stars_txt="10%";}
if ($rater_rating >= 1  ){$rater_stars = "./rate/img/1star.gif";$rater_stars_txt="20%";}
if ($rater_rating >= 1.5){$rater_stars = "./rate/img/15star.gif";$rater_stars_txt="30%";}
if ($rater_rating >= 2  ){$rater_stars = "./rate/img/2star.gif";$rater_stars_txt="40%";}
if ($rater_rating >= 2.5){$rater_stars = "./rate/img/25star.gif";$rater_stars_txt="50%";}
if ($rater_rating >= 3  ){$rater_stars = "./rate/img/3star.gif";$rater_stars_txt="60%";}
if ($rater_rating >= 3.5){$rater_stars = "./rate/img/35star.gif";$rater_stars_txt="70%";}
if ($rater_rating >= 4  ){$rater_stars = "./rate/img/4star.gif";$rater_stars_txt="80%";}
if ($rater_rating >= 4.5){$rater_stars = "./rate/img/45star.gif";$rater_stars_txt="90%";}
if ($rater_rating >= 5  ){$rater_stars = "./rate/img/5star.gif";$rater_stars_txt="100%";}


// Output
echo '<div xmlns:v="http://rdf.data-vocabulary.org/#" typeof="v:Review-aggregate"><form method="post" action="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">';
echo '<span  class="rating"><img src="'.$rater_stars.'" alt="'.$rater_stars_txt.' stars" /> Rating : <span rel="v:rating"><span typeof="v:Rating"><span property="v:average">'.$rater_stars_txt.'</span></span></span> Dari <span property="v:votes">'.$rater_votes.'</span> User';
echo '<br/>';
echo '<select class="kombo" name="rating_'.$rater_id.'[]">
<option value="5" selected>5 (Keren)</option>
<option value="4">4 (Bagus)</option>
<option value="3">3 (Lumayan)</option>
<option value="2">2 (Cukup)</option>
<option value="1">1 (Jelek)</option>
</select> ';
echo '<input type="hidden" name="rs_id" value="'.$rater_id.'" />';
echo '<input type="submit" name="rate'.$rater_id.'" value="Vote" />';
if($rater_msg!="") echo "<div>".$rater_msg."</div>";
echo '</form></div>';
?>

