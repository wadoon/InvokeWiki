{if $smarty.session.loggedIn}
<h1>Neuer Artikel</h1>
<form id="new_article" method="post">
  <input type="hidden" name="action" value="new_article" />
  <b>Title:</b>
  <input type="text" name="title" id="title" size="80" value="{$smarty.post.title}" />&nbsp;&nbsp;&nbsp;
  <b>Alias:</b>
  <input type="text" name="alias" id="alias" size="16" value="{$smarty.post.alias}"/><br> 
  <b>Content</b><br>
  <textarea name="content" id="content" rows="25"
	    cols="80">{$smarty.post.content}</textarea><br>	  
<br>
<input type="submit" value="Speichern" />
</form>


<form action="include/_uploadarticle.php" method="post" enctype="multipart/form-data" id="form-demo">
	<fieldset id="demo-fallback">
		<legend>File Upload</legend>
		<p>Wähle ein Datei zum Upload aus:<br />
			<strong>This form is just an example fallback for the unobtrusive behaviour of FancyUpload.</strong>
		</p>
		<label for="demo-photoupload">
			Upload Photos:
			<input type="file" name="photoupload" id="demo-photoupload" />
		</label>
	</fieldset>
 
	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse-all">Browse Files</a> |
			<a href="#" id="demo-browse-images">Browse Only Images</a> |
			<a href="#" id="demo-clear">Clear List</a> |
			<a href="#" id="demo-upload">Upload</a>
		</p>
		<div>
			<strong class="overall-title">Overall progress</strong><br />
			<img src="js/fancyupload/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title">File Progress</strong><br />
			<img src="js/fancyupload/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>
	<ul id="demo-list"></ul> 
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
