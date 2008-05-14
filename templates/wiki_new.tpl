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

{literal}
<script type="text/javascript"
	src="js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.graceful_degradation.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script language="javascript" type="text/javascript" src="js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript">
var upload1; 

window.onload = function() {
  upload1 = new SWFUpload({
  // Backend Settings
  upload_url: "include/_uploadarticle.php" ,
  post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},

   // File Upload Settings
  file_size_limit : "102400",	// 100MB
  file_types : "*.*",
  file_types_description : "All Files",
  file_upload_limit : "10",
  file_queue_limit : "0",

// Event Handler Settings (all my handlers are in the Handler.js file)
  file_dialog_start_handler : fileDialogStart,
  file_queued_handler : fileQueued,
  file_queue_error_handler : fileQueueError,
  file_dialog_complete_handler : fileDialogComplete,
  upload_start_handler : uploadStart,
  upload_progress_handler : uploadProgress,
  upload_error_handler : uploadError,
  upload_success_handler : uploadSuccess,
  upload_complete_handler : uploadComplete,

// Flash Settings
  flash_url : "js/swfupload/swfupload_f9.swf",
				
  swfupload_element_id : "flashUI1",
  swfupload_id : "flashUI1",
  degraded_element_id : "degradedUI1",
  custom_settings : {
   a_dom_setting : $('flashUI1'),
   progressTarget : "fsUploadProgress1",
   cancelButtonId : "btnCancel1"
  },
  // Debug Settings
  debug: true
  }); 
};

</script>

<script language="javascript" type="text/javascript">
  tinyMCE.init({
    theme : "advanced",
    mode: "exact",
    elements : "content",
    theme_advanced_toolbar_location : "top",
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
    + "bullist,numlist,outdent,indent",
    theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
    +"undo,redo,cleanup,code,separator,sub,sup,charmap",
    theme_advanced_buttons3 : "",
    height:"350px",
    width:"600px",
    file_browser_callback : 'myFileBrowser'
  });

  function myFileBrowser (field_name, url, type, win) {
    var fileBrowserWindow = new Array();
    fileBrowserWindow['title'] = 'File Browser';
    fileBrowserWindow['file'] = "my_cms_script.php" + "?type=" + type;
    fileBrowserWindow['width'] = '420';
    fileBrowserWindow['height'] = '400';
    tinyMCE.openWindow(fileBrowserWindow, { window : win, resizable : 'yes', inline : 'yes' });
    return false;
  }
</script>


{/literal}
{else} {*no login*}
{include file="nologin.tpl"}
{/if}
