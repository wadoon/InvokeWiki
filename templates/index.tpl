{*
 * @File: index.tpl
 * @Version: 1.0
 * @Date: 10.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/index.tpl $
 * $Id: index.tpl 20 2008-06-01 13:38:31Z alex953 $
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
{include file="message.tpl"}
<div class="clearfix" id="col1_content">
					<h2>Column  #col1</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam leo.  Donec massa tellus, sodales vitae, mattis a, pretium in, nisi.  Pellentesque ultrices, lacus eget volutpat commodo, lorem purus  faucibus dolor, ut faucibus ipsum tellus a elit. Pellentesque habitant  morbi tristique senectus et netus et malesuada fames ac turpis egestas.  Pellentesque ut mi sed dolor nonummy rhoncus. Duis laoreet est id  mauris dignissim porttitor. </p>
					<div class="subcolumns">
						<div class="c50l">
							<div class="subcl">
								<h3>Linker Block</h3>
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam leo.  Donec massa tellus, sodales vitae, mattis a, pretium in, nisi.  Pellentesque ultrices, lacus eget volutpat commodo, lorem purus  faucibus dolor, ut faucibus ipsum tellus a elit. Pellentesque habitant  morbi tristique senectus et netus et malesuada fames ac turpis egestas.  Pellentesque ut mi sed dolor nonummy rhoncus. Duis laoreet est id  mauris dignissim porttitor. </p>
								<p>Etiam ullamcorper magna et dui. Morbi  lectus metus, porta sit amet, accumsan nec, aliquet vitae, nisl. Proin  cursus tempus lectus. Ut a risus et neque ornare molestie. Nulla erat  enim, dictum in, interdum vitae, rhoncus non, ligula. Sed sollicitudin  sollicitudin turpis. Maecenas vitae neque.</p>
							</div>
						</div>
						<div class="c50r">
							<div class="subcr">
								{if $smarty.session.loggedIn}
									{include file="_articletagcloud_userrated.tpl"}
								{/if}
								{include file="_articletagcloud.tpl"}
								
								<h3>Rechter Block</h3>
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam leo.  Donec massa tellus, sodales vitae, mattis a, pretium in, nisi.  Pellentesque ultrices, lacus eget volutpat commodo, lorem purus  faucibus dolor, ut faucibus ipsum tellus a elit. </p>
								<p>Pellentesque habitant  morbi tristique senectus et netus et malesuada fames ac turpis egestas.  Pellentesque ut mi sed dolor nonummy rhoncus. Duis laoreet est id  mauris dignissim porttitor. Etiam ullamcorper magna et dui. Morbi  lectus metus, porta sit amet, accumsan nec, aliquet vitae, nisl. Proin  cursus tempus lectus. Ut a risus et neque ornare molestie. Nulla erat  enim, dictum in, interdum vitae, rhoncus non, ligula. Sed sollicitudin  sollicitudin turpis. Maecenas vitae neque.</p>
							</div>
						</div>
					</div>
				</div>
{include file="footer.tpl"}
