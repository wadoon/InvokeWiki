<?
/*
 * @File: user_rating.inc.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/user_rating.inc.php $
 * $Id: user_rating.inc.php 20 2008-06-01 13:38:31Z alex953 $
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
class UserRating
{
  //Rating_Type_Id 	Common_Name 	Order 	Created 	Weight
  public $ratingTypes;
  public $weight_sum;
  
  function UserRating()
  {
    $this->fetchRatingTypes();
  }
  
  public function fetchRatingTypes()   {
    global $db, $logger;
    $ary = $db->fetchAll('SELECT * FROM ratingtype ORDER BY `order`;');
    
    $this->weight_sum =  0.00;

      
    foreach($ary as $tpel)
    {
      $this->ratingTypes[ $tpel[ 'Rating_Type_Id' ] ] = $tpel;
      $this->weight_sum += $tpel['Weight'];     
    }
#    var_dump($this->ratingTypes);
  }
  
  public function createArticleRating($article) {
    return new UserRatingArticle($this, $article);
  }
  
  public function allArticleRating() {
    
    global $db;
    $article_id = $db->fetchAll("SELECT * FROM article;");
    $values = array();
    foreach($article_id as $id)
    {
      $values[] = array($id, $this->createArticleRating($id['Article_Id']));
    }
    return $values;
  }
  
  public function createTagCloud()  {
    require_once("TagCloud.php");
    $tc= new HTML_TagCloud();
    
    $rating = $this->allArticleRating();
    foreach($rating as $a)
    {
      $article = $a[0];
      $r = $a[1];
      if( $_SESSION['loggedIn'] )
        $tc->addElement( $article['Title'] , 'wiki.php?alias='.$article['Alias'], $r->getWeightedForUser($_SESSION['loggedIn']));
      else
        $tc->addElement( $article['Title'] , 'wiki.php?alias='.$article['Alias'], $r->getWeightedAverage() ) ;
    }
#    var_dump($tc);
    return $tc;
  }
}

class UserRatingArticle
{
  private $userRating;
  public $articleId;
  public $userTags = array();
  private $vector;
  
  public function UserRatingArticle(UserRating & $ur, $articleId)  {
    $this->userRating=$ur;
    $this->articleId = $articleId;
    $this->fetchValues();
  }
  
  private function fetchValues()   {
    global $db, $logger;
    $sql = "SELECT ut.User_Tag_Id, Tag_Desc, Rating_Type_Id, Article_Id, Weight , Avg(Value) AS Value FROM usertags ut 
INNER JOIN ratingtype_usertags_article rut
on ut.User_Tag_Id = rut.User_Tag_Id
JOIN ratingtype rt using(Rating_Type_Id)
where article_id = ?
GROUP BY 1,2,3,4
order by 4";
    
    $ary = $db->fetchAll($sql, $this->articleId);
    
    foreach($ary as $line)
    {
      $this->vector[ $line[ 'Rating_Type_Id' ] ]
                   [ $line[ 'User_Tag_Id'    ] ]  = $line['Value'];
      $this->userTags = $line[ 'User_Tag_Id'    ] = $line['Tag_Desc'];
    }
    unset($ary);
  }
  
  public function getAverageOverUserTags()  {
    $ratings = array();
    
    if($this->vector == null) return null;
    
    foreach($this->vector as $rating_key => $rating_values)
      $ratings[$rating_key]= array_sum($rating_values) / count($rating_values);
      
    return $ratings;
  }
  
  public function getWeightedAverage($ratings = array() )   {
    $ratings = count($ratings) ? $ratings : $this->getAverageOverUserTags();
    $weight_sum = 0.00;
    foreach($this->userRating->ratingTypes as $key => $rating )
    {
      $weight_sum    += (double) $rating['Weight'];
      $ratings[$key] *= (double) $rating['Weight'];
    }    
    $sum = array_sum($ratings) /$weight_sum ;
    return $sum;
  }
  
  public function getAverageOverRatings()   {
    $tags_array;
    $weight_sum = $this->userRating->weight_sum;

    if($this->vector == null) return;

    foreach($this->vector as $rating_key => $rating_values)
      foreach($rating_values as $tag_key => $value)
      {
        $tags_array[ $tag_key ] +=  $value * $this->userRating->ratingTypes[$rating_key]['Weight'];        
      }
        
    for($i=0; $i<count($tags_array); $i++)
      $tags_array[$i] = (double) $tags_array[$i] / $weight_sum;
    return $tags_array;
  }
  
  public function getWeightedForUser($user_id)   {
    global $db;
    $user_tags = $db->fetchCol("SELECT User_Tag_Id FROM users_usertags WHERE User_Id = ? ", $user_id);
    $tags_values = $this->getAverageOverRatings();    
    
    $count = count($tags_values);
    if(!$count) return -1;
    
    foreach($user_tags as $id)
    {
      if( array_key_exists(  $id , $tags_values ) )
      {
        $tags_values[ $id ] *= 3.00; // factor of three
        $count += 2;               // add two more values
      }
    }
    
    $sum = (double) array_sum($tags_values);
    return (double) $sum/$count;
  }
}
?>