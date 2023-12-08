<?php
session_start();
?>

<header>
    <nav>
        <a class="nav-button" href="charactersGallery.php">Characters</a>
        <a class="nav-button" href="weaponsGallery.php">Weapons</a>
        <a class="nav-button" href="artifactsGallery.php">Artifacts</a>
        <a class="nav-button"  href="account.php">Account</a>
<!--        --><?php
//					if (isset($_SESSION['valid_user']))
//						echo "<a class=\"nav-button\"  href=\"account.php\">Account</a>";
//					else
//						echo "<a class=\"nav-button\" href=\"sign-in.php\">Account</a>";
//					?>
    </nav>
</header>

<?php
require ("sqlHelperFunctions.php");
require ("formHelperFunctions.php");
echo "<script>let isLogin = " . (isset($_SESSION['valid_user']) ? 'true' : 'false') . ";</script>";

function redirect_to_if($url, $condition, $loginRequestPage){
    if (!$condition) return;
//    $_SESSION['loginRequestPage'] = $loginRequestPage;
    header('Location: ' . $url . "?loginRequest=" . $loginRequestPage);
    exit();
}
