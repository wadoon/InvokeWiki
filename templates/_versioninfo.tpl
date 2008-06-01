{*
 * @File: _versioninfo.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/_versioninfo.tpl $
 * $Id: _versioninfo.tpl 20 2008-06-01 13:38:31Z alex953 $
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
{debug}
<table>
  <tr>
    <th>Version</th>
    <th>Informationen</th>
    {foreach from=$versions item=version}
  <tr>
    <th>
      {if $version.Version_No == $version_no}
      <b>{$version_no}</b>
      {else}
      <a href="wiki.php?alias={$article.Alias}&version_no={$version.Version_No}">{$version.Version_No}</a>
      {/if}
    </th>
    <td>{$version.First_Name} {$version.Last_Name} erstellte am {$version.Created}.
      
      <div style="font-size:8pt">
	Kommentar:  {$version.Comment}
      </div>
    </td>
  </tr>
  {/foreach}
</table>
