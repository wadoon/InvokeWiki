{*
 * @File: wiki_edit.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/wiki_edit.tpl $
 * $Id: wiki_edit.tpl 20 2008-06-01 13:38:31Z alex953 $
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
{if $smarty.session.loggedIn}
  <h2>Artikel ändern</h2>
  {include file="message.tpl"}
  {if !$do_not_show}

  <form id="edit_article" action="wiki.php" method="post" encoding="utf8">
    <input type="hidden" name="action" value="edit_article" />
    <input type="hidden" name="articleId" value="{$article.Article_Id}" />
    <input type="hidden" name="alias" value="{$article.Alias}" />
    
    <b>Title:</b>{$article.Title}<br>
    <b>Alias:</b>{$article.Alias}<br>
    <b>Artikel:</b><br>
    <textarea name="content" id="textcontent" rows="25"
	      cols="80">{$article.Content}</textarea><br>	
    
    <b>Kommentar zur Änderung:</b><br>
    <textarea name="comment" id="comment" rows="5" cols="40"></textarea>
    <br>
<input type="submit" value="Speichern" />
</form>

{include file="_fancyupload.tpl"}
</div>
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
{/if}
{else} {*no login*}
   {include file="nologin.tpl"}
{/if}
