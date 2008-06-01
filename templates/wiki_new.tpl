{*
 * @File: wiki_new.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/wiki_new.tpl $
 * $Id: wiki_new.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<h2>Neuer Artikel</h2>
<form id="new_article" method="post">
  <input type="hidden" name="action" value="new_article" />
  <b>Title:</b>
  <input type="text" name="title" id="title" size="50" value="{$smarty.post.title}" />&nbsp;&nbsp;&nbsp;
  <b>Alias:</b>
  <input type="text" name="alias" id="alias" size="16" value="{$smarty.post.alias}"/><br> 
  <b>Content</b><br>
  <textarea name="content" id="textcontent" rows="25" cols="80">{if $smarty.post.content} {$smarty.post.content} {else}
    {include file="wiki_article_.tpl"}
  {/if}</textarea><br />	  
<br>
<input type="submit" value="Speichern" />
</form>


{include file="_fancyupload.tpl"}

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
