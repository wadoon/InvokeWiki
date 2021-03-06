<?
/*
 * @File: _tagsoup.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/_tagsoup.php $
 * $Id: _tagsoup.php 20 2008-06-01 13:38:31Z alex953 $
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
 
require_once('init.inc.php');
function ls()
{
  global $db, $logger, $smarty;

  require_once 'TagCloud.php';

  $sql = "SELECT usertags.user_tag_id , tag_desc , count( user_id ) as c
    FROM usertags
    LEFT JOIN users_usertags ON users_usertags.user_tag_id = usertags.user_tag_id
WHERE user_id = $_SESSION[loggedIn]
GROUP BY  users_usertags.user_tag_id , tag_desc
ORDER BY 3 DESC;";

  $list = $db->fetchAll( $sql );
  $tags = new HTML_TagCloud();
  
  foreach($list as $line)
    {
      $tags->addElement($line['tag_desc'], "javascript:deleteTag($_SESSION[loggedIn], $line[user_tag_id])", $line['c']);
    }
  print $tags->buildALL();
}

function search()
{
  global $db, $logger;

  $search = $_REQUEST['value'];
  
  $list = $db->fetchPairs('SELECT user_tag_id, tag_desc FROM usertags WHERE tag_desc LIKE ?', "%$search%");
  
  echo "<ul>";
  foreach($list as $k => $v)
    {
      echo "<li value=\"$k\">$v</li>";
    }
  echo "</ul>";
}

function add()
{
  global $db, $logger;
  $tag_id = $_REQUEST['id'];
  $user_id = $_SESSION['loggedIn'];

  try
    {$db->insert('users_usertags', array('user_id'=>$user_id, 'user_tag_id'=>$tag_id  ));
      $logger->info("added $user_id user to tag $tag_id");
    }catch(Exception $e)
       {
	 $logger->err($e->getMessage());
       }

}
function delete()
{
  global $db, $logger;
  $tag_id = $_REQUEST['id'];
  $user_id = $_SESSION['loggedIn'];

  try
    {
      $db->delete('users_usertags', 'user_id='.$user_id . ' AND user_tag_id='.$tag_id  );
      $logger->info("added $user_id user to tag $tag_id");
    }catch(Exception $e)
       {
	 $logger->fatal($e->getMessage());
       }

}

#print_r($_REQUEST);

switch($_REQUEST['action'])
  {
  case "list":
    ls();
    break;
  case "search":
    search();
    break;
  case 'add':
    add();
    break;
  case 'delete':
    delete();
    break;
  }
?>