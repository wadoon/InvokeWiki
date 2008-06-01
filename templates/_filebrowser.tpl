{*
 * @File: _filebrowser.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/_filebrowser.tpl $
 * $Id: _filebrowser.tpl 20 2008-06-01 13:38:31Z alex953 $
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
 *}

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
