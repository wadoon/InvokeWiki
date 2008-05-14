<?
require_once("init.inc.php");
require_once("rating.inc.php");

$rating = new Rating($article_id);

$rating->update($ratingTypeId, $_GET['rating']);

$rating->init();

foreach($rating->ratings as $rat)
{
    if( $rat->id  == $ratingTypeId)
        echo $rat->html;
}
?>