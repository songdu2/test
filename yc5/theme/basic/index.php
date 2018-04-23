<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

트위치 크롤링
<?php
include_once(G5_LIB_PATH.'/Snoopy/Snoopy.class.php');
$snoopy = new snoopy;
$snoopy->referer = "https://www.twitch.tv";
$snoopy->fetch("https://www.twitch.tv/xqcow");
preg_match("/<img class=\"tw-image\" src=\"(.+?)[^>]\" alt=\"xQcOW\">/is",$snoopy->results,$text);
print_r($text);
?>
<br />

유튜브 크롤링
<?php
echo "<img src='http://img.youtube.com/vi/d3DSBYvSp2k/1.jpg'>";
?>
<br />


테스트 크롤링
<?php
include_once(G5_LIB_PATH.'/Snoopy/Snoopy.class.php');
$snoopy = new snoopy;
$snoopy->fetch("http://stock.daum.net/item/main.daum?code=002200");	//결과는 $snoopy->results에 저장되어 있습니다
preg_match("/\<em class=\"curPrice.+\"\>(.*)\<\/em\>/", $snoopy->results, $text);
print_r($text);
?>
<br />

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>