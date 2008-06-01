{*
 * @File: wiki_show.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/wiki_show.tpl $
 * $Id: wiki_show.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<h1>{$article.Title}</h1>
<div class="wiki_article">
  {if (!$article.Closed) or  $smarty.session.is_admin == 1}
  <div style="float:right">    
    <a href="?action=show_edit&alias={$article.Alias}&articleId={$article.Article_Id}">	 
      <img src="icons/pencil.png" alt="Pencil" width="15" height="15" />Bearbeiten</a>
  </div>
  {/if}

{*
     <div class="sub">
     	  ArticleId: {$article.Article_Id} - 
	  Creator:   {$article.Creator} -
	  Created:   {$article.Created} -
	  Alias:     {$article.Alias} -
	  Version:   {$article.Version_No} -
	  Comment:   {$article.Comment}
     <div>
*}
     <div id="wiki_content">
	  {$article.Content}     
     </div>
</div>
     
