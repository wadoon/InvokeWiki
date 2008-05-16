{debug}
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <script language="javascript" type="text/javascript"
	src="../js/tinymce/tiny_mce_popup.js"></script>

    <script language="javascript" type="text/javascript"
	    src="../js/prototype.js"></script>

    {literal}
    <style>
      .selected {background:navy !important; color:#ccc !important; font-weight:600; } 
      tr,td { cursor:hand; }
      tr:hover {background:#ccc; color:navy};
    </style>
    
    <script language="javascript">
      var c_element;
      var url      ;
      
      function act( element, link) {
       alert(link);
       if( c_element != null )
        c_element.removeClassName('selected');      
       c_element = element;      
       url = link   
       element.addClassName('selected');
      }

      var FileBrowserDialogue = {
      init : function () {
      // Here goes your code for setting your custom things onLoad.
      },
      mySubmit : function () {
        var win = tinyMCEPopup.getWindowArg("window");
      
        // insert information now
        win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = url;
      
      // for image browsers: update image dimensions
        if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
        if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(url);
      
      // close popup window
        tinyMCEPopup.close();
       }
      }
      tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script>
</head>
<body>
{/literal}
<a href="javascript:FileBrowserDialogue.mySubmit()">Ok</button>
<table>
  <tr>
    <th>Name</th>
    <th>Größe</th>
    <th>Datum</th>
  </tr>
{foreach from=$files item=file key=key}
  <tr onClick="act(this, '{$file.url}' );">
    <td >{$file.name}</td>
    <td>{$file.size}</td>
    <td>{$file.date|date_format}</td>
  </tr>
{/foreach}
</body>
</html>
