<header>
    <nav>
        <a class="nav-button" href="charactersGallery.php">Characters</a>
        <a class="nav-button" href="weaponsGallery.php">Weapons</a>
        <a class="nav-button" href="artifactsGallery.php">Artifacts</a>
        <?php
					if (isset($_SESSION['valid_user']))
						echo "<a class=\"nav-button\"  href=\"sign-out.php\">Sign out</a>";
					else
						echo "<a class=\"nav-button\" href=\"sign-in.php\">Sign In</a>";
					?>
    </nav>
</header>