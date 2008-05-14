<?
require_once("init.inc.php");

class Rating {
    var $articleId;
    var $ratings = array();
    var $average = 0;
    function Rating($articleId)
    {
        $this->articleId=$articleId;
        $this->init();    
    }
    
    function init()
    {
        global $db;
        $this->ratings = array();
	$ratings = $this->getRatingTypes();
	$weight_sum = 0;
        $avg = array();
	foreach($ratings as $rat)
	{
            $weight_sum+=$rat['Weight'];
            $sql = "SELECT Rating_Type_Id ,Article_ID, "
                   ." Avg(Value) AS Value"
                   ." FROM ratingtype_usertags_article rta"
                   ." WHERE rta.rating_type_id = ? AND rta.article_id = ?"
                   ." GROUP BY 1,2";
		$ary = $db->fetchRow($sql,
			array( $rat['Rating_Type_Id'] , $this->articleId) );
            $r = new RatingTag(
		$rat['Rating_Type_Id'],	$rat['Common_Name'],
		$ary['Value']);
            $avg[]=$ary['Value']*$rat['Weight'];
	    $this->ratings[] = $r;
        }
	$weight_sum = $weight_sum ?$weight_sum :1;
	$count =      count($avg) ? count($avg):1;

        $this->average = array_sum($avg)/ $weight_sum /$count ;
    }
    
	function getRatingTypes()
	{
		global $db;
		$sql = "SELECT * FROM ratingtype rt  ORDER BY `order` DESC";
		return $db->fetchAll($sql);
	}
	
    function update($ratingType, $rating)
    {
        global $db,$logger;
        $user_id = $_SESSION['loggedIn'];
        $db_array = array(
                     'Rating_Type_Id' => $ratingType,
                     'Value'=>$rating,
                     'User_Id' =>$user_id,
                     'Article_Id'=>$this->articleId
                    );
        $user_tag_id = $db->fetchCol("SELECT user_tag_id  FROM users_usertags WHERE user_id =?", $user_id);

#	var_dump($user_tag_id);
        foreach($user_tag_id as $id)
        {
            try
            {
                $db_array['User_Tag_Id'] = $id;
		#var_dump($db_array);
                $db->insert('ratingtype_usertags_article', $db_array);
		$db->commit();
            }catch(Exception $e)
            {
                $logger->err($e);
                #echo "<div class='error'>",$e->getMessage(),'</div>';
            }
        }
    }
}

class RatingTag {
    var $id;
    var $tagName;
    var $score;
    var $html;
    
    function RatingTag($id, $tagName, $score)
    {
        $this->id = $id;
        $this->tagName = $tagName;
        $this->score = $score;
        
        $html = "<div><b>$tagName:</b>";
        for($i = 1; $i <= 5; $i++)
        {
            $html.="<img src='icons/";
            if($i<=$score)
                $html.="star.png";
            else
                $html.="star_d.png";
            $html.="'/>";
        }
        $this->html = $html;
    }
}
?>
