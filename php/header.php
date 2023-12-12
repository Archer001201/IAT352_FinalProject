<?php
session_start();
?>

<header>
    <nav>
        <a class="nav-button" href="charactersGallery.php">Characters</a>
        <a class="nav-button" href="weaponsGallery.php">Weapons</a>
        <a class="nav-button" href="artifactsGallery.php">Artifacts</a>
        <a class="nav-button"  href="account.php">Account</a>
    </nav>
</header>

<?php
//require_once ("sqlHelperFunctions.php");
require_once ("formHelperFunctions.php");
require_once ("loginHelperFunctions.php");
echo "<script>let isLogin = " . (!empty($_SESSION['valid_user']) ? 'true' : 'false') . "</script>";

function redirect_to_if($url, $condition, $loginRequestPage){
    if (!$condition) return;
//    $_SESSION['loginRequestPage'] = $loginRequestPage;
    header('Location: ' . $url . "?loginRequest=" . $loginRequestPage);
    exit();
}
