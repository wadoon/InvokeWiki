<?
require_once "Zend/Search/Lucene.php";

class Lucene
{
  var $index;

  function Lucene( $ipath )
  {
    try
      {	
	$this->index =  Zend_Search_Lucene::open( $ipath );  
      }
    catch(Exception $e)
      {	
	echo "Create Index ".$ipath;
	$this->index = Zend_Search_Lucene::create($ipath);
      }
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
    
#    Zend_Debug::dump($av);

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
  }

  function search( $query )
  {
    global $logger;
    $logger->info("Search for $query");
    $hits = $this->index->find($query);
    return $hits;
  } 
}
?>