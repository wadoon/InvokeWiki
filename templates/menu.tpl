<div id="navi">
	<ul>
		<li><a href="index.php">Startsesite</a></li>
		<li><a href="learnpaths.php">Lernpfade</a></li>
		<li><a href=""></a></li>
		{if $smarty.session.loggedIn }
			<li><a href="profile.php">Profile</a></li>		
			<li><a href="?logout">Logout</a></li>
		{else}
		      <a href="register.php">Registrieren</a></li>
		{/if}
	</ul>
</div>
