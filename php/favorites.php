<html lang="en">
<head>
    <title>Artifacts</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
    <link href="../css/account.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
</head>
<body>

<?php
require("header.php");
require_once ("sqlHelperFunctions.php");

redirect_to_if("sign-in.php", empty($_SESSION['valid_user']), "account");
$db = connectDatabase();

$user = queryById($db,"users", $_SESSION['valid_user'], "uid");

echo "<div class='mainContainer'>";
echo "<h1>" . $user['userName'] . "'s Favorites</h1>";
require ("account_nav.php");
echo "<div class='tool-bar'>";
formStart("userFavoritedGuides.php", "GET");
showDropdown("favorite_guideSorting", "Sorting", ["Favorite Date: Newest", "Favorite Date: Oldest"]);
formEnd();
echo "</div>";
echo "<div id='guidesContainer'>";
require ("userFavoritedGuides.php");
echo "</div>";
echo "</div>";
?>

</body>
</html>
