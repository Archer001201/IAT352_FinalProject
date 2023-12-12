<html lang="en">
<head>
    <title>Characters</title>
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
echo "<h1 class='pageTitle'>Characters</h1>";

formStart('charactersGallery.php', "get");
showRadioButton("characterRarity", "Rarity", ["All", "4-star", "5-star"]);
showRadioButton("elementType","Element Type", ["All", "Anemo", "Geo", "Electro", "Dendro", "Hydro", "Pyro", "Cyro"]);
showRadioButton("region","Region", ["All", "Mondstadt", "Liyue", "Inazuma", "Sumeru", "Fontaine"]);
showRadioButton("character_weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
formEnd();
echo "<div class='cardContainer' id='card-container'>";
require ("characters.php");
echo "</div>";
echo "</div>";
$db->close();
?>

</body>
</html>
