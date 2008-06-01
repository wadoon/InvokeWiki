{*
 * @File: header.tpl
 * @Version: 1.0
 * @Date: 10.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/header.tpl $
 * $Id: header.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<!--link rel="stylesheet" type="text/css" href="css/main.css" /-->
	<link rel="stylesheet" type="text/css" href="css/special.css" />
	
	<link href="css/layout_2col_left_seo.css" rel="stylesheet" type="text/css"/>

{if !$prototype}
    <script src="js/prototype.js"    type="text/javascript"></script>
    <script src="js/scriptaculous.js" type="text/javascript" language="javascript"></script> 
    <!--<script src="js/accordion/javascript/accordion.js" type="text/javascript" language="javascript"></script> -->
    <script src="js/mf_lightbox/mf_lightbox.js" type="text/javascript" language="javascript" ></script>
    <script src="js/invoke.js" type="text/javascript" language="javascript"></script>
{/if}



  {literal}
 	<script language="javascript">
		Event.observe(window, 'load', init, false);
		
		function init() {
			Lightbox.init();
		}
	</script>
{/literal}
<title>{$site_title} - {$site_name}</title>
</head>
<body>
<div id="page_margins">
<div id="page">
	<!-- BEGIN HEADER -->
	<div id="header">
			<div id="topnav">
				
				<!-- start: skip link navigation -->
				<a class="skip" href="#navigation" title="skip link">Skip to the navigation</a>
				<span class="hideme">.</span>
				<a class="skip" href="#content" title="skip link">Skip to the content</a>
				<span class="hideme">.</span>
				<!-- end: skip link navigation -->
				
				<span>
                                {if ! $smarty.session.loggedIn}
                                <a href="templates/_login.tpl"
					onClick="Lightbox.showBoxByAJAX('templates/_login.tpl', 250, 200);return false;" >Login</a>
                                {else}
                                 <a href="?logout=true">Logout</a>
                                {/if}
				| <a href="#">Contact</a> | <a href="wiki.php?alias=IMPESS">Imprint</a></span> </div>
 	<h1>{$site_name} <em>&quot;{$site_title}&quot;</em></h1>	
  <span>BBS-Technik@Koblenz Informationsmanagment</span>	
	</div>
	<!--End Header-->
	{include file="menu.tpl"}  

	<div id="main">
		<div id="col1">
	  <noscript class="error" align="center">
	    Bitte aktivieren Sie JavaScript!
	  </noscript>
