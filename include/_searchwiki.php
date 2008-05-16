<?
require("init.inc.php");


if($_GET['query'])
  {
    $query = Zend_Search_Lucene_Search_QueryParser::parse($_GET['query']);
    $hits = $lucene->search($query);
     
    $sourceHTML;
    
    if( !count($hits) )
      {
	echo '<div class="error">Ihre Suchanfrage ergabe keine Treffer.</div>';
      }
    else
      { 
	foreach($hits as $hit)
	  {
	    $sourceHTML .= "<div class='hit'>";
	    $doc = $hit->getDocument();
	    
	    $sourceHTML .= '<a href="wiki.php?alias='.
	      $doc->getFieldValue("Alias"). '&version_no='.
	      $doc->getFieldValue("Version").'">'.
	      "<b style='font-size:14pt'>".$doc->getFieldValue('Title')."</b></a> - ";
	    
	    $sourceHTML .= $doc->getFieldValue("body");
	    
	    $sourceHTML .="<div class='small'><b>Erstellt am:</b> ".
	      $doc->getFieldValue("Created")."<b>Id:</b>$hit->id <b>Score:</b> $hit->score - ";
	    $sourceHTML .=$doc->getFieldValue('FirstName'). ' '.
	      $doc->getFieldValue('LastName') .' &lt;'.
	      $doc->getFieldValue('EMail').'&gt;</div>';
	    
	    $sourceHTML .= "</div>";
	  }
	echo  $query->highlightMatches($sourceHTML);
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
ORDER BY Version_No DESC, Created DESC" , $_GET['tag'] );
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
	    echo "<div class='hit'>";
	    echo '<a href="wiki.php?alias='.
	      $hit["Alias"]. '&version_no='.
	      $hit["Version_No"].'">'.
	      "<b style='font-size:14pt'>".$hit['Title']."<sup>$hit[Version_No]</sup></b></a> - ";
	    
	    echo substr( strip_tags( $hit['Content'] ), 0,50);
	
	    echo "<div class='small'><b>Erstellt am:</b> ".
	      $hit['Created'];
	    echo " Ersteller: ";
	    echo $hit['First_Name']. ' '.
	      $hit['Last_Name'] .' &lt;'.
	      $hit['E_Mail'].'&gt;</div>';	    
	    echo "</div>";
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