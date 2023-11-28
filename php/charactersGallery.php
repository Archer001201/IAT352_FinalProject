<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/DataFilter.js"></script>
</head>
<body>

<?php
require("loginHelperFunctions.php");
require("galleryHelperFunctions.php");
require ("header.php");

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

echo "<h1>Characters</h1>";

updateSession();
formStart('charactersGallery.php');
showDropdown("characterRarity", "Rarity", ["All", "4-star", "5-star"]);
showDropdown("weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
showDropdown("elementType","Element Type", ["All", "Anemo", "Geo", "Electro", "Dendro", "Hydro", "Pyro", "Cyro"]);
showDropdown("region","Region", ["All", "Mondstadt", "Liyue", "Inazuma", "Sumeru", "Fontaine"]);
formEnd();

showInfoCards($db, "characters");

$db->close();
?>

</body>
</html>
