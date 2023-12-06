<html lang="en">
<head>
    <title>Weapons</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
</head>
<body>

<?php
require ("header.php");
require("loginHelperFunctions.php");
require("galleryHelperFunctions.php");


$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

echo "<div class='mainContainer'>";
echo "<h1 class='pageTitle'>Weapons</h1>";
updateSession();
formStart('weaponsGallery.php', "get");
showRadioButton("weaponRarity", "Rarity", ["All", "3-star", "4-star", "5-star"]);
showRadioButton("weapon_weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
formEnd();
showInfoCards($db, "weapons");
echo "</div>";
$db->close();
?>

</body>
</html>
