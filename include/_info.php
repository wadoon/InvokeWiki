<?
/*
 * @File: _info.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/_info.php $
 * $Id: _info.php 20 2008-06-01 13:38:31Z alex953 $
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

function tagcloud_article_w()
{
  require("user_rating.inc.php");
  $ur = new UserRating();
  echo $ur->createTagCloud()->buildAll();
}


function tagcloud_article()
{
  global $db, $logger;
  require_once("TagCloud.php");
  $tc = new HTML_TagCloud();

  $sql = "SELECT Common_Name, Created, COUNT(at.Article_Tag_Id) AS Count".
    " FROM articletags NATURAL JOIN article_articletags at GROUP BY Common_Name, Created; ";

  $tags = $db->fetchAll($sql);
   
  foreach($tags as $tag)
    {
      $tc->addElement($tag['Common_Name'], 'search.php?tag='.$tag['Common_Name'], $tag['Count'], $tag['Created']);
    }
  echo $tc->buildAll();
}

function indexstats()
{
  global $lucene;
  echo "Indexgröße: " . $lucene->getIndexSize() . " KB | Dokumente:  " . $lucene->getDocsCount() ;
}

function latestusers($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $users = $db->fetchAll("SELECT * FROM users ORDER BY Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($users as $user)
    echo "<li> $user[First_Name] $user[Last_Name]</li>";
  echo "</ul>";
}

function latestarticles($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $articles = $db->fetchAll("SELECT Alias, Title FROM article ORDER BY Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($articles as $article)
    echo "<li><a href='wiki.php?alias=$article[Alias]'>$article[Title]</li>";
  echo "</ul>";
}
         
function latestversions($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $articles = $db->fetchAll("SELECT Alias, v.Created, Title FROM article a ".
			 " INNER JOIN articleversion v ORDER BY v.Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($articles as $article)
    echo "<li><a href='wiki.php?alias=$article[Alias]'>$article[Title]</li>";
  echo "</ul>";
}

try
{
  call_user_func  ($action, explode(',',$param));
}
catch(Exception $e)
{
  echo "<div class='error'>Function $action does not exits ".$e->getMessage()."</div>";
}
?>