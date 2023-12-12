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
require_once ("loginHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

$db = connectDatabase();

echo "<div class='mainContainer'>";
echo "<h1 class='pageTitle'>Weapons</h1>";

formStart('weaponsGallery.php', "get");
showRadioButton("weaponRarity", "Rarity", ["All", "3-star", "4-star", "5-star"]);
showRadioButton("weapon_weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
formEnd();

echo "<div class='cardContainer' id='card-container'>";
require ("weapons.php");
echo "</div>";
echo "</div>";
$db->close();
?>

</body>
</html>
