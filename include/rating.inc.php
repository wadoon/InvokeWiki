<?
/*
 * @File: rating.inc.js
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/rating.inc.php $
 * $Id: rating.inc.php 20 2008-06-01 13:38:31Z alex953 $
 * $Author: alex953 $
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

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
		$ary['Value'], $this->articleId);
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
    
    function RatingTag($id, $tagName, $score, $articleId)
    {
        $this->id = $id;
        $this->tagName = $tagName;
        $this->score = $score;
        
        $html = "<div onMouseOut=\"$('id_$id').update('')\"><b>$tagName:</b>";
        for($i = 1; $i <= 5; $i++)
        {
            $html.="<img src='icons/star.png' onMouseOver=\"$('id_$id').update($i)\"
		    onClick=\"rate( $articleId,{$this->id},$i)\" class='rate ";
            if($i<=$score)
                $html.="active";
            else
                $html.="inactive";
            $html.="' />";
        }
	$html.="<b id='id_$id' ></b>";
        $this->html = $html;
    }
}
?>
