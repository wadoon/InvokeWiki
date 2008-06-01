{*
 * @File: menu.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/menu.tpl $
 * $Id: menu.tpl 20 2008-06-01 13:38:31Z alex953 $
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
 <div id="nav">
	<a id="navigation" name="navigation" ></a>
  <div id="nav_main">
    <ul>
      <li><a href="index.php">Startseite</a></li>
      <li><a href="learnpaths.php">Lernpfade</a></li>
      {if $smarty.session.loggedIn }
      <li><a href="profile.php"> <img src="icons/status_online.png" /> Profile</a></li>		
      <li><a href="?logout"><img src="icons/door_out.png" /> Logout</a></li>
      {else}
      <li><a href="register.php">Registrieren</a></li>
      {/if}
		  </ul>
  <span class="search_form">
	<form action="search.php" class="search_form">
	  <label for="search_wiki"><b>Suche:</b></label>	
	  <input type="text" name="search_wiki" id="search_wiki" />
	</form>
  </span>

  
  </div><!--End nav_main-->  </div><!--End nav-->
