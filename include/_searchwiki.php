<?
/*
 * @File: _searchwiki.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/_searchwiki.php $
 * $Id: _searchwiki.php 20 2008-06-01 13:38:31Z alex953 $
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
 
require("init.inc.php");

$lastversion=null;

//at.Common_Name, a.Alias,  a.Title, a.Article_Id, av.Version_No , u.E_Mail, u.Last_Name, u.First_Name, av.Content , av.Created

function buildHtml($hit)
{
  global $lastversion;

  if( $hit['Article_Id']  == $lastversion) return;
  $lastversion = $hit['Article_Id'];
   
  echo "<div class='hit'>";
  echo '<a href="wiki.php?alias='.
    $hit["Alias"]. '&version_no='.
    $hit["Version_No"].'">'.$hit['Title']."</a> - ";
  
  echo substr( stripslashes( strip_tags(  $hit['Content'] ) ), 0,50);
  
  echo "<div class='small'><strong>Erstellt am:</strong> ". $hit['Created'] ;
  echo " <strong>Ersteller: </strong>";
  echo $hit['First_Name']. ' '.
    $hit['Last_Name'] .' &lt;'.
    $hit['E_Mail'].'&gt;<br />'. $hit['further'] .'</div>';	    
  echo "</div>";
  
}


if($_GET['query'])
  {
    $query = Zend_Search_Lucene_Search_QueryParser::parse($_GET['query']);
    $hits = $lucene->search($query);
   
    if( !count($hits) )
      {
	echo '<div class="error">Ihre Suchanfrage ergabe keine Treffer.</div>';
      }
    else
      { 
	foreach($hits as $hit)
	  {
	    
	    $doc = $hit->getDocument();
	    #var_dump($doc);
	    $ary = array(
	      'Alias'      => $doc->getFieldValue("Alias"), 
	      'Title' 	   => $doc->getFieldValue('Title'), 
	      'Article_Id' => $doc->getFieldValue('Id'), 
	      'Version_No' => $doc->getFieldValue("Version"),
	      'E_Mail'	   => $doc->getFieldValue('EMail'),
	      'Last_Name'  => $doc->getFieldValue('LastName'),
	      'First_Name' => $doc->getFieldValue('FirstName'),
	      'Content'    => $doc->getFieldValue("body"),
	      'Created'    => $doc->getFieldValue("Created"),
	      'further'    => "<b>Id:</b> $hit->id <b>Score:</b> $hit->score"
	      );
	    buildHtml($ary);
	  }
      }
  }
elseif($_GET['tag']) //Search after Tag
  {
    $article = $db->fetchAll(
"SELECT at.Common_Name, a.Alias,  a.Title, a.Article_Id, av.Version_No , u.E_Mail, u.Last_Name, u.First_Name, av.Content , av.Created
FROM articletags at 
INNER JOIN article_articletags aat 
  ON aat.article_tag_id = at.article_tags_id
INNER JOIN article a 
  ON a.article_id = aat.article_id
INNER JOIN articleversion av 
  ON av.article_id = a.article_id
INNER JOIN users u
  ON u.user_id = av.creator
WHERE 
  Common_Name = ?
ORDER BY Article_Id DESC, Version_No DESC, Created DESC" , $_GET['tag'] );
    /* 'Common_Name' => string 'Programmierung' (length=14)
     * 'title' => string 'Test01' (length=6)
       'article_id' => int 2
       'version_no' => int 4
       'E_Mail' => string 'alex@test1.com' (length=14)
       'Last_Name' => string 'Weigl' (length=5)
       'First_Name' => string 'Alexander' (length=9)
       'Content' => string '<p>Der Text ist schei&szlig;e!?</p>' (length=35)
       'Created' => string '2008-05-11 12:17:30' (length=19)
    */
    if(count($article))
      {
	foreach($article as $hit)
	  {
	   buildHtml($hit);
	  }   
      }
    else
      {
	echo '<div class="error">Ihre Suchanfrage ergabe keine Treffer.</div>';
      }
  }
 else
   {
     echo "<div class='error'>Die Anfrage ist falsche, keine Parameter. fck off!</div>";
   }
?>