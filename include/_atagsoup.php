<?
/*
 * @File: _atagsoup.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/_atagsoup.php $
 * $Id: _atagsoup.php 20 2008-06-01 13:38:31Z alex953 $
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


function ls($id)
{
  global $db, $logger, $smarty;
  
  require_once 'TagCloud.php';
  
  $taglist =  $db->fetchAll( "SELECT article_tags_id, common_name ,UNIX_TIMESTAMP( created ) as created, count(*) AS c FROM articletags at ".
    " INNER JOIN article_articletags aat ON aat.article_tag_id = at.article_tags_id".
    " GROUP BY article_tags_id, common_name , created, article_id".
    " HAVING article_id = ?", $id);

  if( ! count( $taglist ) ) return '';

  $tags = new HTML_TagCloud();  

  foreach($taglist as $line)
    {
      $tags->addElement($line['common_name'],
                        "search.php?tag=$line[common_name]", $line['c'], $line['created'] );
    }
  print $tags->buildALL();

}

function search($search)
{
  global $db, $logger;
  $search = $_REQUEST['value'];  
  $list = $db->fetchPairs('SELECT DISTINCT *  FROM articletags WHERE common_name LIKE ?', "%$search%");
  
  echo "<ul>";
  foreach($list as $k => $v)
    {
      echo "<li value=\"$k\">$v</li>";
    }
  echo "</ul>";
}

function addname( $articleId , $tagname )
{
  global $db;
  try
  {
    $db->insert('articletags', array( 'Common_Name' => $tagname ));
  }
  catch(Exception $e)
  {
    //nothing
  }  
  $tagid  = $db->fetchOne("SELECT Article_Tags_Id FROM articletags WHERE Common_Name = ? ", $tagname );
  add($articleId, $tagid);
}

function add($articleId, $articleTag)
{
  global $db, $logger;
  
  try 
    {
      $db_array = array('article_id' =>$articleId, 'article_tag_id' => $articleTag);  
      $db->insert('article_articletags',$db_array);
    }
    catch(Exception $e)
     {
	 $logger->err($e->getMessage() . ' ' . __FILE__ . '@' . __LINE__ );
	 throw $e;
       }
}

switch($_REQUEST['action'])
  {
  case "list":
    ls($_GET['articleId']);
    break;
  case "search":
    search($_GET['keyword'] );
    break;
  case 'add':
    add( $_GET['articleId'] , $_GET['articleTag'] );
    break;
  case 'addname':
    addname( $_GET['articleId'] , $_GET['name'] );
    break;
  }
?>