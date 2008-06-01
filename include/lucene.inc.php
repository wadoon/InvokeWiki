<?
/*
 * @File: lucene.inc.js
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/lucene.inc.php $
 * $Id: lucene.inc.php 20 2008-06-01 13:38:31Z alex953 $
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
 
require_once "Zend/Search/Lucene.php";

class Lucene
{
  private $index;
  public $index_path;
  
  function Lucene( $ipath )
  {
    $this->index_path = $ipath;
    $this->openIndex();    
  }
  
  private function openIndex()
  {
      try
      {	
	$this->index =  Zend_Search_Lucene::open( $this->index_path );  
      }
    catch(Exception $e)
      {	
	echo "Create Index ".$ipath;
	$this->index = Zend_Search_Lucene::create( $this->index_path);
      }
  }
  
  public function newIndex()
  {    
    echo "Remove index path: " . $this->index_path;
    
    unset($this->index);
    
    foreach( glob( $this->index_path . "/*" ) as $file )
    {
      echo "\nRemove $file";
      unlink($file) or die("Error!");
    }
    
    
    rmdir( $this->index_path );
    echo " ... finished\n";
    
    echo "Create folder: " . $this->index_path;    
    mkdir( $this->index_path );
    echo " ... finished\n";
    
    $this->openIndex();
    echo "\n------------------------------------------------------\n";
  }
  

  function getIndexSize()
  {
    return $this->index->count();
  }

  function getDocsCount()
  {
    return $this->index->numDocs();
  }
  
  function getIndex()
  {
    return $this->index;
  }

  function delete($articleId, $version)
  {
    $query = "Article_Id: $articleId AND Version_No: $version";
    $hits = $this->search( $query );
    foreach ($hits as $hit) 
      $this->index->delete($hit->id);
  }

  function indexArticleVersion($articleId, $version)
  {
    global $db, $logger;
    $logger->info("Index: $articleId, $version");
    $this->delete( $articleId, $version );
    
    $av = $db->fetchRow("SELECT * FROM article a".
			" INNER JOIN articleversion v".
			" ON  a.article_id = v.article_id".
			" INNER JOIN users u on u.User_Id = v.Creator " .
			" WHERE a.article_id = ? and v.version_no = ?;", array($articleId, $version) );

    if(count($av)==0)
      {
	throw new Exception("Kein Datensatz mit $articleId - $version vorhanden");
      }
    else
      {
	$this->indexArticleArray($av);
      }
  }
  public function indexArticleArray(array $av)
  {
    #Zend_Debug::dump($av);
    $doc = Zend_Search_Lucene_Document_Html::loadHTML($av['Content'], true);
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Created',$av['Created'] ));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Updated',time()));
    $doc->addField(Zend_Search_Lucene_Field::Text('Title', $av['Title']));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('comment', $av['Comment']));
    $doc->addField(Zend_Search_Lucene_Field::Text('Alias', $av['Alias']));
    $doc->addField(Zend_Search_Lucene_Field::Text('Id', $av['Article_Id']));
    $doc->addField(Zend_Search_Lucene_Field::Text('Version', $av['Version_No']));
    $doc->addField(Zend_Search_Lucene_Field::Text('LastName', $av['Last_Name']));
    $doc->addField(Zend_Search_Lucene_Field::Text('FirstName', $av['First_Name']));
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('EMail', $av['E_Mail']));

    require_once("HttpClient.class.php");

    $linksArray = $doc->getLinks();
    foreach($linksArray as $link)
      $response .= $pageContents = HttpClient::quickGet($link, array("timeout"=>2), $info);         

    $doc->addField(Zend_Search_Lucene_Field::Text('rel_infor', $response));
    
#    Zend_Debug::dump($doc);
    $this->index->addDocument($doc);
    $this->index->commit();
  }

  function search( $query )
  {
    global $logger;
    $logger->info("Search for $query");

    $hits = $this->index->find($query , 'Id' , SORT_NUMERIC, SORT_DESC);
    return $hits;
  } 
}
?>