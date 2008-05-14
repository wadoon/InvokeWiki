<?
require("init.inc.php");

$query = Zend_Search_Lucene_Search_QueryParser::parse($_GET['query']);
$hits = $lucene->search($query);


$sourceHTML;

if( !count($hits) )
  {
    echo '
<div class="error">
      Ihre Suchanfrage ergabe keine Treffer.
</div>';

  }

foreach($hits as $hit)
{
  $sourceHTML .= "<div class='hit'>";
  $doc = $hit->getDocument();
#  var_dump($doc);
 
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
?>