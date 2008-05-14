<?php /* Smarty version 2.6.19, created on 2008-05-13 19:53:32
         compiled from wiki_show.tpl */ ?>
<div class="wiki_article">
<div style="float:right">
     <a href="?action=show_edit&alias=<?php echo $this->_tpl_vars['article']['Alias']; ?>
&articleId=<?php echo $this->_tpl_vars['article']['Article_Id']; ?>
">Bearbeiten</a>
</div>
     <h1><?php echo $this->_tpl_vars['article']['Title']; ?>
</h1>
     <div class="rating">
	  <?php $_from = $this->_tpl_vars['ratings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rating']):
?>
	       <div id="rating_<?php echo $this->_tpl_vars['rating']->id; ?>
">
	       <?php echo $this->_tpl_vars['rating']->html; ?>

	       <?php if ($_SESSION['loggedIn']): ?>
		    <select onChange="rate( <?php echo $this->_tpl_vars['article']['Article_Id']; ?>
,<?php echo $this->_tpl_vars['rating']->id; ?>
,$F(this))">
			 <option value="-1">-</option>
			 <option value="5">Sehr gut</option>
			 <option value="4">Gut </option>
			 <option value="3">Mittelmäßig</option>
			 <option value="2">Mangelhaft</option>
			 <option value="1">Fehlerhaft</option>			 		    </select>
	       <?php endif; ?>
	       </div>
	  </div
	  <?php endforeach; endif; unset($_from); ?>
     </div>
     <?php echo $this->_tpl_vars['article']['Content']; ?>
     

	<fieldset><legend>Tag-Suppe:</legend>
	  <label for="tagsearch">Tagssuche</label>
	  <input type="text" id="tagsearch" name="tagsearch" />	 
	  <button onClick="addArticleTag" >Hinzufügen</button>
	  <span id="indicator1" style="display: none"><img src="/images/spinner.gif" alt="Working..." /></span>
	  <div id="tag_choices" class="autocomplete"></div>	  
	  <div id="tag_soup"></div>	  
	</fieldset>
     </div>
     <script language="javascript">
       var articleId = <?php echo $this->_tpl_vars['article']['Article_Id']; ?>
;
     </script>
     <?php echo '
     <script language="javascript">         
       new Ajax.Updater(\'tag_soup\', \'include/_atagsoup.php?action=list&articleId=\'+articleId);
       
       new Ajax.Autocompleter("tagsearch", "tag_choices",
       "include/_atagsoup.php?action=search" , 
       {paramName: "value", 
        minChars: 1, 
        updateElement: addTagToListArticle, 
        indicator: \'indicator1\'} );


 

       function addArticleTag()
       {
         var value = $F(\'tagsearch\');
         if(value.empty()) return;
       
          new Ajax.Request(\'include/_atagsoup.php\', 
          {
            parameters: {action:add, name:value},
            method:\'get\', 
            onSuccess : function(r) {
                                 $(\'tagsearch\').value=\'\'; 
            },
            onFailure:  function(r) { 
                                alert(r.responseText);
            }
          })
       }
     </script>
'; ?>
     
     
     <div id="version_info">
       <a onClick="new Ajax.Updater('version_info','include/_versioninfo.php?articleId=<?php echo $this->_tpl_vars['article']['Article_Id']; ?>
&version_no=<?php echo $this->_tpl_vars['article']['Version_No']; ?>
')">Versioninformationen</a>
     </div>
</div>
     