{*
 * @File: footer.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/footer.tpl $
 * $Id: footer.tpl 20 2008-06-01 13:38:31Z alex953 $
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
</div><!--col 1-->

<div id="col3"> 
	    <p>
	    {include file="_latestuser.tpl"}
			{include file="_latestversions.tpl"}
			{include file="_latestarticles.tpl"}
	    </p>
	</div><!--End Right-->
</div> <!-- END MAIN -->
<div id="footer">
<a href="http://www.gnu.org/licenses/gpl.html" >
	<img src="icons/gpl.png"  width="88" height="33" alt="GPLv3 Logo" align="right" />
</a>

Suchindex:
<span id="lucene-status">
     <script language="javascript">
     new Ajax.Updater('lucene-status', 'include/_info.php?action=indexstats');
     </script>
</span>

{*Request took: {$smarty.now-$smarty.server.REQUEST_TIME} secs*}
{*foreach from=$smarty.server key=key item=value}
	{$key} = {$value}<br>
{/foreach*}
<br>
BBS Technik Koblenz | Beatusstr. 143-147 | 56073 Koblenz
© by BBS Technik Koblenz 2005 | Designed by Alexander Weigl | 
</div>

 </div> <!-- End page -->
 </div><!--End page_margins-->

</body>
</html>
