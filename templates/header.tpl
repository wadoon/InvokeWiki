{debug}
{*
 * File: header.tpl
 * Version: 1.0
 * Date: 09.05.2008
 * Autor: Alexander Weigl
 *}
<HTML>
<HEAD>
{*popup_init src="/javascripts/overlib.js"*}
<link rel="stylesheet" type="text/css" href="css/main.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{if !$prototype}
    <script src="js/prototype.js"    type="text/javascript"></script>
    <script src="js/scriptaculous.js" type="text/javascript" language="javascript"></script> 
{/if}
<script src="js/invoke.js" type="text/javascript" language="javascript"></script>
{if $ext_js}
  {literal}
   <script language="javascript" type="text/javascript">
    {$ext_js}
   </script>
  {/literal}
{/if}
<TITLE>{$site_title} - {$site_name}</TITLE>
</HEAD>
<body>
<div class="content">
	<div class="head" style="height:50px; background:#ccc; vertical-align:bottom;" >
            <form action="search.php" style="float:right">
	    	  <label for="search_wiki">Suche:</label>
		  <input type="text" name="search_wiki" id="search_wiki" />
	    </form>	 

      	  {if !$smarty.session.loggedIn }
	    <form action="" method="post">
	      <input type="hidden" name="login" value="true" />
	      Login: <input type="text" name="e_mail" id="e_mail" />
              <input type="password" name="pwd" id="pwd"/>
	      <input type="submit" value="login">
	    </form>          
	    {/if}		
	    
	</div>
	<div class="innerContent">
	  <noscript class="error" align="center">
	    Bitte aktivieren Sie JavaScript!
	  </noscript>
