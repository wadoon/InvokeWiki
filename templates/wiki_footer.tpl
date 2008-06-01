{*
 * @File: wiki_footer.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/wiki_footer.tpl $
 * $Id: wiki_footer.tpl 20 2008-06-01 13:38:31Z alex953 $
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
</div><!-- END col 1-->

<!-- Start col2 -->
<div id="col3">
  <!-- Info Boxen -->
  <p>
    <h3>Tagging</h3>
    <div>    
      <label for="tagsearch">Tagssuche</label>
      <input type="text" id="tagsearch" name="tagsearch" />	 
      <span id="indicator1" style="display: none">
        <img src="icons/hourglass.png" alt="Working..." />
      </span>
      <button class="tagsearch" onClick="javascript:addArticleTag();" >+</button>
      <div id="tag_choices" class="autocomplete"></div>	  
      <div id="tag_soup"></div>
    </div>
        
    <h3>Bewertung</h3>
    <div>  
      <div class="rating">
        {foreach from=$ratings item=rating}
          <div id="rating_{$rating->id}">
              {$rating->html}	       
	  </div><!-- enf of rating_type -->
        {/foreach}
      </div><!--end of rating -->
    </div></div>
     <h3>Artikel-Historie</h3>
    <div>
      <div id="version_info">
        <a onClick="new Ajax.Updater('version_info','include/_versioninfo.php?articleId={$article.Article_Id}&version_no={$article.Version_No}')">Versioninformationen</a>
      </div>
    </div>
    
   </div>   
  </p>
</div><!-- End col2-->
</div><!-- End main -->

<script type="text/javascript">
  var articleId = {$article.Article_Id};
</script>

{literal}
<script type="text/javascript"> 
/*
options = {
	resizeSpeed : 15,
	classNames : {
    toggle : 'accordion_toggle',
    toggleActive : 'accordion_toggle_active',
    content : 'accordion_content'
	},
	defaultSize : {
    height : null,
    width : null
	},
	direction : 'horizontal',
	onEvent : 'click'
};

  new accordion('accordion_top', options);
  var verticalAccordions = $$('.accordion_toggle');
  verticalAccordions.each(function(accordion) {
  $(accordion.next(0)).setStyle({ height: '0px' }); });
*/

 new Ajax.Updater('tag_soup', 'include/_atagsoup.php?action=list&articleId='+articleId);


 new Ajax.Autocompleter("tagsearch", "tag_choices", "include/_atagsoup.php?action=search" , 
   {paramName: "value", minChars: 1, updateElement: addTagToListArticle, indicator: 'indicator1'} );


 function addArticleTag()
 {
    var value = $F('tagsearch');
    if(value.empty()) return;
    alert($F('tagsearch'));
    new Ajax.Request('include/_atagsoup.php', 
    {
      parameters: {action:'addname', name:value,  articleId : articleId },
      method    : 'get', 
      onSuccess : function(r) {  
        $('tagsearch').value='';
        new Ajax.Updater('tag_soup', 'include/_atagsoup.php?action=list&articleId=' + articleId);
        }
    });
 }
</script>
{/literal}     


</div><!-- End Col 2 -->
<div id="footer">
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
