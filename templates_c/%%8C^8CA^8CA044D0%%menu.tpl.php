<?php /* Smarty version 2.6.19, created on 2008-05-13 18:43:05
         compiled from menu.tpl */ ?>
<div id="navi">
	<ul>
		<li><a href="index.php">Startsesite</a></li>
		<li><a href="learnpaths.php">Lernpfade</a></li>
		<li><a href=""></a></li>
		<?php if ($_SESSION['loggedIn']): ?>
			<li><a href="profile.php">Profile</a></li>		
			<li><a href="?logout">Logout</a></li>
		<?php else: ?>
		      <a href="register.php">Registrieren</a></li>
		<?php endif; ?>
	</ul>
</div>