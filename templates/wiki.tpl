{*
 * @File: wiki.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/wiki.tpl $
 * $Id: wiki.tpl 20 2008-06-01 13:38:31Z alex953 $
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
 
{include file="header.tpl"}
{if $new_article}
        {include file="wiki_new.tpl"}
        {include file="footer.tpl"}
{elseif $show_edit}
        {include file="wiki_edit.tpl"}
        {include file="footer.tpl"}
{else}
	{if $article_deleted}
	    {include file="wiki_deleted.tpl"}
            {include file="footer.tpl"}		
	{else}
	    {include file="wiki_show.tpl"}
            {include file="wiki_footer.tpl"}
	{/if}
{/if}


