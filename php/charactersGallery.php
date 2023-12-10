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
require("loginHelperFunctions.php");



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
echo "<h1 class='pageTitle'>Characters</h1>";

formStart('charactersGallery.php', "get");
showRadioButton("characterRarity", "Rarity", ["All", "4-star", "5-star"]);
showRadioButton("elementType","Element Type", ["All", "Anemo", "Geo", "Electro", "Dendro", "Hydro", "Pyro", "Cyro"]);
showRadioButton("region","Region", ["All", "Mondstadt", "Liyue", "Inazuma", "Sumeru", "Fontaine"]);
showRadioButton("character_weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
formEnd();

require ("characters.php");

echo "</div>";
$db->close();
?>

</body>
</html>
