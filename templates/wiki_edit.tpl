{if $smarty.session.loggedIn}
<h1>Artikel ändern</h1>
<form id="edit_article" action="wiki.php" method="post" encoding="utf8">
  <input type="hidden" name="action" value="edit_article" />
  <input type="hidden" name="articleId" value="{$article.Article_Id}" />
  <input type="hidden" name="alias" value="{$article.Alias}" />
  
  <b>Title:</b>{$article.Title}<br>
  <b>Alias:</b>{$article.Alias}<br>
  <b>Artikel:</b><br>
  <textarea name="content" id="content" rows="25"
	    cols="80">{$article.Content}</textarea><br>	
  
  <b>Kommentar zur Änderung:</b><br>
  <textarea name="comment" id="comment" rows="5" cols="40"></textarea>
  <br>

  <div id="flashUI1" style="display: none;">
    <div class="flash" id="fsUploadProgress1"></div>
    <div>
      <input type="button" value="Datei hochlaoden" 
	     onclick="upload1.selectFiles()" style="font-size: 8pt;" />
      <input id="btnCancel1" type="button" value="Cancel Uploads" 
	     onclick="cancelQueue(upload1);" disabled="disabled" 
	     style="font-size: 8pt;" /><br />
    </div>
  </div>
  <div id="degradedUI1">
    <legend>Upload</legend>
    <input type="file" name="anyfile1" /> (Any file, Max 100 MB)<br/>
    </fieldset>
<div>
  <input type="submit" value="Submit Files" />
</div></div>
<br>
<input type="submit" value="Speichern" />

</form>

<script language="javascript" type="text/javascript"
	src="js/fancyupload/mootools-trunk-1553.js"></script>
<script language="javascript" type="text/javascript"
	src="js/fancyupload/Fx.ProgressBar.js"></script>
<script language="javascript" type="text/javascript"
	src="js/fancyupload/Swiff.Uploader.js"></script>
<script language="javascript" type="text/javascript"
	src="js/fancyupload/FancyUpload2.js"></script>
<script language="javascript" type="text/javascript"
	src="js/fancyupload/fu_impl.js"></script>

<script language="javascript" type="text/javascript"
	src="js/tinymce/tiny_mce.js"></script>

<script language="javascript" type="text/javascript"
	src="js/tinymce/tm_impl.js"></script>

<script language="javascript" type="text/javascript">
  var cmsURL="{$config.root_url}include/_filebrowser.php";
</script>

{else} {*no login*}
{include file="nologin.tpl"}
{/if}
